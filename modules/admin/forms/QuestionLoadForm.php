<?php


namespace app\modules\admin\forms;


use yii\base\Model;

class QuestionLoadForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'],'file'],
        ];
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function save()
    {
        if ($this->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {

                $transaction->commit();
            } catch (\Exception $exception) {
                if ($transaction) {
                    $transaction->rollBack();
                }
                throw $exception;
            }
            return true;
        }
        return false;
    }
}