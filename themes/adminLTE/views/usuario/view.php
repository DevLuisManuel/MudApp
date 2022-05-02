<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Lista Usuario', 'url'=>array('index'),'icon'=>'fa fa-list'),
	array('label'=>'Crear Usuario', 'url'=>array('create'),'icon'=>'fa fa-plus-circle'),
	array('label'=>'Actualizar Usuario', 'url'=>array('update', 'id'=>$model->id),'icon'=>'fa fa-refresh'),
	array('label'=>'Eliminar Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),'icon'=>'fa fa-ban'),
	
);
?>

<h1>Perfil Usuario <?php echo $model->getNombreCompleto(); ?></h1>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Información de ususario</h3>
			</div>
			<div class="panel-body">
				<?php $this->widget('ext.yiibooster.widgets.TbDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'id',
						'nombre',
						'apellido',
						'username',		
						array(
							'name'=>'rol',
							'type'=>'raw',
							'value'=>$model->getRolRaw()
							),
						'estado',
						'fecha_registro',
					),
				)); ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Mudanzas asignadas</h3>
			</div>
			<div class="panel-body">
				<?php $this->widget('ext.yiibooster.widgets.TbGridView',array(
					'dataProvider'=>$model->listaAsignadas(),
					'columns'=>array(
                	array(
                        'name'=>'id',
                        'htmlOptions'=>array(
                            'width'=>'7%'
                            )
                        ),
                	array(
                		'name'=>'fecha_creacion',
                		'header'=>'Fecha',
                		'type'=>'raw',
                		'value'=>'date("d/m/Y",strtotime($data->fecha_creacion))',
                		'htmlOptions'=>array('width'=>'10%')
                		),
                	array(
                		'name'=>'cliente_id',
                		'type'=>'raw',
                		'value'=>'$data->cliente->getInformacion(50)'
                		),
                	array(
                		'name'=>'ciudad_origen',
                		'header'=>'Origen',
                		'type'=>'raw',
                		'value'=>'$data->getInformacionDireccion()',
                		'htmlOptions'=>array('width'=>'15%')
                		),
                	array(
                		'name'=>'ciudad_destino',
                		'header'=>'Destino',
                		'type'=>'raw',
                		'value'=>'$data->getInformacionDireccion(false)',
                		'htmlOptions'=>array('width'=>'15%')
                		),
                	array(
                		'name'=>'estado',
                		'type'=>'raw',
                		'value'=>'$data->getEstadosRaw()',
                		'htmlOptions'=>array('width'=>'10%')
                		),
                    array(
                        'header'=>'Acción',
                        'type'=>'raw',
                        'value'=>'$data->getButtons()'
                        )
                	)
					)
				); ?>
			</div>
</div>
