<?php

namespace muravshchyk\pages;

use Yii;

/**
 * pages module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    // Контроллеры модуля заблокированы!!!
    public $controllerNamespace = 'muravshchyk\pages\controllers';

    // Разрешенные языки (по умолчанию только en-US
    public $allowedLanguages = [];


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        if (!isset(Yii::$app->i18n->translations['pgs'])) {
            Yii::$app->i18n->translations['pgs'] = [
                'class'          => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath'       => $this->getBasePath() . '/messages'
            ];
        }
    }
}
