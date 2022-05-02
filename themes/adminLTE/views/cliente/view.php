<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Lista de Cliente', 'url'=>array('index'), 'icon'=>'fa fa-list'),
	array('label'=>'Crear Cliente', 'url'=>array('create'), 'icon'=>'fa fa-plus-circle'),
	array('label'=>'Actualizar Cliente', 'url'=>array('update', 'id'=>$model->id),'icon'=>'fa fa-refresh'),
	array('label'=>'Eliminar Cliente', 'url'=>'#', 'icon'=>'fa fa-ban','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro(a) que quiere eliminar este item?')),
);
?>

<form method="post">
	<?php echo CHtml::activeHiddenField($model,'tipo_documento_id'); ?>
	<?php echo CHtml::activeHiddenField($model,'documento'); ?>
<h1>
	Perfil cliente <?php echo $model->primer_nombre." ".$model->primer_apellido; ?>
	<?php echo CHtml::link('Registrar mudanza para este cliente','#',array('submit'=>array('ordenMudanza/create'),'class'=>'btn btn-success pull-right')); ?>
</h1>
</form>
<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><span class="fa fa-user"></span>  Información personal</h3>
		</div>
		<div class="panel-body">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php $this->widget('ext.yiibooster.widgets.TbDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'primer_nombre',
					'segundo_nombre',
					'primer_apellido',
					'segundo_apellido',
					array(
						'name'=>'tipo_documento_id',
						'type'=>'raw',
						'value'=>$model->tipoDocumento->nombre
						),
					'documento',
					'email',
				),
				)); ?>	
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php $this->widget('ext.yiibooster.widgets.TbDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					array(
						'name'=>'ciudad_id',
						'type'=>'raw',
						'value'=>$model->ciudad->getCiudadCompleto()
						),
					'direccion',
					'telefono',
					array(
						'name'=>'genero',
						'type'=>'raw',
						'value'=>$model->genero==='1'?'Femenino':'Masculino'
						),
					'fecha_nacimiento',
					array(
						'name'=>'estado',
						'type'=>'raw',
						'value'=>$model->estado?'Activo':'Inactivo'
						)
					),
				)); ?>	
			</div>
		</div>

	</div>
</div>	
<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><span class="fa fa-truck"></span> Mudanzas asociadas</h3>
		</div>
		<div class="panel-body">
			<?php 
			$criteria = new CDbCriteria;
			$criteria->compare('cliente_id',$model->id);
			$dataProvider = new CActiveDataProvider('OrdenMudanza',array(
					'criteria'=>$criteria,
					'sort'=>array(
						'defaultOrder'=>'t.id DESC'
					)
				)
			);
			$this->widget('ext.yiibooster.widgets.TbGridView',array(
					'id'=>'mudanzas-cliente',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
                	array(
                        'name'=>'id',
                        'htmlOptions'=>array(
                            'width'=>'7%'
                            )
                        ),
                	'fecha_creacion',
                	array(
                		'name'=>'ciudad_origen',
                		'header'=>'Origen',
                		'type'=>'raw',
                		'value'=>'$data->getInformacionDireccion()',
                		'htmlOptions'=>array('width'=>'22%')
                		),
                	array(
                		'name'=>'ciudad_destino',
                		'header'=>'Destino',
                		'type'=>'raw',
                		'value'=>'$data->getInformacionDireccion(false)',
                		'htmlOptions'=>array('width'=>'22%')
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
	