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
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $price
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 * @property integer $deletedAt
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
        return parent::find()->where(['deletedAt' => null]);
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
        return array_merge([
            'id' => Yii::t('catalog', 'ID'),
            'title' => Yii::t('catalog', 'Title'),
            'image' => Yii::t('catalog', 'Image'),
            'picture' => Yii::t('catalog', 'Image'),
            'description' => Yii::t('catalog', 'Description'),
            'price' => Yii::t('catalog', 'Price'),
            'status' => Yii::t('catalog', 'Status'),
            'createdAt' => Yii::t('catalog', 'Created At'),
            'updatedAt' => Yii::t('catalog', 'Updated At'),
        ], parent::attributeLabels());
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
            ],
            'soft-delete' => [
                'class' => SoftDelete::className(),
            ],
        ]);
    }

}
