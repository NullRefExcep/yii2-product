<?php
namespace nullref\product;

use nullref\product\models\Product;
use nullref\product\models\ProductQuery;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Event;

/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $module = $app->getModule('product');

        $class = Product::className();

        $definition = $class;

        /** @var Module $module */
        if (($module !== null) && (class_exists($module->productModel))) {
            $definition = $module->productModel;
        }

        \Yii::$container->set($class, $definition);

        $className = is_array($definition) ? $definition['class'] : $definition;

        \Yii::$container->set(ProductQuery::className(), function () use ($className) {
            return $className::find();
        });

        Event::on(ProductQuery::className(), ProductQuery::EVENT_INIT, function (Event $e) use ($class, $className) {
            if ($e->sender->modelClass == $class) {
                $e->sender->modelClass = $className;
            }
        });
    }
}
