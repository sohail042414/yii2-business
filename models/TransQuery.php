<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Trans]].
 *
 * @see Trans
 */
class TransQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Trans[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Trans|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
