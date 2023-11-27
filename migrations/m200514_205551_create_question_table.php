<?php

use app\components\db\Migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%question}}`.
 */
class m200514_205551_create_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question}}', [
            'id' => $this->primaryKey(),
            'question_type_id' => $this->integer(),
            'order' => $this->integer(),
            'type' => $this->integer(),
            'description' => $this->string(4000),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], Migrations::TABLE_OPTIONS);
        $this->addForeignKey(
            'fk_question_question_type_id',
            'question',
            'question_type_id',
            'question_type',
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
            'fk_question_question_type_id',
            'question'
        );
        $this->dropTable('{{%question}}');
    }
}
