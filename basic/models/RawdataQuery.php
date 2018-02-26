<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Rawdata]].
 *
 * @see Rawdata
 */
class RawdataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Rawdata[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Rawdata|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
