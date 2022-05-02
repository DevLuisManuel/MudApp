<?php
/* @var $this OrdenMudanzaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ordenes de Mudanzas',
);

$this->menu=array(
	array('label'=>'Crear Orden de Mudanza', 'url'=>array('create') ,'icon'=>'fa fa-plus-circle'),
);
?>

<h1>Lista de Ordenes de Mudanza</h1>

<?php
$ciudades = CHtml::listData(Ciudad::model()->findAll(),'id','ciudadCompleto');
$this->widget("ext.yiibooster.widgets.TbGridView",array(
                "dataProvider"=>$model->search(),
                "filter"=>$model,
                "columns"=>array(
                	array(
                        'name'=>'id',
                        'htmlOptions'=>array(
                            'width'=>'7%'
                            )
                        ),
                	array(
                        'name'=>'fecha_creacion',
                        'type'=>'raw',
                        'filter'=>CHtml::activeDateField($model,'fecha_creacion',array('class'=>'form-control')),
                        'value'=>'date("d/m/Y",strtotime($data->fecha_creacion))',
                        'htmlOptions'=>array(
                            'width'=>'15%'
                            )
                        ),
                	array(
                		'name'=>'ciudad_origen',
                		'header'=>'Origen',
                		'type'=>'raw',
                        'filter'=>CHtml::activeDropDownList($model,'ciudad_origen',$ciudades,array('empty'=>'--- ciudades ---','class'=>'form-control')),
                		'value'=>'$data->getInformacionDireccion()',
                		'htmlOptions'=>array('width'=>'30%')
                		),
                	array(
                		'name'=>'ciudad_destino',
                		'header'=>'Destino',
                		'type'=>'raw',
                        'filter'=>CHtml::activeDropDownList($model,'ciudad_destino',$ciudades,array('empty'=>'--- ciudades ---','class'=>'form-control')),
                		'value'=>'$data->getInformacionDireccion(false)',
                		'htmlOptions'=>array('width'=>'30%')
                		),
                	array(
                		'name'=>'estado',
                		'type'=>'raw',
                        'filter'=>CHtml::activeDropDownList($model,'estado',$model->getEstadosList(),array('empty'=>'Todos','class'=>'form-control')),
                		'value'=>'$data->getEstadosRaw()',
                		'htmlOptions'=>array('width'=>'10%')
                		),
                    array(
                        'header'=>'Acción',
                        'type'=>'raw',
                        'value'=>'$data->getButtons()'
                        )
                	)
                )
            );
?>
