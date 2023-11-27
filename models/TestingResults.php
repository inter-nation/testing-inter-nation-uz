<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testing_results".
 *
 * @property int $id
 * @property string|null $session_id
 * @property int|null $question_id
 * @property int|null $testing_session_id
 * @property string|null $question_data
 * @property string|null $chosen_answer
 * @property string|null $answers_data
 * @property int|null $is_correct
 * @property string|null $saved_at
 */
class TestingResults extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testing_results';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_id' => 'Session ID',
            'question_id' => 'Question ID',
            'question_data' => 'Question Data',
            'chosen_answer' => 'Chosen Answer',
            'answers_data' => 'Answers Data',
            'is_correct' => 'Is Correct',
            'saved_at' => 'Saved At',
        ];
    }
}
