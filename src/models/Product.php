<?php

namespace nullref\product\models;

use nullref\core\models\Model as BaseModel;
use nullref\product\Module;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $price
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 */
class Product extends BaseModel implements IProduct
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 1;

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return ProductQuery
     * @throws \yii\base\InvalidConfigException
     */
    public static function find()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('product');
        $className = $module->productQueryModelClass;
        return new $className(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
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
            [['price', 'title'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title', 'image'], 'string', 'max' => 255]
        ], parent::rules());
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'title' => Yii::t('catalog', 'Title'),
            'image' => Yii::t('catalog', 'Image'),
            'picture' => Yii::t('catalog', 'Image'),
            'description' => Yii::t('catalog', 'Description'),
            'price' => Yii::t('catalog', 'Price'),
            'status' => Yii::t('catalog', 'Status'),
            'createdAt' => Yii::t('catalog', 'Created At'),
            'updatedAt' => Yii::t('catalog', 'Updated At'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
            ],
        ]);
    }

}
