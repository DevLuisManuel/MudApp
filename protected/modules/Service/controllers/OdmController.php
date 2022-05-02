<?php

/**
 * Ordenes de Mudanza
 */
class OdmController extends ApiController
{
	public function filters(){
		return array(
			array('application.filters.SessionValidationFilter')
			);
	}

    public function actionIndex()
    {
     $usuario = $this->session_object->usuario;
     $recogidas = OrdenMudanza::model()->findAll('operario=? and estado=3',array($usuario->id));
     $entregas = OrdenMudanza::model()->findAll('operario=? and estado=4',array($usuario->id));
     $finalizadas = OrdenMudanza::model()->findAll('operario=? and estado in (5,6,7)',array($usuario->id));

     $data = array(
     		"recogidas"=>$this->listviewData($recogidas,true,"fecha_recojida"),
     		"entregas"=>$this->listviewData($entregas,true,"fecha_recojida"),
     		"finalizadas"=>$this->listviewData($finalizadas,true,"fecha_recojida"),
     	);   

     (new ResponseJSON(200,'OK'))->render($data);

    }

    private function listviewData($data,$origen=true,$fecha = "fecha_creacion"){
    	$output = array();
    	$col = $origen?'_origen':'_destino';
    	$ciudad = $origen?'ciudadOrigen':'ciudadDestino';



    	foreach ($data as $key => $value) {
    		$output[] = array(
    			'id'=>$value->id,
    			'fecha'=>$value->{$fecha},
    			'nombre'=>$value->{'responsable'.$col},
    			'direccion'=>$value->{'direccion'.$col},
    			'ciudad'=>$value->{$ciudad}->nombre.", ".$value->{$ciudad}->departamento->nombre
    			);
    	}

    	return $output;
    }

    public function actionView($id){
    	$model = OrdenMudanza::model()->findByPk($id);
    	if(!$model) $model = array();
    	else{
    		$data = $model->attributes;
    		unset($data["creador"]);
    		unset($data["cliente_id"]);
    		unset($data["operario"]);
    		$data["ciudad_origen"]=$model->ciudadOrigen->getCiudadCompleto();
    		$data["ciudad_destino"]=$model->ciudadDestino->getCiudadCompleto();
    		$data["nombre_cliente"]=$model->cliente->getNombreCompleto();
    		$data["direccion_cliente"]=$model->cliente->direccion." ".$model->cliente->ciudad->getCiudadCompleto();
    		$data["telefono_cliente"]=$model->cliente->telefono;
    		$data["email_cliente"]=$model->cliente->email;
    		$data["asegurado"]=$model->asegurado?"Si":"No";
    		$data["embalaje"]=$model->embalaje?"Si":"No";
            $data["estado_text"]=$model->getEstados();

    		$model = $data;
    	}
    	(new ResponseJSON(200,'OK'))->render($model);
    }

    public function actionItems($id){
        $this->getItems($id);
    }

    public function actionItemsAgregados($id){
        $this->getItems($id,1);
    }

    public function actionItemsConfirmados($id){
        $this->getItems($id,2);
    }

    public function getItems($id,$estado=null){
        $data = OrdenMudanzaItem::model()->findAll('orden_mudanza_id=?'.($estado!==null?' AND estado='.$estado:''),array($id));
        $arr = array();
        foreach ($data as $key => $value) {
            $arr[] = array(
                'id'=>$value->id,
                'titulo'=>$value->titulo,
                'descripcion'=>$value->descripcion,
                'categoria'=>$value->categoria->nombre,
                'codigo'=>$value->codigo
                );
        }
        (new ResponseJSON(200,'OK'))->render(array("items"=>$arr));   
    }

    public function actionAddItem($id){
        $user = $this->session_object->usuario;
        $model = OrdenMudanza::model()->find('id=? AND operario=? AND estado = 3',array($id,$user->id));
        if($model){

            $item = new OrdenMudanzaItem;            
            if(isset($_POST['OrdenMudanzaItem'])){
                $item->attributes = $_POST['OrdenMudanzaItem'];
                $item->orden_mudanza_id = $id;
                $item->estado = 1;

                if($item->validate()){
                    $existe = OrdenMudanzaItem::model()->find('codigo=? AND orden_mudanza_id=?',array($item->codigo,$id));
                    if($existe){
                        (new ResponseJSON(403,'Ya existe el codigo que desea agregar',true))->render();
                    }

                    if($item->save()){
                        (new ResponseJSON(200,'OK'))->render(array('status'=>'success','msg'=>'Item agregado'));
                    }
                    else{
                        (new ResponseJSON(404,'Error al guardar el item',true))->render();
                    }
                }
                
            }
            else{
                (new ResponseJSON(400,'Petición invalida'))->render();                
            }            
        }

        (new ResponseJSON(403,'No tiene permisos para realizar esta acción'))->render();
    }

