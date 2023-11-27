<?php

use app\components\db\Migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%key_store}}`.
 */
class m200424_225048_create_key_store_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%key_store}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(),
            'value' => $this->json(),
            'type' => $this->integer()
        ], Migrations::TABLE_OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%key_store}}');
    }
}
