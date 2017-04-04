<?php

namespace nullref\product\models\option;

use nullref\product\models\Option;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product_option_value}}".
 *
 * @property int $id
 * @property int $option_id
 * @property string $name
 * @property string $value
 * @property int $order
 *
 * @property Option $option
 */
class Value extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_option_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_id', 'order'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
            [['option_id', 'value'], 'unique', 'targetAttribute' => ['option_id', 'value']],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => Option::className(), 'targetAttribute' => ['option_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product', 'ID'),
            'option_id' => Yii::t('product', 'Option'),
            'name' => Yii::t('product', 'Name'),
            'value' => Yii::t('product', 'Value'),
            'order' => Yii::t('product', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(Option::className(), ['id' => 'option_id']);
    }
}
