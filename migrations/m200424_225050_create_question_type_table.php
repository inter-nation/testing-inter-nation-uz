<?php

use app\components\db\Migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%question_type}}`.
 */
class m200424_225050_create_question_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'count' => $this->integer(),
            'time_allowed' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'status' => $this->integer()
        ], Migrations::TABLE_OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%question_type}}');
    }
}
