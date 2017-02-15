<?php

namespace app\models;

use Yii;
use romi45\seoContent\components\SeoBehavior;
use sjaakp\illustrated\Illustrated;

/**
 * This is the model class for table "{{%brand}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $active
 * @property string $slug
 * @property string $picture
 *
 * @property Product[] $products
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%brand}}';
    }
    
    public function behaviors()
    {
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
                'directory' => '@app/web/uploads/images/shop/brand',
                'illustrationDirectory' => 'application/modules/bshop/web/uploads/images/shop'
            ],
            'seo' => [
                'class' => SeoBehavior::className(),
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
            [['title', 'slug', 'active'], 'required'],
            [['description'], 'string'],
            [['active'], 'integer'],
            [['picture', 'title', 'slug'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('bshop', 'ID'),
            'title' => Yii::t('bshop', 'Brand Name'),
            'description' => Yii::t('bshop', 'Description'),
            'active' => Yii::t('bshop', 'Active'),
            'slug' => Yii::t('bshop', 'Slug'),
            'picture' => Yii::t('bshop', 'Picture'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['brand_id' => 'id']);
    }

    public static function selectList($except = 0)
    {
        return Brand::find()
            ->select(['title'])
            ->where('id <> ' . (int)$except)
            ->indexBy('id')
            ->column();
    }
}
