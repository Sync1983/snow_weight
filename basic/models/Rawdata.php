<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rawdata".
 *
 * @property int $IMEI
 * @property string $date
 * @property string $geo
 * @property int $raw_data
 */
class Rawdata extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rawdata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['geo'], 'string'],
            [['raw_data'], 'default', 'value' => null],
            [['raw_data'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IMEI' => 'Imei',
            'date' => 'Date',
            'geo' => 'Geo',
            'raw_data' => 'Raw Data',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RawdataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RawdataQuery(get_called_class());
    }
}
