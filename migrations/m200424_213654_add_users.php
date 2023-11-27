<?php

use yii\db\Migration;

/**
 * Class m200424_213654_add_users
 */
class m200424_213654_add_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        (new \app\models\User([
            'username' => 'admin',
            'password' =>  Yii::$app->security->generatePasswordHash('!A2s#D')
        ]))->save();

        (new \app\models\User([
            'username' => 'manager',
            'password' => Yii::$app->security->generatePasswordHash('!A2s#D')
        ]))->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200424_213654_add_users cannot be reverted.\n";

    }
}
