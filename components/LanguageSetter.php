<?php
namespace app\components;

use yii\base\BootstrapInterface;
use yii\base\BaseObject;

class LanguageSetter extends BaseObject implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $preferredLanguage = isset($app->request->cookies['lang'])
            ? (string)$app->request->cookies['lang']
            : null;
        if (empty($preferredLanguage)) {
            $preferredLanguage = $app->request->getPreferredLanguage(Languages::LIST_LANGUAGES);
        }
        $app->language = $preferredLanguage;
    }

}