<?php

class DefaultController extends ApiController
{
	public function actionIndex()
	{
		echo $this->renderPartial('index');
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			echo json_encode(array("code"=>$error['code'],"message"=>$error['message']));
		}
	}
}