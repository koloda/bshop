<?php

namespace app\controllers\shop;

use app\controllers\shop\BaseImageCMSController;
use app\models\CategorySearch;
use app\services\CategoryService;

class CategoryController extends BaseImageCMSController
{
    public function actionIndex($identifier=null)
    {
    	if (!$identifier || !$category = CategorySearch::identify($identifier)) {
    		throw new \yii\web\NotFoundHttpException;
    	}
        $page = (int)\Yii::$app->request->get('page');
    	$data = CategoryService::getPaginatedProducts($category, $page);

    	return $this->renderPartial('category/index', [
    		'category' 	=> $category,
    		'models'	=> $data['models'],
    		'pagination'	=> $data['pagination']
    		]
		);
    }
}
