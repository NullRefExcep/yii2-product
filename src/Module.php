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

    public static function getAdminMenu()
    {
        return [
            'label' => Yii::t('product', 'Products'),
            'icon' => 'archive',
            'order' => 2,
            'items' => [
                [
                    'label' => Yii::t('cms', 'Prototypes'),
                    'icon' => 'copy',
                    'url' => '/product/admin/prototype',
                ],
                [
                    'label' => Yii::t('cms', 'Products'),
                    'icon' => 'archive',
                    'url' => '/product/admin/product',
                ],
                [
                    'label' => Yii::t('cms', 'Option'),
                    'icon' => 'list',
                    'url' => '/product/admin/option',
                ],
            ],
        ];
    }


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
            'productManager' => $config,
            'types' => Yii::createObject('nullref\product\components\ProductTypes'),
        ]);
    }

}