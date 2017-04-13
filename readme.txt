Установка модуля muravshchyk/pages:

1) Добавить в composer.json

"repositories": [
        {
            "type": "vcs",
            "url":  "git@bitbucket.org:minister87/yii2-pages.git"
        }
    ],

"require": {
              "yiisoft/yii2": "~2.0.7",
              "kartik-v/yii2-grid": "*",
              "integready/yii2-datepicker-widget": "*"
        }


2) composer update

3) Добавить в main.php

    'modules' => [
        'pages' => [
            'class' => 'muravshchyk\pages\Pages',
        ],
    ],

4) Добавить в urlFrontendManager и urlMyManager:

    'rules' => [
        'pages'                             => 'pages/default/index',
        'pages/<category:\w+>'              => 'pages/default/index',
        'pages/<category:\w+>/<alias:\w+>'  => 'pages/default/index',
        ]
5) Добавить urlBackendManager:
    'rules' => [
        'pages'                             => 'pages/default/index',
        ]

