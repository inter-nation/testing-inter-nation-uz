<?php

use yii\db\Migration;

/**
 * Class m200518_162623_add_column_slug_to_question_type_table
 */
class m200518_162623_add_column_slug_to_question_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('question_type','slug',$this->string()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('question_type','slug');
    }
}
