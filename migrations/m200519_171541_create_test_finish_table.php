<?php

use app\components\db\Migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_finish}}`.
 */
class m200519_171541_create_test_finish_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_finish}}', [
            'id' => $this->primaryKey(),
            'first_name'=>$this->string(),
            'last_name'=>$this->string(),
            'question_type'=>$this->string(),
            'group_type'=>$this->integer(),
            'phones'=>$this->string(400),
            'dob'=>$this->date(),
            'note'=>$this->string(),
            'prefer_date'=>$this->string(400),
            'created_at' => $this->dateTime()
        ], Migrations::TABLE_OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_finish}}');
    }
}
