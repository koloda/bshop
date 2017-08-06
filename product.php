<?php

require_once('bootstrap.php');

/**
 * Controller for front-end (Product)
 */

class Product extends MY_Controller
{
    private $identifier = null;

    public function __construct()
    {
        parent::__construct();
        $this->identifier = str_replace('/bshop/product/', '', $_SERVER['PATH_INFO']);
        $this->view();
    }

    public function view()
    {
        $response = Yii::$app->runAction('shop/product/index', ['identifier' => $this->identifier]);
        // var_dump($response);exit;
        $this->processResponse($response);
        exit;
    }

    //@todo: move this method to parent bshop-front class
    protected function processResponse($response)
    {
        if (is_string($response)) {
              \CMSFactory\assetManager::create()
               ->setData(
                   ['content' => $response]
               )
           ->render('template/layout/main');
           exit;
        }

        if (is_object($response)) {
            $response->send();
            exit;
        }
    }
}
