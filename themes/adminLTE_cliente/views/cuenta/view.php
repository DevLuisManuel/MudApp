<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Actualizar Cliente', 'url'=>array('update'),'icon'=>'fa fa-refresh'),
	array('label'=>'Cambiar contraseña', 'url'=>array('changepassword'), 'icon'=>'fa fa-asterisk'),
);
?>

<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('success'); ?></div>
<?php endif ?>

<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Información personal</h3>
		</div>
		<div class="panel-body">
		<?php $this->widget('ext.yiibooster.widgets.TbDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array(
					'label'=>'Nombre',
					'type'=>'raw',
					'value'=>$model->getNombreCompleto()
					),
				array(
					'name'=>'tipo_documento_id',
					'type'=>'raw',
					'value'=>$model->tipoDocumento->nombre
					),
				'documento',
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
					'value'=>$model->genero===1?'Femenino':'Masculino'
					),
				'fecha_nacimiento',
				'email',				
			),
		)); ?>

	</div>
</div>	
	