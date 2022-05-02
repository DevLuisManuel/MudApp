<?php

class ClientesModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'Clientes.models.*',
			'Clientes.components.*',
		));		

		Yii::app()->theme = 'adminLTE_cliente';

		$this->viewPath = Yii::getPathOfAlias("webroot.themes.adminLTE_cliente.views");
		
		Yii::app()->setComponents(array(
			'errorHandler'=>array(
				'errorAction'=>'/Clientes/default/error'
				),
			'user'=>array(
				'class'=>'CWebUser',
				'stateKeyPrefix'=>'clientes',
				'loginUrl'=>Yii::app()->createUrl('Clientes/default/login'),
				'returnUrl'=>Yii::app()->createUrl('Clientes/')
				)
			)
		);

		parent::init();
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
