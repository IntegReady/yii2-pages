Установка модуля muravshchyk/pages

1) Добавить в composer.json

"repositories": [
        {
            "type": "vcs",
            "url":  "git@bitbucket.org:minister87/yii2-pages.git"
        }
    ],

"require": {
         "muravshchyk/yii2-pages": "dev-master"
        }


2) composer update

3) Добавить в main.php

    'modules' => [
        'pages' => [
            'class' => 'muravshchyk\yii2pages\Pages',
        ],
    ],



