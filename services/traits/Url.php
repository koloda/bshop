<?php

namespace app\services\traits;

trait Url
{
   	/**
	 * Generete and return model url with slug, if exists, or with id
	 *
	 * @param  yii\db\ActiveRecord $model
	 * @return string
	 */
    public static function getUrl($model)
    {
        return '/bshop/' . self::$urlBase . '/' . $model->slug?:$model->id;
    }
}