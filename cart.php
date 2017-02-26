<?php

require_once('bootstrap.php');

class Cart extends BaseAdminController
{
    private $path = null;

    public function __construct()
    {
        parent::__construct();

        $pos = strpos($_SERVER['PATH_INFO'], 'bshop');
        $this->path = substr($_SERVER['PATH_INFO'], $pos+5)?:'shop/products/index';
    }

    /**
     * Lists all Brand models.
     * @return mixed
     */
    public function index()
    {
        echo $this->path;
        $response = Yii::$app->runAction($this->path, $this->input->get());

        if (is_string($response)) {
//            \CMSFactory\assetManager::create()
//                ->setData(
//                    ['content' => $response]
//                )
//            ->render('template/layout/main');
            echo $response;
        }

        if (is_object($response)) {
            $response->send();
        }
    }
    
    public  function element() {
        echo $this->path;
        $response = Yii::$app->runAction($this->path, $this->input->get());

        if (is_string($response)) {
//            \CMSFactory\assetManager::create()
//                ->setData(
//                    ['content' => $response]
//                )
//            ->render('template/layout/main');
            echo $response;
        }

        if (is_object($response)) {
            $response->send();
        }
    }
}