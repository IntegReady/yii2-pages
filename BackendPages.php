<?php

namespace muravshchyk\pages;

/**
 * pages module definition class
 */
class BackendPages extends Pages
{
    /**
     * @inheritdoc
     */
    // Контроллеры модуля разблокированы!!!
    public $controllerNamespace = 'muravshchyk\pages\controllers';
}
