<?php
/* @var $this OrdenMudanzaController */
/* @var $model OrdenMudanza */

$this->breadcrumbs=array(
	'Orden Mudanzas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OrdenMudanza', 'url'=>array('index')),
	array('label'=>'Create OrdenMudanza', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orden-mudanza-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Orden Mudanzas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orden-mudanza-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha_creacion',
		'creador',
		'ciudad_origen',
		'direccion_origen',
		'responsable_origen',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
