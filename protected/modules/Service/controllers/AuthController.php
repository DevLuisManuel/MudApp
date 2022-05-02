<?php

/**
 * Autenticación de operarios
 */
class AuthController extends ApiController
{
	public function filters(){
		return array(
			'postOnly + index',
            array('application.filters.SessionValidationFilter - index'),
		);
	}
    public function actionIndex()
    {
    	$user = new Usuario('login');
        if(isset($_POST['Usuario'])){
        	$user->attributes = $_POST['Usuario'];
        	if($user->validate()){
        		$res = Usuario::model()->find('username=? AND rol=2 AND estado=1',array($user->username));
        		if($res){
        			if($res->password==sha1($user->password)){
        				$time = time();
        				$session = new Appsession();
        				$session->usuario_id = $res->id;
        				$session->key = $this->keygen();
        				$session->created = date('Y-m-d H:i:s',$time);
        				$session->expire = date('Y-m-d H:i:s',strtotime("+3 month",$time));
        				if($session->save()){
        					(new ResponseJSON(200,'OK'))->render(array(
        							'key'=>$session->key,
        							'uid'=>$res->id,
        							'username'=>$res->username,
        							'nombre'=>$res->nombre,
        							'apellido'=>$res->apellido
        							)
        						);
        				}
        				else{
        					(new ResponseJSON(500,'Error al generar la sesión'))->render();
        				}
        			}

        		}

        		(new ResponseJSON(403,'Login inválido'))->render();
        	}
        }   

    	(new ResponseJSON(400,'Petición inválida'))->render();
    }

    public function actionInfo(){
        $user = $this->session_object->usuario;
        (new ResponseJSON(200,'OK'))->render(array(
                'username'=>$user->username,
                'nombre'=>$user->nombre,
                'apellido'=>$user->apellido
                )
            );
    }

    public function actionLogout(){
        $delete = Appsession::model()->deleteByPk($this->session_object->id);
        if($delete){
            (new ResponseJSON(200,'OK'))->render(array("logout_status"=>"success"));
        }
        (new ResponseJSON(404,'No se pudo cerrar la sesión'))->render();

    }

    private function keygen($size=50){
    	$ascii = array(
    		array(48,57), //Numeros
    		array(65,90), //Letras mayusculas
    		array(97,122),//Letras minusculas
    	);
    	$key = "";
    	for($i=0;$i<$size;$i++){
    		$sec1 = $ascii[rand(0,count($ascii)-1)];    		
    		$key .= chr(rand($sec1[0],$sec1[1]));
    	}

    	return $key;
    }

}