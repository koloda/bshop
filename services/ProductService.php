<?php

namespace app\services;

/**
* Product service class
* Contains all additional product functionality to get tiny Product model
*/
class ProductService extends BaseModelService
{
    use traits\Url;
    private static $urlBase = 'product';

    /**
     * @param  app\models\Product $product
     * @return string
     */
    public static function getCategoryTitle($product)
    {
        return $product->category->title;
    }

    /**
     * @param  app\models\Product $product
     * @return string
     */
    public static function getBrandTitle($product)
    {
        return $product->brand->title;
    }

    public static function getFPrice($product)
    {
    	$fprice = '';

    	//@todo: get it from config
    	$currency = '$';
    	//@todo: use config values in condition
    	if (1) {
    		$fprice = "{$currency}{$product->price}";
    	} else {
    		$fprice = "{$product->price}{$currency}";
    	}

    	return $fprice;
    }
}