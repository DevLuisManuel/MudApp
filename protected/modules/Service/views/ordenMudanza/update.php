<?php
/* @var $this OrdenMudanzaController */
/* @var $model OrdenMudanza */

$this->breadcrumbs=array(
	'Orden Mudanzas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrdenMudanza', 'url'=>array('index')),
	array('label'=>'Create OrdenMudanza', 'url'=>array('create')),
	array('label'=>'View OrdenMudanza', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OrdenMudanza', 'url'=>array('admin')),
);
?>

<h1>Update OrdenMudanza <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>