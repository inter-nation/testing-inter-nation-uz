<?php

use app\components\db\Migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%testing_results}}`.
 */
class m200518_192533_create_testing_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%testing_results}}', [
            'id' => $this->primaryKey(),
            'testing_session_id' => $this->integer(),
            'session_id' => $this->string(),
            'question_id' => $this->integer(),
            'question_type_id' => $this->integer(),
            'question_data' => $this->string(4000),
            'chosen_answer' => $this->string(),
            'answers_data' => $this->string(4000),
            'is_correct' => $this->boolean(),
            'saved_at' => $this->dateTime()
        ], Migrations::TABLE_OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%testing_results}}');
    }
}
