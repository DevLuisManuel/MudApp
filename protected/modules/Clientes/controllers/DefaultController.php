<?php

class DefaultController extends Controller
{
	public function filters(){
		return array(
			'accessControl'
			);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('login','error','registro','logout'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{	
		$model = new OrdenMudanza('search');
		if(isset($_REQUEST['OrdenMudanza'])){
			$model->attributes = $_REQUEST['OrdenMudanza'];			
		}
		
		$model->cliente_id = $this->getUserInfo("id");;
		$model->estado = 4;
		
		$this->render('index',array('model'=>$model));
	}

	public function actionLogin(){
		$this->layout = '/layouts/login';
		$model = new ClienteLoginForm;

		if(isset($_POST['ClienteLoginForm']))
		{
			$model->attributes=$_POST['ClienteLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect('index');
		}

		$this->render('login',array('model'=>$model));
	}

	public function actionRegistro(){		
		$this->layout = '/layouts/login';
		$model = new Cliente;

		if(isset($_POST['Cliente'])){
			$model->attributes = $_POST['Cliente'];
			$model->estado = 1;
			if($model->validate()){
				$model->password = sha1($model->password);
				$model->repassword = $model->password;
				if($model->save()){
					Yii::app()->user->setFlash('success','El cliente registrado exitosamente');
					$this->redirect('login');
				}
			}
		}

		$this->render('registro',array('model'=>$model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout = '/layouts/login';

		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}