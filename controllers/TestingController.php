<?php

namespace app\controllers;

use app\models\Answer;
use app\models\Question;
use app\models\QuestionType;
use app\models\TestFinish;
use app\models\TestingResults;
use app\models\TestingSession;
use DateInterval;
use DateTime;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TestingController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Displays homepage.
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionStart($slug = null)
    {
        $this->checkAccess($slug, 'start');
        return $this->render('start', [
            'model' => $this->findBySlug($slug)
        ]);
    }
    public function actionSlowing($slug)
    {
        sleep(0.5);
        return $this->redirect(['/testing/test', 'slug' => $slug]);
    }

    /**
     * @param null $slug
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionCreate($slug = null)
    {
        $model = $this->findBySlug($slug);
        $session_id = Yii::$app->security->generateRandomString(32);
        $cookie = new Cookie([
            'name' => 'session_id',
            'value' => $session_id,
            'expire' => time() + 3600 * 24 * 2,
        ]);
        \Yii::$app->getResponse()->getCookies()->add($cookie);
        sleep(1);
        $time = new DateTime();
        $time->add(new DateInterval('PT' . $model->time_allowed . 'M'));
        $time->add(new DateInterval('PT' . 1 . 'S'));
        $testSession = new TestingSession([
            'session_id' => $session_id,
            'question_type_slug' => $slug,
            'start_at' => date('Y-m-d H:i:s'),
            'finishes_at' => $time->format('Y-m-d H:i:s'),
            'status' => TestingSession::STATUS_STARTED
        ]);
        $testSession->save();
        return $this->redirect(['/testing/test', 'slug' => $slug]);
    }

    /**
     * @param $slug
     * @return string|\yii\web\Response
     */
    public function actionTest($slug = null)
    {
        $questionType = $this->findBySlug($slug);
        $this->checkAccess($slug);
        $session = $this->getSession($slug);
        $results = TestingResults::find()
            ->where(['testing_session_id' => $session->id])
            ->andWhere(['question_type_id'=>$questionType->id])
            ->all();
        $question = Question::find()
            ->orderBy(['id' => SORT_DESC])
            ->where(['not in', 'id', array_map(function ($item) {
                return $item->question_id;
            }, $results)])
            ->andWhere(['question_type_id'=>$questionType->id])
            ->one();
        if ($question == null) {
            $session->status = $session::STATUS_FINISHED;
            $session->save();
            return $this->redirect(['finished', 'slug' => $slug]);
        }
        return $this->render('test', [
            'model' => $question,
            'results'=>$results,
            'questionType'=>$questionType,
            'session' => $session
        ]);
    }

    public function findBySlug($slug)
    {
        $questionType = QuestionType::findOne(['slug' => $slug]);
        if ($questionType == null) {
            throw new NotFoundHttpException('Page not found');
        }
        return $questionType;
    }

    /**
     * @param null $slug
     * @param bool $is_redirect
     * @return TestingSession
     */
    public function getSession($slug = null)
    {
        $questionType = $this->findBySlug($slug);
        $cookies = Yii::$app->request->cookies;
        $session_id = $cookies->getValue('session_id','-1');
        $session = TestingSession::findOne([
            'session_id' => $session_id,
            'question_type_slug' => $slug
        ]);
        if ($session && $session->status == $session::STATUS_STARTED && $session->finishes_at < date('Y-m-d H:i:s')) {
            $session->status = TestingSession::STATUS_FINISHED;
            $session->save();

            $results = TestingResults::find()
                ->where(['testing_session_id' => $session->id])->all();
            $questions = Question::find()
                ->orderBy(['id' => SORT_DESC])
                ->where(['not in', 'id', array_map(function ($item) {
                    return $item->question_id;
                }, $results)])
                ->all();
            foreach ($questions as $question) {
                $result = new TestingResults([
                    'testing_session_id' => $session->id,
                    'session_id' => $session->session_id,
                    'question_id' => $question->id,
                    'question_type_id' => $questionType->id,
                    'question_data' => Json::encode([
                        'description' => $question->description
                    ]),
                    'chosen_answer' => 'Answer is skipped',
                    'answers_data' => Json::encode(array_map(function ($item) {
                        return $item->title;
                    }, $question->answers)),
                    'is_correct' => false,
                    'saved_at' => date('Y-m-d H:i:s')
                ]);
                $result->save();
            }
        }
        return $session;
    }

    public function actionFinished($slug)
    {
        $this->checkAccess($slug, 'finish');
        $session = $this->getSession($slug);
        $formModel = new TestFinish($session);
        if ($formModel->load(Yii::$app->request->post()) && $formModel->save()) {
            return $this->redirect(['/testing/success','slug'=>$slug]);
        }
        return $this->render('finished', [
            'model' => $session,
            'formModel' => $formModel
        ]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionSaveResult($slug)
    {
        $questionType = $this->findBySlug($slug);
        $session = $this->getSession($slug);
        /** @var Question $question */
        $question = Question::findOne([
            'id' => Yii::$app->request->post('question_id', -1)
        ]);
        $this->checkAccess($question->questionType->slug);
        /** @var Answer $answer */
        $answer = Answer::findOne([
            'id' => Yii::$app->request->post('answer', -1)
        ]);
        /** @var Answer $correct_answer */
        $correct_answer = Answer::findOne(['question_id' => $question->id, 'is_right_answer' => true]);
        if (TestingResults::find()->where(['question_id'=>$question->id])->andWhere(['session_id'=>$session->session_id])->exists()) {
            return $this->redirect(['testing/slowing', 'slug' => $question->questionType->slug]);
        }
        $result = new TestingResults([
            'testing_session_id' => $session->id,
            'session_id' => $session->session_id,
            'question_id' => $question->id,
            'question_data' => Json::encode([
                'description' => $question->description
            ]),
            'question_type_id' => $questionType->id,
            'chosen_answer' => $answer->title,
            'answers_data' => Json::encode(array_map(function ($item) {
                return $item->title;
            }, $question->answers)),
            'is_correct' => $answer->id === $correct_answer->id,
            'saved_at' => date('Y-m-d H:i:s')
        ]);
        $result->save();
        return $this->redirect(['testing/slowing', 'slug' => $question->questionType->slug]);
    }/**
     * @return \yii\web\Response
     */
    public function actionSkip($slug,$question_id)
    {
        $questionType = $this->findBySlug($slug);
        $question = Question::findOne([
            'id' => $question_id
        ]);
        $this->checkAccess($question->questionType->slug);
        $session = $this->getSession($question->questionType->slug);
        $result = new TestingResults([
            'testing_session_id' => $session->id,
            'session_id' => $session->session_id,
            'question_type_id' => $questionType->id,
            'question_id' => $question->id,
            'question_data' => Json::encode([
                'description' => $question->description
            ]),
            'chosen_answer' => 'Answer is skipped',
            'answers_data' => Json::encode(array_map(function ($item) {
                return $item->title;
            }, $question->answers)),
            'is_correct' => false,
            'saved_at' => date('Y-m-d H:i:s')
        ]);
        $result->save();
        return $this->redirect(['testing/test', 'slug' => $question->questionType->slug]);
    }

    private function destroySession(string $key)
    {
        $cookies = Yii::$app->request->cookies;
        $cookies->remove( $key );
        setcookie($key, '', time() - 3600, '/');
        unset($_COOKIE[$key]);
        sleep(1);
    }

    public function checkAccess($slug, $action = '')
    {
        $session = $this->getSession($slug);
        if ($session == null && $action != 'start' ) {
            $this->forceRedirect(['/testing/start', 'slug' => $slug]);
        }
        if ($session && $session->status == $session::STATUS_FINISHED && $action!='finish') {
            $this->forceRedirect(['testing/finished', 'slug' => $slug]);
        }
        if ($session && $session->isSuccess()  && $action!='success') {
            $this->forceRedirect(['testing/success', 'slug' => $slug]);
        }
    }

    public function actionSuccess($slug)
    {
        return $this->render('success');
    }
    private function forceRedirect($url)
    {
        header("Location: " . Url::to($url)); /* Redirect browser */
        exit();
    }
}
