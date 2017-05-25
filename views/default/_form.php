<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\datetime\DateTimePicker;
use integready\pages\PageHelper;
use integready\pages\models\PagesCategory;

/* @var $this yii\web\View */
/* @var $model integready\pages\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput()->dropDownList(PagesCategory::getCategoryList()) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options'       => [
            'rows' => 6,
        ],
        'clientOptions' => [
            'contentsCss'    => Yii::$app->urlFrontendManager->createAbsoluteUrl(['/css/bootstrap.css']),
            'allowedContent' => true,
        ],
        'preset'        => 'full',
    ]) ?>

    <?= $form->field($model, 'language')->dropDownList(PageHelper::getLanguagesList()) ?>

    <?=
    $form->field($model, 'date_created')->widget(DateTimePicker::className(), [
        'options'       => ['placeholder' => PageHelper::DATETIME_FORMAT_PUBLICATIONS_PLACEHOLDER,],
        'pluginOptions' => [
            'language'  => 'en',
            'format'    => PageHelper::DATETIME_FORMAT_ICU_RU,
            'autoclose' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'date_updated')->widget(DateTimePicker::className(), [
        'options'       => ['placeholder' => PageHelper::DATETIME_FORMAT_PUBLICATIONS_PLACEHOLDER,],
        'pluginOptions' => [
            'language'  => 'en',
            'format'    => PageHelper::DATETIME_FORMAT_ICU_RU,
            'autoclose' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'date_published_in')->widget(DateTimePicker::className(), [
        'options'       => ['placeholder' => PageHelper::DATETIME_FORMAT_PUBLICATIONS_PLACEHOLDER,],
        'pluginOptions' => [
            'language'  => 'en',
            'format'    => PageHelper::DATETIME_FORMAT_ICU_RU,
            'autoclose' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'date_published_out')->widget(DateTimePicker::className(), [
        'options'       => ['placeholder' => PageHelper::DATETIME_FORMAT_PUBLICATIONS_PLACEHOLDER,],
        'pluginOptions' => [
            'language'  => 'en',
            'format'    => PageHelper::DATETIME_FORMAT_ICU_RU,
            'autoclose' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'sitemap')->checkbox(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('pgs', 'Create') : Yii::t('pgs', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
