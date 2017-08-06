<?php

namespace app\controllers\shop;

use app\controllers\shop\BaseImageCMSController;
use app\models\ProductSearch;

class ProductController extends BaseImageCMSController
{
    public function actionIndex($identifier=null)
    {
    	if (!$identifier || !$product = ProductSearch::identify($identifier)) {
    		throw new \yii\web\NotFoundHttpException;
    	}

    	return $this->renderPartial('product/index', ['product' => $product]);
    }
}
