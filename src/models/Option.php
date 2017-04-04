<?php

namespace nullref\product\models;

use nullref\product\models\option\Type;
use nullref\product\models\option\Value;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product_option}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $type_id
 * @property int $order
 *
 * @property Type $type
 * @property Value[] $productOptionValues
 */
class Option extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_option}}';
    }

    /**
     * @inheritdoc
     * @return OptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'order'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product', 'ID'),
            'code' => Yii::t('product', 'Code'),
            'name' => Yii::t('product', 'Name'),
            'type_id' => Yii::t('product', 'Type'),
            'order' => Yii::t('product', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(Value::className(), ['option_id' => 'id']);
    }
}
