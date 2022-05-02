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

<h1>View Cliente #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'primer_nombre',
		'segundo_nombre',
		'primer_apellido',
		'segundo_apellido',
		'tipo_documento_id',
		'documento',
		'ciudad_id',
		'direccion',
		'telefono',
		'genero',
		'fecha_nacimiento',
		'email',
		'estado',
	),
)); ?>