    public function actionEntregaItem(){
        $model = new OrdenMudanzaItem('entrega');
        if(isset($_POST['item'])){
            $model->attributes = $_POST['item'];
            if($model->validate()){
                $result = OrdenMudanzaItem::model()->find('codigo=? AND orden_mudanza_id=? AND estado=2',array($model->codigo,$model->orden_mudanza_id));
                if($result){
                    $result->estado = 3;
                    if($result->save()){
                        (new ResponseJSON(200,'OK'))->render(array('status'=>'success','msg'=>'Item actualizado'));
                    }
                    (new ResponseJSON(404,'Error al actualizar el item'))->render();
                }
                
                (new ResponseJSON(404,'El item no existe o ya ha sido descargado'))->render();
            }
        }

        (new ResponseJSON(400,'Petición invalida'))->render();

    }

    public function actionGeo(){
        $user = $this->session_object->usuario;
        if(isset($_POST['OrdenMudanza']['location'])){
            $update = OrdenMudanza::model()->updateAll(
                array(
                    'location'=>$_POST['OrdenMudanza']['location']
                    ),
                'operario=? and estado = 4',
                array($user->id)
                );
           
        (new ResponseJSON(200,'OK'))->render(array('updates'=>$update));

        }

        (new ResponseJSON(400,'Invalid request'))->render();
    }

    public function actionDeleteItem($id){        
        $model = OrdenMudanzaItem::model()->find('id=? AND estado=1',array($id));
        if($model){
            if($model->delete()){
                (new ResponseJSON(200,'OK'))->render(array('status'=>'success'));
            }
        }
        (new ResponseJSON(400,'Petición invalida'))->render();
    }

    public function actionConfirmar($id){
        $user = $this->session_object->usuario;
        $action = OrdenMudanza::model()->find('id=? AND estado=3 AND operario=?',array($id,$user->id));        
        if($action){
            if(count($action->ordenMudanzaItems)==0){
                (new ResponseJSON(404,'Debe haber almenos 1 item para confirmar la mudanza'))->render();
            }

            $transaccion = Yii::app()->db->beginTransaction();
            $updates = OrdenMudanzaItem::model()->updateAll(array('estado'=>2),'orden_mudanza_id=? AND estado = 1',array($id));
            $action->estado = 4;
            $action->departamento_destino = 0;
            $action->departamento_origen = 0;
            if($action->save()){
                $transaccion->commit();
                (new ResponseJSON(200,'Orden confirmada y en proceso de entrega'))->render(array('status'=>'success'));
            }
            else{
                $transaccion->rollback();
                (new ResponseJSON(404,'Error al confirmar la orden de mudanza. '.print_r($action->getErrors(),true)))->render();

            }         
        }

        (new ResponseJSON(403,'No tiene permisos para realizar esta acción'))->render();

    }

    public function actionConfirmarEntrega($id){
        $user = $this->session_object->usuario;
        $action = OrdenMudanza::model()->find('id=? AND estado=4 AND operario=?',array($id,$user->id));        
        if($action){
            if(count($action->ordenMudanzaItems)==0){
                (new ResponseJSON(404,'Debe haber almenos 1 item para confirmar la mudanza'))->render();
            }

            $estado = 5;
            $result = OrdenMudanzaItem::model()->findAll('orden_mudanza_id=? AND estado!=3',array($id));
            if(count($result)!=0) $estado = 7;


            $transaccion = Yii::app()->db->beginTransaction();
            $updates = OrdenMudanzaItem::model()->updateAll(array('estado'=>4),'orden_mudanza_id=? AND estado = 3',array($id));
            if($estado==7){
                $updates = OrdenMudanzaItem::model()->updateAll(array('estado'=>5),'orden_mudanza_id=? AND estado != 4',array($id));    
            }
            $action->estado = $estado;
            $action->departamento_destino = 0;
            $action->departamento_origen = 0;
            if($action->save()){
                $transaccion->commit();
                (new ResponseJSON(200,'Orden confirmada y entregada'))->render(array('status'=>'success'));
            }
            else{
                $transaccion->rollback();
                (new ResponseJSON(404,'Error al confirmar la orden de mudanza. '.print_r($action->getErrors(),true)))->render();

            }         
        }

        (new ResponseJSON(403,'No tiene permisos para realizar esta acción'))->render();

    }
}