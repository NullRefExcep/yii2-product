<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2017 NRE
 */


namespace nullref\product\components;


use nullref\core\interfaces\IList;
use nullref\useful\traits\GetDefinition;
use Yii;
use yii\base\Object;

class ProductTypes extends Object implements IList
{
    const TYPE_SIMPLE = 'simple';
    const TYPE_CONFIGURABLE = 'configurable';
    const TYPE_VARIATION = 'variation';
    const TYPE_GROUPED = 'grouped';
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
            self::TYPE_VARIATION => Yii::t('product', 'Variation'),
            self::TYPE_GROUPED => Yii::t('product', 'Grouped'),
            self::TYPE_VIRTUAL => Yii::t('product', 'Virtual'),
        ];
    }

    /**
     * @param $type
     * @return bool
     */
    public function isDefault($type)
    {
        return in_array($type, [
            self::TYPE_SIMPLE,
            self::TYPE_CONFIGURABLE,
            self::TYPE_VARIATION,
            self::TYPE_GROUPED,
            self::TYPE_VIRTUAL,
        ]);
    }

}