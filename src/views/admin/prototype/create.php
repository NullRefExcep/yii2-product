<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model nullref\product\models\Prototype */

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

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
