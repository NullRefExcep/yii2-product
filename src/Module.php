<?php

namespace nullref\product;

use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;

/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Module extends BaseModule implements BootstrapInterface
{
    public $productModelClass = 'nullref\\product\\models\\Product';
    public $productQueryModelClass = 'nullref\\product\\models\\ProductQuery';
    public $productSearchModelClass = 'nullref\\product\\models\\ProductSearch';

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $path = \Yii::getAlias('@app/views/product');
    }

    public function createModel()
    {
        return \Yii::createObject($this->productModelClass);
    }


}