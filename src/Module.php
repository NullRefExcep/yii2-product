<?php

namespace nullref\product;

use nullref\core\components\EntityManager;
use nullref\core\interfaces\IAdminModule;
use Yii;
use yii\base\Module as BaseModule;

/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Module extends BaseModule implements IAdminModule
{
    public $productModelClass = 'nullref\\product\\models\\Product';
    public $productQueryModelClass = 'nullref\\product\\models\\ProductQuery';
    public $productSearchModelClass = 'nullref\\product\\models\\ProductSearch';

    public function init()
    {
        parent::init();
        $this->setComponents(['productManager' => [
            'class' => EntityManager::className(),
            'modelClass' => $this->productModelClass,
            'queryClass' => $this->productQueryModelClass,
            'searchModelClass' => $this->productSearchModelClass,
        ]]);
    }
    public static function getAdminMenu()
    {
        return [
            'label' => Yii::t('product', 'Products'),
            'url' => ['/product/admin'],
            'icon' => 'archive',
        ];
    }

    public function createProductModel()
    {
        return \Yii::createObject($this->productModelClass);
    }


}