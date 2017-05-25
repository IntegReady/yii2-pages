<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use integready\pages\PageHelper;
use integready\pages\models\PagesCategory;

/* @var $this yii\web\View */
/* @var $model integready\pages\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options'       => [
            'rows' => 6,
        ],
        'clientOptions' => [
            'allowedContent' => true,
        ],
        'preset'        => 'full',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
