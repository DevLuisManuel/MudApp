<?php
/* @var $this OrdenMudanzaController */
/* @var $model OrdenMudanza */

$this->breadcrumbs=array(
	'Orden Mudanzas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lista de Ordenes de Mudanza', 'url'=>array('index'),'icon'=>'fa fa-list'),
	array('label'=>'Crear Orden de Mudanza', 'url'=>array('create'),'icon'=>'fa fa-plus-circle'),
	array('label'=>'Ver Orden de Mudanza', 'url'=>array('view', 'id'=>$model->id),'icon'=>'fa fa-search'),
	
);
?>

<h1>Actualizar Orden de Mudanza # ODM<?php echo $model->id; ?></h1>

<?php if(Yii::app()->user->hasFlash('error')): ?>
	<div class="alert alert-danger"><?php echo Yii::app()->user->getFlash('error'); ?></div>
<?php endif ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>