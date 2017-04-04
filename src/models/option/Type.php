<?php

namespace nullref\product\models\option;

use nullref\product\models\Option;
use nullref\useful\traits\Mappable;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product_option_type}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property Option[] $productOptions
 */
class Type extends ActiveRecord
{
    use Mappable;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_option_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptions()
    {
        return $this->hasMany(Option::className(), ['type_id' => 'id']);
    }
}
