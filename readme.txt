Module Installation FAQ for muravshchyk/pages:


1) Add in config of back-end side of your project (main.php) following strings:

    'modules' => [
        'pages' => [
                    'class'            => 'muravshchyk\pages\Module',
                    'allowedLanguages' => [
                        'ru-RU',
                        'en-US'
                        ....
                        // List of the languages which you want to use (default en-US)
                    ],
                ],
    ],

    "php yii migrate/up" will build all needed tables for the module.

    After all, you can access backend page using '/pages' link



2) In front-end side of your project you can access PageDispatcher component by using following namespace:

    use muravshchyk\pages\components\PageDispatcher;

    You can use the methods of this component to dispatch your pages in front-end side:

    a) muravshchyk\pages\components\PageDispatcher::getPageHTML($category, $alias, $lang = null)
    This method builds Page model by [category, alias and language]

    b) muravshchyk\pages\components\PageDispatcher::getPagesOfCategoryQuery($category, $lang = null)
    This method builds the SQL query for the all pages of direct category. You can use this query for making ActiveDataProvider in your
    controller and then pass it into GridView widget of the view to display list of pages of category.

    c) muravshchyk\pages\components\PageDispatcher::getCategoryDbDependencySQL($category)
    This method builds the SQL query usable in DbDependency SQL option of PageCache filter at behaviors in your front-end controller for category:

       public function behaviors()
        {
            return [
                [
                    'class'      => 'yii\filters\PageCache',
                    'only'       => ['index', 'view'],
                    'duration'   => 600,
                    'variations' => [
                        \Yii::$app->language,
                        \Yii::$app->request->get(),
                    ],
                    'dependency' => [
                        'class' => 'yii\caching\DbDependency',
                        'sql'   => PageDispatcher::getCategoryDbDependencySQL('news'),
                    ],
                ],
            ];
        }

    d) muravshchyk\pages\components\PageDispatcher::getLastModifiedQuery($category = null, $alias = null, $lang = null)
    This method builds the SQL query usable in lastModified option of HttpCache  filter at behaviors in your front-end controller for category/alias/language:

     public function behaviors()
        {
            return [
                [
                    'class'              => 'yii\filters\HttpCache',
                    'lastModified'       => function () {
                        $category = 'news';
                        $alias    = Yii::$app->request->get('alias');

                        return PageDispatcher::getLastModifiedQuery($category, $alias);
                    },
                    'cacheControlHeader' => 'public, max-age=600',
                ],
            ];
        }


3) Watch the 'demo' folder for more information.
