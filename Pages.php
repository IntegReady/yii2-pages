<?php

namespace muravshchyk\pages;

/**
 * pages module definition class
 */
class Pages extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
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
    }
}
