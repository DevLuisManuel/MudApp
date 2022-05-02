<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Manage',
);

$this->menu=array(	
	array('label'=>'Crear Usuario', 'url'=>array('create'),'icon'=>'fa fa-plus-circle'),
);

?>

<h1>Lista de Usuarios</h1>

<?php $this->widget('ext.yiibooster.widgets.TbGridView', array(
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(		
		array(
			'name'=>'nombre',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'$data->getNombreCompleto()',
			'htmlOptions'=>array(
				'width'=>'60%'
				)
			),
		array(
			'name'=>'rol',
			'type'=>'raw',
			'filter'=>CHtml::activeDropDownList($model,'rol',array("1"=>"Administrador","2"=>"Operario"),array('empty'=>'Todos','class'=>'form-control')),
			'value'=>'$data->getRolRaw()'
			),
	
		array(
			'name'=>'estado',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'$data->getEstadoRaw()'
			),
		array(
			'class'=>'ext.yiibooster.widgets.TbButtonColumn',
			'template'=>'{view} {update}',
			'viewButtonIcon'=>'fa fa-search',
			'updateButtonIcon'=>'fa fa-edit'
		),
	),
)); ?>
