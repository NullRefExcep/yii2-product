<?php

namespace nullref\product;

use nullref\core\components\Module as BaseModule;
use nullref\core\interfaces\IAdminModule;
use nullref\product\components\EntityManager;
use Yii;

/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Module extends BaseModule implements IAdminModule
{
    public $productModel = 'nullref\product\models\Product';

    public function init()
    {
        parent::init();
        $config = $this->getComponents();
        if (isset($config['productManager'])) {
            $config = $config['productManager'];
        } else {
            $config = [];
        }
        $config = EntityManager::getConfig('nullref\\product\\models\\', 'Product', $config);
        $this->setComponents([
            'productManager' => $config
        ]);
    }

    public static function getAdminMenu()
    {
        return [
            'label' => Yii::t('product', 'Products'),
            'url' => ['/product/admin'],
            'icon' => 'archive',
        ];
    }

}