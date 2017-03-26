<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2017 NRE
 */


namespace nullref\product\components;


use nullref\core\interfaces\IList;
use Yii;

class ProductTypes implements IList
{
    const TYPE_SIMPLE = 'simple';
    const TYPE_CONFIGURABLE = 'configurable';
    const TYPE_VARIATION = 'grouped';
    const TYPE_VIRTUAL = 'virtual';

    /**
     * @param $key
     * @return mixed|null
     */
    public function getValue($key)
    {
        $list = self::getList();
        if (array_key_exists($key, $list)) {
            return $list[$key];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return [
            self::TYPE_SIMPLE => Yii::t('product', 'Simple'),
            self::TYPE_CONFIGURABLE => Yii::t('product', 'Configurable'),
        ];
    }


}