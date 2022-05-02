<?php

class ReportesController extends Controller
{	

	public function filters(){
		return array(
			'accessControl'
			);
	}

	public function accessRules(){
		return array(
			array('allow',
				'actions'=>array('index'),
				'users'=>array('@')
			),
			array('deny',
				'users'=>array('*')
			)
		);
	}

	public function actionIndex()
	{
		$model1 = new OrdenMudanza('search');
		$model3 = new Usuario('search');	

		$model1->fecha_creacion = date("Ym");

		if(isset($_GET['OrdenMudanza'])){
			$model1->attributes = $_GET['OrdenMudanza'];			
		}
		
		$this->render('index',array('model1'=>$model1));

	}
	
}