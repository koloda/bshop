<?php

namespace app\controllers\shop;

use yii\web\Controller;

class ProductsController extends Controller
{
    public function actionIndex()
    {
        return $this->actionNew();
    }

    public function actionNew()
    {
        $products = \app\models\Product::findAll(['active' => true]);

        return $this->renderPartial('new', ['products' => $products]);
    }
}
