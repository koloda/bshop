<?php

namespace app\controllers\shop;

use yii\web\Controller;

/**
* Base controller class for ImageCMS (front-end)
*/
class BaseImageCMSController extends Controller
{
	/**
	 * Replace default rendering with ImageCMS Mabilis
	 *
	 * {@inheritdoc}
	 */
	public function renderPartial($view, $params)
	{
		$CI = \CI_Controller::get_instance();
		$CI->config->set_item('template', 'businessimage');
		//@todo: in future add checkin if it's ImageCMS or native Yii app
        return \CMSFactory\assetManager::create()
           	->setData($params)
       		->render($view);
	}
}