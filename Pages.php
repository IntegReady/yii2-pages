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
    // Контроллеры модуля заблокированы!!!
    public $controllerNamespace = '';

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
