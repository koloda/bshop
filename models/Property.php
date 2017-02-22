<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%property}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $active
 *
 * @property PropertyValue[] $propertyValues
 */
class Property extends AActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%property}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['active'], 'integer'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('bshop', 'ID'),
            'title' => Yii::t('bshop', 'Title'),
            'active' => Yii::t('bshop', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValues()
    {
        return $this->hasMany(PropertyValue::className(), ['property_id' => 'id'])
            ->orderBy(['position' => SORT_ASC]);
    }
}
