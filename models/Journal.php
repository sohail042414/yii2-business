<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "journal".
 *
 * @property int $id
 * @property string $journal_number
 * @property string|null $type
 * @property string $journal_date
 * @property string|null $description
 * @property string|null $status
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_at
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'description', 'status'], 'string'],
            [['journal_date', 'created_at', 'updated_at'], 'required'],
            [['journal_date'], 'safe'],
            [['created_by', 'created_at', 'updated_at'], 'integer'],
            [['journal_number'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'journal_number' => Yii::t('app', 'Journal Number'),
            'type' => Yii::t('app', 'Type'),
            'journal_date' => Yii::t('app', 'Journal Date'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return JournalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JournalQuery(get_called_class());
    }
}
