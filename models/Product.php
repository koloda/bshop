<?php

namespace app\models;

use Yii;
use sjaakp\illustrated\Illustrated;
use romi45\seoContent\components\SeoBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $sku
 * @property double $price
 * @property string $picture
 * @property integer $category_id
 * @property integer $available
 * @property integer $active
 * @property integer $brand_id
 * @property integer $gallery_id
 * @property string $created_at
 * @property integer $updated_at
 * @property string $slug
 *
 * @property Category $category
 * @property Brand $brand
 */
class Product extends \yii\db\ActiveRecord implements \pistol88\cart\interfaces\CartElement
{
    use CartElementTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
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
                'directory' => '@app/web/uploads/images/shop/product',
                'illustrationDirectory' => 'application/modules/bshop/web/uploads/images/shop'
            ],
            'seo' => [
                'class' => SeoBehavior::className(),
                'titleAttribute' => 'seoTitle',
                'keywordsAttribute' => 'seoKeywords',
                'descriptionAttribute' => 'seoDescription'
            ],
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'product',
                'extension' => 'png',
                'directory' => Yii::getAlias('@webroot') . '/application/modules/bshop/uploads/images/shop/product/gallery',
                'url' => Yii::getAlias('@web') . '/application/modules/bshop/uploads/images/shop/product/gallery',
                'versions' => [
                    'xs' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(120, 120));
                    },
                    's' => function ($img) {
                    /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(240, 240));
                    },
                    'm' => function ($img) {
                    /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(480, 480));
                    },
                    'l' => function ($img) {
                        /** @var Imagine\Image\ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 960;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'price', 'slug'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['category_id', 'available', 'active', 'brand_id', 'gallery_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 256],
            [['sku'], 'string', 'max' => 64],
            [['picture'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
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
            'description' => Yii::t('bshop', 'Description'),
            'sku' => Yii::t('bshop', 'Sku'),
            'price' => Yii::t('bshop', 'Price'),
            'picture' => Yii::t('bshop', 'Picture'),
            'category_id' => Yii::t('bshop', 'Category'),
            'available' => Yii::t('bshop', 'Available'),
            'active' => Yii::t('bshop', 'Active'),
            'brand_id' => Yii::t('bshop', 'Brand'),
            'gallery_id' => Yii::t('bshop', 'Additional pictures'),
            'created_at' => Yii::t('bshop', 'Created'),
            'updated_at' => Yii::t('bshop', 'Updated'),
            'slug' => Yii::t('bshop', 'Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }
}
