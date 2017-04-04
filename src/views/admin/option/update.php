<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model nullref\product\models\Option */

$this->title = Yii::t('product', 'Update {modelClass}: ', [
    'modelClass' => 'Option',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('product', 'Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('product', 'Update');
?>
<div class="option-update">

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

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
