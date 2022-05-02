<?php
/* @var $this OrdenMudanzaController */
/* @var $model OrdenMudanza */

$this->breadcrumbs=array(
	'Orden Mudanzas'=>array('index'),
	'Create',
);

$this->action_name = "Registro de mudanza";

$this->menu=array(
	array('label'=>'Listar Orden de Mudanza', 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form',array('model'=>$model,'cliente'=>$cliente)); ?>
