<?php 

require_once('bootstrap.php');

use CMSFactory\assetManager;
use CMSFactory\Events;

use Yii;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



class Bshop {
    public function getViewPath() {
        return Yii::getAlias('@app/views/category');
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Brand models.
     * @return mixed
     */
    public function index()
    {
        Yii::$app->runAction('category/index');
        //Yii::$app->controller = $this;
        //var_dump(Yii::$app->controller); exit;
    
        //echo Yii::getAlias('@app/views');exit;
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);

        echo  $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
        exit;
    }
    
    public function category() {
        echo 'sadfsdfsdf';
        
        Yii::$app->runAction('category/create');
 //       Yii::$app->runAction('category/index');
    }
}
