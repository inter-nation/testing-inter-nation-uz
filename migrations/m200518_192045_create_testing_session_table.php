<?php

use app\components\db\Migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%testing_session}}`.
 */
class m200518_192045_create_testing_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%testing_session}}', [
            'id' => $this->primaryKey(),
            'session_id' => $this->string()->unique(),
            'question_type_slug' => $this->string(),
            'start_at' => $this->dateTime(),
            'finishes_at' => $this->dateTime(),
            'status' => $this->integer(),
        ], Migrations::TABLE_OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%testing_session}}');
    }
}
