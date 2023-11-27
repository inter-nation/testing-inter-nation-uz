<?php

namespace app\models;

use Exception;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "test_finish".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int|null $question_type
 * @property int|null $group_type
 * @property string|null $phones
 * @property string|null $dob
 * @property string|null $note
 * @property string|null $prefer_date
 * @property string|null $created_at
 */
class TestFinish extends ActiveRecord
{
    /**
     * @var TestingSession
     */
    public $session;

    public function __construct($session, $config = [])
    {
        parent::__construct($config);
        $this->session = $session;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_finish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_type'], 'integer'],
            [['dob', 'note'], 'safe'],
            [['first_name', 'last_name', 'note'], 'string', 'max' => 255],
            [['prefer_date'], 'string', 'max' => 400],
            [['phones'], function ($attribute, $params) {
                $phone = preg_replace('/[^0-9]/', '', $this->phones);
                if (strlen($phone) !== strlen('998909212122')) {
                    $this->addError($attribute, 'Неверный формат номера телефона');
                }
            }],
            [[
                'first_name',
                'last_name',
                'phones',
            ], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => Yii::t('app', 'First_Name'),
            'last_name' => Yii::t('app', 'Last_Name'),
            'question_type' => Yii::t('app', 'Question Type'),
            'phones' => Yii::t('app', 'Phone'),
            'note' => Yii::t('app', 'Note'),
            'dob' => Yii::t('app', 'Дата рождения'),
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->question_type = $this->session->questionType ? $this->session->questionType->name : '';
            $this->phones = preg_replace('/[^0-9]/', '', $this->phones);
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->session->status = $this->session::STATUS_SUCCESS;
        $this->session->save();
        if ($insert) {
            $db = new yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=' . getenv('MASTER_DB_DATABASE'),
                'username' => getenv('MASTER_DB_USER'),
                'password' => getenv('MASTER_DB_PASSWORD'),
                'charset' => 'utf8',
            ]);
            try {
                $total = count($this->session->results);
                $correct = count(array_filter($this->session->results, static function ($item) {
                    return $item->is_correct;
                }));
                $db->createCommand()->insert('raw_reception', [
                    'first_name' => Html::encode($this->first_name),
                    'last_name' => Html::encode($this->last_name),
                    'level_id' => $this->question_type,
                    'result' => $correct * 2,
                    'created_at' => date('Y-m-d H:i:s'),
                    'phone' => Html::encode($this->phones),
                    'dob' => Html::encode($this->dob),
                ])->execute();
            } catch (Exception $exception) {
                throw $exception;
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
