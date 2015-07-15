<?php

namespace nullref\product\behaviors;

use nullref\category\models\Category;
use nullref\core\behaviors\OneHasManyRelation;
use Yii;
use yii\db\ActiveRecord;

/**
 * Behavior which provide connection with category
 * @author    Dmytro Karpovych
 *
 * @package nullref\category\behaviors
 *
 * @property ActiveRecord $owner
 * @property Category $category
 */
class HasProducts extends OneHasManyRelation
{
    public $entityModuleId = 'product';
    public $entityManagerName = 'productManager';
    public $attributeName = 'products';
    public $fieldName = 'entityId';

    public function getAttributeLabel()
    {
        return Yii::t('product', 'Products');
    }

    public function getProducts()
    {
        return $this->getRelation();
    }
}