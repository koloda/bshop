<?php

namespace app\controllers\shop;

use app\controllers\shop\BaseImageCMSController;
use app\models\CategorySearch;

class CategoryController extends BaseImageCMSController
{
    public function actionIndex($identifier=null)
    {
    	if (!$identifier || !$category = CategorySearch::identify($identifier)) {
    		throw new \yii\web\NotFoundHttpException;
    	}

    	return $this->renderPartial('category/index', ['category' => $category]);
    }
}
