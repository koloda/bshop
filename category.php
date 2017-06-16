<?php

require_once('bootstrap.php');

/**
 * Controller for front-end (Category)
 */

class Category extends MY_Controller
{
    private $identifier = null;

    public function __construct()
    {
        parent::__construct();
        if (strpos($_SERVER['PATH_INFO'], '/bshop/category/list')) {
            $this->viewList();
        } else {
            $this->identifier = str_replace('/bshop/category/', '', $_SERVER['PATH_INFO']);
            $this->view();
        }

    }

    public function view()
    {
        $response = Yii::$app->runAction('shop/category/index', ['identifier' => $this->identifier]);
        $this->processResponse($response);
        exit;
    }

    public function viewList()
    {

    }

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
