<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public function authenticate()
	{
		$user = Usuario::model()->findByAttributes(array('username'=>$this->username));
		if($user==null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($user->password!==sha1($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->errorCode=self::ERROR_NONE;
			Yii::app()->user->setState('userinfo',$user->attributes);
		}
		return !$this->errorCode;
	}
}