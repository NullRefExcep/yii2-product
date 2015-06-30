<?php

namespace nullref\product\models;

/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    public function enabled()
    {
        return $this->andWhere(['status' => Product::STATUS_ENABLE]);
    }

    public function disable()
    {
        return $this->andWhere(['status' => Product::STATUS_DISABLE]);
    }
}