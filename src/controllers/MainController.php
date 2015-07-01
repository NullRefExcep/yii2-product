<?php

namespace nullref\product\controllers;

use nullref\product\Module;
use yii\web\Controller;

/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MainController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        /** @var Module $module */
        $module = \Yii::$app->getModule('product');
        $model = $module->createModel();
        return $this->render('create', ['model' => $model]);
    }
} 