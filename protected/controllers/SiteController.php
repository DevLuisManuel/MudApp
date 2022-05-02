<?php

class SiteController extends Controller
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
				'actions'=>array('index','login','logout','error','captcha','page','cargarCiudades'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','dashboard'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex(){
		$this->layout='/layouts/login';
		$this->action_name = "Inicio";
		$model = new Cliente;

		$this->render('index',array("model"=>$model));

	}

	public function actionDashboard()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$model = new OrdenMudanza('search');
		$ind = array(
			'pendientes'=>OrdenMudanza::model()->count('estado=1'),
			'finalizadas'=>OrdenMudanza::model()->count('estado=5'),
			'canceladas'=>OrdenMudanza::model()->count('estado=6'),
			'inconsistencia'=>OrdenMudanza::model()->count('estado=7'),
			);
		$model->estado = 1;
		$adestino = OrdenMudanza::model()->findAll('estado = 4');
		$this->render('dashboard',array('model'=>$model,'ind'=>$ind,'adestino'=>$adestino));
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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(!Yii::app()->user->isGuest) $this->redirect('dashboard');
		$this->layout = "/layouts/login";
		$this->action_name ='Log In';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect('dashboard');
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionCargarCiudades(){
		$data=Ciudad::model()->findAll('departamento_id=:departamento', 
	   	array(':departamento'=>(int) $_POST['departamento_id']));
	 
	   $data=CHtml::listData($data,'id','nombre');
	 
	   echo "<option value=''>Seleccione ciudad</option>";
	   foreach($data as $key=>$value)
	   echo CHtml::tag('option', array('value'=>$key),CHtml::encode($value),true);
	}
}

