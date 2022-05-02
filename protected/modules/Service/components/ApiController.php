<?php

/**
 * ApiController
 */
class ApiController extends CController
{
	public $session_object = null;

	public function beforeAction($action){
		if(!YII_DEBUG)
		header("Content-type: application/json;charset=utf-8");
		header("Access-Control-Allow-Origin: *");
		return true;
	}

	public function getUser(){
		if($this->session_object){
			return $this->session_object->usuario;
		}

		return false;
	}
}