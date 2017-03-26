<?php

namespace nullref\product\models;

use nullref\core\behaviors\SoftDelete;
use nullref\core\models\Model as BaseModel;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $description
 * @property string $price
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 *
 */
class Product extends BaseModel implements IProduct
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 1;

    /**
     * @return ProductQuery
     * @throws \yii\base\InvalidConfigException
     */
    public static function find()
    {
        return parent::find()->where(['deleted_at' => null]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge([
            [['description'], 'string'],
            [['status'], 'integer'],
            [['price'], 'number'],
            [['price', 'name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255]
        ], parent::rules());
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge([
            'id' => Yii::t('product', 'ID'),
            'name' => Yii::t('product', 'Name'),
            'image' => Yii::t('product', 'Image'),
            'picture' => Yii::t('product', 'Image'),
            'description' => Yii::t('product', 'Description'),
            'price' => Yii::t('product', 'Price'),
            'status' => Yii::t('product', 'Status'),
            'created_at' => Yii::t('product', 'Created At'),
            'updated_at' => Yii::t('product', 'Updated At'),
        ], parent::attributeLabels());
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'created_atAttribute' => 'created_at',
                'updated_atAttribute' => 'updated_at',
            ],
            'soft-delete' => [
                'class' => SoftDelete::className(),
                'attribute' => 'deleted_at',
            ],
        ]);
    }

}
