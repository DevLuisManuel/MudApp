<?php
/* @var $this OrdenMudanzaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orden Mudanzas',
);

$this->menu=array(
	array('label'=>'Create OrdenMudanza', 'url'=>array('create')),
	array('label'=>'Manage OrdenMudanza', 'url'=>array('admin')),
);
?>

<h1>Orden Mudanzas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
