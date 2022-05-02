<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{	
	public $controller_name = __CLASS__;
	public $action_name = "";	
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function filters(){
		return array(
			array('ext.yiibooster.filters.BoosterFilter - delete')
			);
	}

	public function getMenuName(){
		return __CLASS__;
	}

	public function getMenuItems(){
		return array(
			array("title"=>"Inicio","url"=>"/site/index")
			);
	}

	public function getUserInfo($key){
		$info =  Yii::app()->user->getState('userinfo');
		return @$info[$key];
	}
}