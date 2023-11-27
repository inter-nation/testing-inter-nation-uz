<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "answer".
 *
 * @property int $id
 * @property int|null $question_id
 * @property string|null $title
 * @property int|null $is_right_answer
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property string $isRightAnswer
 * @property Question $question
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answer';
    }

    public function fields()
    {
        return [
            'id',
            'question_id',
            'title',
            'is_right_answer',
            'isRightAnswer'
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => date('Y-m-d H:i:s')
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'title' => 'Title',
            'is_right_answer' => 'Is Right Answer',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }
    public function getIsRightAnswer()
    {
        return $this->is_right_answer?'Yes':'No';
    }
}
