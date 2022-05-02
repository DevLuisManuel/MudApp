<?php
/* @var $this OrdenMudanzaController */
/* @var $model OrdenMudanza */

$this->breadcrumbs=array(
	'Orden Mudanzas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrdenMudanza', 'url'=>array('index')),
	array('label'=>'Manage OrdenMudanza', 'url'=>array('admin')),
);
?>

<h1>Create OrdenMudanza</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>