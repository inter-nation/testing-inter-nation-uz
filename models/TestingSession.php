<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testing_session".
 *
 * @property int $id
 * @property string|null $session_id
 * @property string|null $question_type_slug
 * @property string|null $start_at
 * @property string|null $finishes_at
 * @property QuestionType $questionType
 * @property TestingResults[] $results
 * @property int|null $status
 */
class TestingSession extends \yii\db\ActiveRecord
{
    const STATUS_STARTED = 10;
    const STATUS_FINISHED_NOT_FULL = 20;
    const STATUS_FINISHED = 30;
    const STATUS_SUCCESS = 40;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testing_session';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_id' => 'Session ID',
            'question_type_slug' => 'Question Type Slug',
            'start_at' => 'Start At',
            'finishes_at' => 'Finishes At',
            'status' => 'Status',
        ];
    }

    public function getQuestionType()
    {
        return $this->hasOne(QuestionType::class,['slug'=>'question_type_slug']);
    }
    public function getResults()
    {
        return $this->hasMany(TestingResults::class,['testing_session_id'=>'id']);
    }

    public function isSuccess()
    {
        return $this->status == self::STATUS_SUCCESS;
    }
}
