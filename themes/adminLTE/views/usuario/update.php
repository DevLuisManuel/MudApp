<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lista de Usuario', 'url'=>array('index'),'icon'=>'fa fa-list'),
	array('label'=>'Crear Usuario', 'url'=>array('create'),'icon'=>'fa fa-plus-circle'),
	array('label'=>'Ver Usuario', 'url'=>array('view', 'id'=>$model->id),'icon'=>'fa fa-search'),	
);
?>

<h1>Actualizar Usuario  <?php echo $model->getNombreCompleto(); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>