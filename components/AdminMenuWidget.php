<?php


namespace app\components;


use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class AdminMenuWidget extends Widget
{

    public $columns = [];

    public function run()
    {
        $html = '';
        $html = $this->structureMenu($html, $this->columns);
        return Html::tag('ul', $html, [
            'class' => "nav nav-pills nav-sidebar flex-column",
            'data-widget' => "tree",
            'role' => "menu",
            'data-accordion' => "false"
        ]);
    }

    /**
     * @param string $html
     * @param array $columns
     * @param bool $is_recursive
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function structureMenu(string $html, array $columns): string
    {
        $currentUrl = '/' . Yii::$app->controller->module->id . '/' . Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
        foreach ($columns as $column) {
            $content = $column['content'] ?? '';
            $url = $column['url'] ?? '#';
            $icon = $column['icon'] ?? '';
            if ($icon != '') {
                $icon = Html::tag('i', '', ['class' => $icon]);
            }
            $active = $currentUrl == $url ? 'active' : '';
            $html .= Html::tag('li',
                Html::a(Html::tag('p', $icon . $content), $url, ['class' => 'nav-link ' . $active]),
                ['class' => 'nav-item']
            );
        }
        return $html;
    }
}