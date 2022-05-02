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
                        'header'=>'Fecha',
                        'type'=>'raw',
                        'filter'=>CHtml::activeDateField($model,'fecha_creacion',array('class'=>'form-control')),
                        'value'=>'date("d/m/Y",strtotime($data->fecha_creacion))'
                        ),
                	array(
                		'name'=>'cliente_id',
                		'header'=>'Cliente',
                		'filter'=>CHtml::activeTextField($model,'cliente_id',array('placeholder'=>'Documento identidad','class'=>'form-control')),
                		'type'=>'raw',
                		'value'=>'$data->cliente->getInformacion(35)'
                		),
                	array(
                		'name'=>'ciudad_origen',
                		'header'=>'Origen',
                		'type'=>'raw',
                		'value'=>'$data->getInformacionDireccion()',
                        'filter'=>CHtml::activeDropDownList($model,'ciudad_origen',$ciudades,array('empty'=>'--- ciudades ---','class'=>'form-control')),
                		'htmlOptions'=>array('width'=>'15%')
                		),
                	array(
                		'name'=>'ciudad_destino',
                		'header'=>'Destino',
                		'type'=>'raw',
                		'value'=>'$data->getInformacionDireccion(false)',
                        'filter'=>CHtml::activeDropDownList($model,'ciudad_destino',$ciudades,array('empty'=>'--- ciudades ---','class'=>'form-control')),
                		'htmlOptions'=>array('width'=>'15%')
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
