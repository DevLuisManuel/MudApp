<?php
/* @var $this OrdenMudanzaController */
/* @var $model OrdenMudanza */

$this->breadcrumbs=array(
	'Orden Mudanzas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OrdenMudanza', 'url'=>array('index')),
	array('label'=>'Create OrdenMudanza', 'url'=>array('create')),
	array('label'=>'Update OrdenMudanza', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OrdenMudanza', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrdenMudanza', 'url'=>array('admin')),
);
?>

<h1>View OrdenMudanza #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha_creacion',
		'creador',
		'ciudad_origen',
		'direccion_origen',
		'responsable_origen',
		'ciudad_destino',
		'direccion_destino',
		'responsable_destino',
		'asegurado',
		'embalaje',
		'operario',
		'estado',
		'fecha_recojida',
		'cliente_id',
		'location',
	),
)); ?>
