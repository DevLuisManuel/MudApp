<?php

class ResetPasswordForm extends CFormModel
{

	public $actual;
	public $nueva;
	public $re_nueva;
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('actual,nueva,re_nueva','required','message'=>'{attribute} no puede ser nulo'),
			array('nueva,re_nueva','length','min'=>'6','message'=>"{attribute} debe tener minimo {min} caractéres"),
			array('actual','validaActual'),
			array('re_nueva','compare','compareAttribute'=>'nueva','message'=>'Las contraseñas no coinciden'),			

		);
	}

	public function validaActual($attribute,$params){

		$password = Yii::app()->controller->getUserInfo("password");
		if($password!=sha1($this->{$attribute})){
			$this->addError('actual','La contraseña actual no es correcta.');
		}
	}

	/**
	 * @return array customized attribute labels (name=&gt;label)
	 */
	public function attributeLabels()
	{
		return array(
			'actual'=>'Contraseña actual',
			'nueva'=>'Nueva contraseña',
			're_nueva'=>'Confirme la nueva contraseña'
		);
	}
}