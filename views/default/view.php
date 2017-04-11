<?php

use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\StaticPages */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="main-content">
            <?php echo $model->text; ?>
        </div>
    </div>
</div>

