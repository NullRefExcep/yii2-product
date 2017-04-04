<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2017 NRE
 */
use nullref\product\models\Option;
use yii\helpers\Html;

$options = Option::find()->all();
?>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::button(Yii::t('product', 'Add attribute'), ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="panel-body">
                <ul>
                    <?php foreach ($options as $option): ?>
                        <li><?= $option->name ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>
