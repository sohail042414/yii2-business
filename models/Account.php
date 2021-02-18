<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%account}}".
 *
 * @property int $id
 * @property int $parent
 * @property string $title
 * @property string $type
 * @property int $created_at
 * @property int $updated_at
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%account}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'created_at', 'updated_at'], 'integer'],
            [['title', 'type'], 'required'],
            [['title'], 'string', 'max' => 32],
            [['type'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent' => Yii::t('app', 'Parent'),
            'title' => Yii::t('app', 'Name/Title'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccountQuery(get_called_class());
    }


    public function getParent()
    {
        return $this->hasOne(Account::className(), ['id' => 'parent']);
    }
}
