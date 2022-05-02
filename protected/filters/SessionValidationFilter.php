<?php 
/**
 * Valida session de usuario
 */
 class SessionValidationFilter extends CFilter
 {
 	
 	protected function preFilter($filterChain){        
 		$session = new Appsession('validacion');
        if(isset($_REQUEST['Appsession'])){
            $session->attributes = $_REQUEST['Appsession'];
            if($session->validate()){
                $session = Appsession::model()->with('usuario')->together()->find('usuario_id=? AND `key`=? AND expire > now() AND usuario.estado = 1',array($session->uid,$session->key));
                if($session){
                	$filterChain->controller->session_object = $session;
                    return true;
                }
                else{
                    (new ResponseJSON(403,'Su sesión es invalida o ha expirado'))->render();
                    return false;
                }
            }
        }
        (new ResponseJSON(400,"Error de validación"))->render();
        return false;

 	}	

 	protected function postFilter($filterChain){

 	}
 } 

 ?>