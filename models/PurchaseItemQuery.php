<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PurchaseItem]].
 *
 * @see PurchaseItem
 */
class PurchaseItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PurchaseItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PurchaseItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
