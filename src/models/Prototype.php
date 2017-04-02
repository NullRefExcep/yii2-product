<?php

namespace nullref\product\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product_prototype}}".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 */
class Prototype extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_prototype}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product', 'ID'),
            'name' => Yii::t('product', 'Name'),
            'type' => Yii::t('product', 'Type'),
        ];
    }
}
