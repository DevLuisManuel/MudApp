<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lista de Cliente', 'url'=>array('index'), 'icon'=>'fa fa-list'),
	array('label'=>'Crear Cliente', 'url'=>array('create'), 'icon'=>'fa fa-plus-circle'),
	array('label'=>'Ver Cliente', 'url'=>array('view', 'id'=>$model->id),'icon'=>'fa fa-search'),
);
?>

<h1>Actualizar Cliente ID<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>