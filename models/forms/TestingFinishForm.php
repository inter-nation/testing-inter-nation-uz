<?php


namespace app\models\forms;


use yii\base\Model;

class TestingFinishForm extends Model
{
    public $first_name;
    public $last_name;
    public $level_id;
    public $group_type;
    public $phones;
    public $dob;
    public $note;
    public $prefer_date;

    public function save()
    {

    }
}