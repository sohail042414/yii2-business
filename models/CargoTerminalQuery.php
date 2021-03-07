<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CargoTerminal]].
 *
 * @see CargoTerminal
 */
class CargoTerminalQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CargoTerminal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CargoTerminal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
