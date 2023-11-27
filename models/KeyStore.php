<?php

namespace app\models;

use Yii;
use ziya\Translate\behaviours\TranslatableBehaviour;
use ziya\Translate\Translatable;

/**
 * This is the model class for table "key_store".
 *
 * @property int $id
 * @property string|null $key
 * @property string|null $value
 * @property int|null $type
 */
class KeyStore extends \yii\db\ActiveRecord
{
    use Translatable;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'key_store';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TranslatableBehaviour::class,
                'attributes' => ['value']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'safe'],
            [['type'], 'integer'],
            [['key'], 'string', 'max' => 255],
            [['key', 'value'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
            'type' => 'Type',
        ];
    }

    public static function Translate($key, $default = null)
    {
        $dbKey = KeyStore::findOne(['key'=>$key]);
        if ($dbKey == null) {
            if ($default!=null) {
                return $default;
            }
            return $key;
        }
        return $dbKey->value;
    }
}
