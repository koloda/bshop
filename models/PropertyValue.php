<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bs_property_value".
 *
 * @property integer $id
 * @property integer $property_id
 * @property string $value
 * @property integer $position
 */
class PropertyValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bs_property_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [['property_id', 'value'], 'required'],
            [['property_id', 'position'], 'integer'],
            [['value'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('bshop', 'ID'),
            'property_id' => Yii::t('bshop', 'Property ID'),
            'value' => Yii::t('bshop', 'Value'),
            'position'  => Yii::t('bshop', 'Position')
        ];
    }

    public static function createNNewObjects($n) {
        $result = [];
        for ($i = 0; $i < $n; $i++) {
            $result[] = new PropertyValue;
        }

        return $result;
    }
}
