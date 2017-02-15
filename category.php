<?php

require_once('bootstrap.php');
//require_once '';

class Category extends MY_Controller {
    public function index() {
        Yii::$app->runAction('category');
    }
    
    public function create() {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        Yii::$app->runAction('category/create');
    }
    
    public function update() {
        Yii::$app->runAction('category/update', $this->input->get());
    }
}
