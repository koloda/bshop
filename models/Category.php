<?php

namespace app\models;

use Yii;
use sjaakp\illustrated\Illustrated;
use romi45\seoContent\components\SeoBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $picture 
 * 
 * @property Product[] $products 
 */
class Category extends \yii\db\ActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
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
                'directory' => '@app/web/uploads/images/shop/category',
                'illustrationDirectory' => 'uploads/images/shop'
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
            [['title', 'slug'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'picture', 'slug'], 'string', 'max' => 255],
            [['seoTitle', 'seoKeywords', 'seoDescription'], 'safe'],
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
            'parent_id' => Yii::t('bshop', 'Parent category'),
            'title' => Yii::t('bshop', 'Title'),
            'description' => Yii::t('bshop', 'Description'),
            'created_at' => Yii::t('bshop', 'Created At'),
            'updated_at' => Yii::t('bshop', 'Updated At'),
            'picture' => Yii::t('bshop', 'Picture'), 
        ];
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getParent() 
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    public static function selectList($except = 0)
    {
        return Category::find()
            ->select(['title'])
            ->where('id <> ' . (int)$except)
            ->indexBy('id')
            ->column();
    }

    //@TODO: implement this
    public function search() 
    {
        
    }
}
