<?php
/* @var $this OrdenMudanzaController */
/* @var $model OrdenMudanza */

$this->breadcrumbs=array(
	'Orden Mudanzas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Lista de Ordenes de Mudanza', 'url'=>array('index'), 'icon'=>'fa fa-list'),
	array('label'=>'Crear Orden de Mudanza', 'url'=>array('create'), 'icon'=>'fa fa-plus-circle'),
	array('label'=>'Actualizar Orden de Mudanza', 'url'=>array('update', 'id'=>$model->id), 'icon'=>'fa fa-refresh')
	);
?>

<h1>Orden de Mudanza #ODM<?php echo $model->id; ?> </h1>
<div class="pull-right">Estado: <?php echo $model->getEstadosRaw(); ?></div>
<?php 
	switch ($model->estado) {
		case 1:
			echo CHtml::link('Confirmar solicitud',array('ordenMudanza/confirmar/'.$model->id),array('class'=>'btn btn-success btn-flat')).' '.
				 CHtml::link('Cancelar solicitud',array('ordenMudanza/cancelar/'.$model->id),array('confirm'=>'¿Confirme que desea cancelar esta orden?','class'=>'btn btn-danger btn-flat'));
			break;
		case 2: case 3:
			echo CHtml::link($model->estado==2?'Asignar operario':'Cambiar operario asignado',array('ordenMudanza/asignar/'.$model->id),array('class'=>'btn btn-primary btn-flat')).' '.
				 CHtml::link('Cancelar solicitud',array('ordenMudanza/cancelar/'.$model->id),array('confirm'=>'¿Confirme que desea cancelar esta orden?','class'=>'btn btn-danger btn-flat'));

			break;
		default:
			# code...
			break;
	}
 ?>
 <br /><br />
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Información de mudanza</h3>
			</div>
			<div class="panel-body">
				<?php $this->widget('ext.yiibooster.widgets.TbDetailView', array(
					'data'=>$model,
					'attributes'=>array(		
						'fecha_creacion',
						array(
							'name'=>'creador',
							'type'=>'raw',
							'value'=>$model->usuario_creador->getNombreCompleto()
							),
						array(
							'name'=>'Cliente',
							'type'=>'raw',
							'value'=>$model->cliente->getNombreCompleto()." ".CHtml::link('Ver',array('cliente/view/'.$model->cliente->id),array('class'=>'btn btn-xs btn-primary'))
							),
						array(
							'label'=>'e-mail cliente',
							'type'=>'raw',
							'value'=>$model->cliente->email,
							),
						array(
							'label'=>'Dirección cliente',
							'type'=>'raw',
							'value'=>$model->cliente->direccion.' '.$model->cliente->ciudad->getCiudadCompleto()
							),
						array(
							'label'=>'Teléfono cliente',
							'type'=>'raw',
							'value'=>$model->cliente->telefono,
							),									
						'responsable_origen',
						'direccion_origen',
						array(
							'name'=>'ciudad_origen',
							'type'=>'raw',
							'value'=>$model->ciudadOrigen->getCiudadCompleto()
							),
						'responsable_destino',
						'direccion_destino',
						array(
							'name'=>'ciudad_destino',
							'type'=>'raw',
							'value'=>$model->ciudadDestino->getCiudadCompleto()
							),
						array(
							'name'=>'asegurado',
							'type'=>'raw',
							'value'=>$model->asegurado?'Si':'No'
							),
						array(
							'name'=>'embalaje',
							'type'=>'raw',
							'value'=>$model->embalaje?'Si':'No'
							),
						array(
							'name'=>'operario',
							'type'=>'raw',
							'value'=>$model->operario?$model->operario0->id." ".$model->operario0->getNombreCompleto():'No asigando'
							),
						array(
							'name'=>'estado',
							'type'=>'raw',
							'value'=>$model->getEstadosRaw()
							),
						'fecha_recojida',						
						'location',
					),
				)); ?>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Ubicación actual</h3>
			</div>
			<div class="panel-body">
				<div id="map-canvas" style="width:100%; height:150px"></div>
				<?php if($model->location == null): ?>
					Aun no se ha establecido la posición de esta mudanza;
				<?php endif; ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Inventario</h3>
			</div>
			<div class="panel-body">
				<?php 					
					$cat = Categoria::model()->findAll(); ?>
					<?php foreach ($cat as $key => $value): ?>					
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div style="margin:0px 0px 20px 0px">
								<div class="small-box bg-blue-gradient">
									<div class="inner">
										<h3><?php echo $model->countItemcategoria($value->id); ?></h3>
										<p><?php echo $value->nombre; ?>s</p>
									</div>
									<div class="icon" style="top:5px">
										<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/'.$value->getIcon(),'icon',array('width'=>'50px')); ?>
									</div>
									<?php 
									echo CHtml::ajaxLink('Ver inventario',$this->createUrl('items',array('id'=>$model->id,'cat'=>$value->id)),array(
											'type'=>'GET',
											'beforeSend'=>'function(){changeContentModal("Cargando...");showModal()}',
											'success'=>'function(html){changeContentModal(html)}',
											'error'=>'function(){changeContentModal("Error al cargar la información")}'
											),
											array('class'=>'small-box-footer')
										); 
									?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<div class="col-md-6 col-sm-6 col-xs-12">
							<div style="margin:0px 0px 20px 0px">
								<div class="small-box bg-blue-gradient">
									<div class="inner">
										<h3><?php echo $model->countItemcategoria(); ?></h3>
										<p>Ver todos</p>
									</div>
									<div class="icon">
										<li class="ion ion-android-apps"></li>
									</div>
									<?php 
									echo CHtml::ajaxLink('Ver inventario',$this->createUrl('items',array('id'=>$model->id)),array(
											'type'=>'GET',
											'beforeSend'=>'function(){changeContentModal("Cargando...");showModal()}',
											'success'=>'function(html){changeContentModal(html)}',
											'error'=>'function(){changeContentModal("Error al cargar la información")}'
											),
											array('class'=>'small-box-footer')
										); 
									?>
								</div>
							</div>
						</div>
			</div><!-- fin panel-body -->
		</div>
	</div>
