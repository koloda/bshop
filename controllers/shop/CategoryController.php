<?php

namespace app\controllers\shop;

use yii\web\Controller;
use app\models\CategorySearch;

class CategoryController extends Controller
{
    public function actionIndex($identifier=null)
    {
    	if (!$identifier || !$category = CategorySearch::identify($identifier)) {
    		throw new \yii\web\NotFoundHttpException;
    	}

    	return $this->renderPartial('index', ['category' => $category]);
    }
}
