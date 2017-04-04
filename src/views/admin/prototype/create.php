<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model nullref\product\models\Prototype */
/* @var $form yii\widgets\ActiveForm */

/** @var \nullref\product\components\ProductTypes $productTypes */
$productTypes = Yii::$app->getModule('product')->get('types');


$this->title = Yii::t('product', 'Create Prototype');
$this->params['breadcrumbs'][] = ['label' => Yii::t('product', 'Prototypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prototype-create">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?= Html::encode($this->title) ?>
            </h1>
        </div>
    </div>

    <p>
        <?= Html::a(Yii::t('product', 'List'), ['index'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="prototype-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'type')->dropDownList($productTypes->getList()) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('product', 'Create') : Yii::t('product', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
