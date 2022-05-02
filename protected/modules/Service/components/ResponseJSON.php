<?php 
/**
* ResponseJSON
*/
class ResponseJSON
{
	public $code;
	public $message;
	

	function __construct($code,$message)
	{
		$this->code = $code;
		$this->message = $message;
	}

	public function render($data=null,$return=false,$yiiend=true){
		if($data!==null) $this->data = $data;
		if($return) return json_encode($this);
		else echo json_encode($this);

		if($yiiend) Yii::app()->end();
	}
}
 ?>