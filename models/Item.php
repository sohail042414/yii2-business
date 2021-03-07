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
            [['category','item_no', 'name','purchase_price','sale_price','weight','weight_unit','count_unit','type'], 'required'],
            [['category','item_no', 'created_at','weight' ,'updated_at','purchase_price','sale_price'], 'integer'],
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
            'type' => Yii::t('app', 'Type'),
            'item_no'  => Yii::t('app', 'Item No'),
            'count_unit' => Yii::t('app', 'Count Unit'),            
            'weight' => Yii::t('app', 'Weight'),            
            'category' => Yii::t('app', 'Category'),
            'purchase_price' => Yii::t('app', 'Purchase Price (Per Kg)'),
            'sale_price' => Yii::t('app', 'Sale Price (Per Kg)'),
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

    public function getTypesList(){
        return [
            'wholesale'=>'Whole Sale',
            'retail' => 'Retail'
        ];
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
    }

    public static function getDropdownList(){
        
        $data = self::find()->all();

        $list = array();

        foreach($data as $item){
            $list[$item->id] = '['.$item->item_no.'] '.$item->name.'';
        }

        return $list;


    }
}
