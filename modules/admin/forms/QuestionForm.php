<?php


namespace app\modules\admin\forms;


use app\models\Answer;
use app\models\Question;
use app\models\QuestionType;
use yii\base\Model;
use yii\db\Exception;

class QuestionForm extends Model
{
    public $id;
    public $question_type_id;
    public $title;
    public $description;
    public $answers;
    /**
     * @var Question
     */
    private $_model;

    /**
     * QuestionForm constructor.
     * @param Question $model
     * @param array $config
     */
    public function __construct(Question $model, $config = [])
    {
        $this->_model = $model;
        $this->id = $model->id;
        $this->description = $model->description;
        $this->question_type_id = $model->question_type_id;
        $this->answers = array_map(function(Answer $answer){
            return ['answer_option'=>$answer->title,'is_right_answer'=>$answer->is_right_answer];
        },$model->answers);
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['question_type_id','description','answers'],'required'],
            [['description'], 'string', 'max' => 4000],
            [['question_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionType::class, 'targetAttribute' => ['question_type_id' => 'id']],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $dbTransaction = \Yii::$app->db->beginTransaction();
        try {
            $model = $this->_model;
            $model->description = $this->description;
            $model->question_type_id = $this->question_type_id;
            $model->save();
            $this->id = $model->id;

            Answer::deleteAll(['question_id'=>$model->id]);
            foreach ($this->answers as $answer) {
                if (!(new Answer([
                    'question_id' =>$model->id,
                    'title'=>$answer['answer_option']??'',
                    'is_right_answer'=>$answer['is_right_answer'],
                ]))->save()) {
                    throw new Exception('');
                }
            }
            $dbTransaction->commit();
        } catch (\Exception $ex) {
            $dbTransaction->rollBack();
            throw $ex;
        }
        return true;
    }

}