<?php 

use CMSFactory\assetManager;
use CMSFactory\Events;


class Bshop {
    public function __construct() {
        require_once('bootstrap.php');    
    }

    public function index() {
        ini_set('display_errors', true);
        error_reporting(E_ALL^E_NOTICE);
        
        echo 'B-Shop Alive!!!';
        Yii::$app->runAction('product');
        //exit;
    }
    
    public function category() {
        echo 'sadfsdfsdf';
        
        Yii::$app->runAction('category/create');
 //       Yii::$app->runAction('category/index');
    }
}
