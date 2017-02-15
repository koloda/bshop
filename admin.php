<?php

require_once('bootstrap.php');

class Admin extends BaseAdminController
{
    private $path = null;

    public function __construct()
    {
        parent::__construct();
        
        $pos = strpos($_SERVER['PATH_INFO'], 'bshop');
        $this->path = substr($_SERVER['PATH_INFO'], $pos+5);
    }
    
    public function index()
    {
        if (!$this->path) {
            $this->path = 'category';
        }
        
        $this->processAction();
    }
    
    public function brand()
    {
        $this->processAction();
    }
    
    public function category()
    {
        $this->processAction();
    }
    
    public function product()
    {
        $this->processAction();
    }
    
    public function property()
    {
        $this->processAction();
    }
    
    private function processAction()
    {
        $response = Yii::$app->runAction($this->path, $this->input->get());
        
        if (is_string($response)) {
//            \CMSFactory\assetManager::create()
//                ->setData(
//                    ['content' => $response]
//                )
//            ->renderAdmin('admin');
            
            echo $response;
        }
        
        if (is_object($response)) {
            $response->send();
        }
    }
}
