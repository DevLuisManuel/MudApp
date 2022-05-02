<?php

class OrdenMudanzaController extends Controller
{
	public $controller_name = "Orden de Mudanza";
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','confirmar','cancelar','asignar','delete','items'),
				'users'=>array('@'),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$odmi = new OrdenMudanzaItem;
		$odmi->orden_mudanza_id = $id;
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'odmi'=>$odmi
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new OrdenMudanza;
		$search=new Cliente('search');
		$cliente=null;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OrdenMudanza']))
		{
			$userinfo = Yii::app()->user->getState('userinfo');
			$model->attributes=$_POST['OrdenMudanza'];
			$model->fecha_creacion = date('Y-m-d H:i:s');
			$model->creador = $userinfo['id'];
			$model->estado = 1;

			if($model->cliente_id!=null){
				$cliente = Cliente::model()->findByPk($model->cliente_id);
			}

			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}
			else{
				Yii::app()->user->setFlash('error','Error al crear la orden de mudanza, vuelva a intentar nuevamente.');
			}
			
		}
		else{
			if(isset($_POST['Cliente'])){
				$search->attributes = $_POST['Cliente'];
				$req = Cliente::model()->findByAttributes(array('tipo_documento_id'=>$search->tipo_documento_id,'documento'=>$search->documento));
				if($req){
					$cliente = $req;
				}
				

			}
		}

		$this->render('create',array(
			'model'=>$model,
			'cliente'=>$cliente,
			'search'=>$search
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OrdenMudanza']))
		{
			$model->attributes=$_POST['OrdenMudanza'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new OrdenMudanza('search');

		if(isset($_GET['OrdenMudanza'])){
			$model->attributes = $_GET['OrdenMudanza'];
		}
		
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new OrdenMudanza('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OrdenMudanza']))
			$model->attributes=$_GET['OrdenMudanza'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OrdenMudanza the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OrdenMudanza::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OrdenMudanza $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='orden-mudanza-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionConfirmar($id){	
		$model = OrdenMudanza::model()->findByPk($id);
		if($model){
			$model->setScenario('update_estado');
			if($model->estado==1){
				$model->estado = 2;
				$model->save();
			}
		}

		$this->redirect(array('OrdenMudanza/view/'.$id));

	}

	public function actionCancelar($id){
		$model = OrdenMudanza::model()->findByPk($id);
		if($model){
			$model->setScenario('update_estado');
			if($model->estado <= 3){
				$model->estado = 6;
				$model->save();
			}
		}
		
		$this->redirect(array('OrdenMudanza/view/'.$id));

	}

	public function actionAsignar($id){
		$model = OrdenMudanza::model()->findByPk($id);
		if($model){
			if(isset($_POST['OrdenMudanza'])){
				$model->setScenario('asignar');
				$model->attributes = $_POST['OrdenMudanza'];
				$model->estado = 3;
				if($model->save()){
					$this->redirect(array('ordenMudanza/view/'.$id));
				}
			}
		}
		else{
			$this->redirect(array('ordenMudanza/view/'.$id));
		}

		$this->render('asignar',array("model"=>$model));
	}

	public function actionItems($id,$cat=null){
		$model = $this->loadModel($id);
		echo $this->renderPartial('_items',array('model'=>$model,'cat'=>$cat));
	}


}
