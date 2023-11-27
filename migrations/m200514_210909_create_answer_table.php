<?php

use app\components\db\Migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%answer}}`.
 */
class m200514_210909_create_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answer}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer(),
            'title' => $this->string(),
            'is_right_answer' => $this->boolean(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ], Migrations::TABLE_OPTIONS);
        $this->addForeignKey(
            'fk_answer_question_id',
            'answer',
            'question_id',
            'question',
            'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_answer_question_id',
            'answer'
        );
        $this->dropTable('{{%answer}}');
    }
}
