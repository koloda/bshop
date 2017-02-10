<?php

namespace app\models;

use sjaakp\illustrated\Illustrated;
use romi45\seoContent\components\SeoBehavior;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            'illustrated' => [
                "class" => Illustrated::className(),
                "attributes"    => [
                    "picture"   => [
                        'cropSize'  => 960,
                        'aspectRatio'   => 1,
                        'sizeSteps' => 4,
                        'allowTooSmall'  => true
                    ],
                ],
                'directory' => '@app/web/uploads/images/shop/category',

            ],
            'seo' => [
                'class' => SeoBehavior::className(),

                // This is default values. Usually you can not specify it
                'titleAttribute' => 'seoTitle',
                'keywordsAttribute' => 'seoKeywords',
                'descriptionAttribute' => 'seoDescription'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['seoTitle', 'seoKeywords', 'seoDescription'], 'safe'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('bshop', 'ID'),
            'parent_id' => Yii::t('bshop', 'Parent category'),
            'title' => Yii::t('bshop', 'Title'),
            'description' => Yii::t('bshop', 'Description'),
            'created_at' => Yii::t('bshop', 'Created At'),
            'updated_at' => Yii::t('bshop', 'Updated At'),
        ];
    }

    public function getParent() {
        // return $this
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    public function selectList($without = 0) {
        return Category::find()
            ->select(['title'])
            ->where('id <> ' . (int)$without)
            ->indexBy('id')
            ->column();
    }

    public function search() {
        
    }
}
