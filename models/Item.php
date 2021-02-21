<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use app\models\Category;
use app\models\SaleItem;
use app\models\PurchaseItem;

/**
 * This is the model class for table "{{%item}}".
 *
 * @property int $id
 * @property int $category
 * @property string $name
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 */
class Item extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'name','purchase_price','sale_price','weight'], 'required'],
            [['category', 'created_at','weight' ,'updated_at','purchase_price','sale_price'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'Category'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemQuery(get_called_class());
    }

    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::className(), ['item_id' => 'id']);
    }

    public function getPurchaseItems()
    {
        return $this->hasMany(PurchaseItem::className(), ['item_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
        // return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