</div>

<?php 
$script = Yii::app()->clientScript;

$script->registerScriptFile("https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=es");
$marks = 0;

if($model->location!=null){
	$marks = array(
        'id'=>$model->id,
        'responsable'=>$model->responsable_destino,
        'direccion'=>$model->direccion_destino." ".$model->ciudadDestino->getCiudadCompleto(),        
        'location'=>$model->location
        );
}

$script->registerScript("modal","
	function showModal(){
		$('#MyModal').modal();
	}

	function changeContentModal(texto){
		$('#MyModal .modal-body').html(texto);
	}
	");

$script->registerScript("maps","
    var marks = ".json_encode($marks).";
    var defaultll = [4.624335,-74.063644]; 
    var defaultzoom = 7;   
    var map;
    function initialize() {
    	if(marks!==0){
			defaultll = marks.location.split(',');
			defaultzoom = 14;
    	}

        map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: defaultzoom,
            center: new google.maps.LatLng(defaultll[0],defaultll[1])
        });
    
        if(marks!==0){            
            var htmldata = '<div><b><a href=\"".$this->createUrl('ordenMudanza/view')."/'+marks.id+'\">ODM'+marks.id+'</a></b></div>'+
                      '<div><b>Responsable:</b> '+marks.responsable+'</div>'+
                      '<div><b>Entregar en:</b> '+marks.direccion+'</div>';
            
            var infowindow = new google.maps.InfoWindow({
                content: htmldata
            });
                      
            var mark = new google.maps.Marker({
                position: new google.maps.LatLng(defaultll[0],defaultll[1]),
                title:'ODM'+marks.id
            });

            mark.addListener('click',function(){
                infowindow.open(map,mark);
            });

            mark.setMap(map);
        }
    
    }

    google.maps.event.addDomListener(window, 'load', initialize);
"); ?>

<div id="MyModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->