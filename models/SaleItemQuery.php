<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SaleItem]].
 *
 * @see SaleItem
 */
class SaleItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SaleItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SaleItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
