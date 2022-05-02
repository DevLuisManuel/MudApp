<?php
/* @var $this ClienteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Clientes',
);

$this->menu=array(
	array('label'=>'Crear Cliente', 'url'=>array('create'), 'icon'=>'fa fa-plus-circle'),
);
?>

<?php
$this->widget("ext.yiibooster.widgets.TbGridView",array(
                "dataProvider"=>$model->search(),
                "filter"=>$model,
                "columns"=>array(
                	array(
                		'name'=>'documento',
                		'header'=>'Cliente',
                        'filter'=>CHtml::activeTextField($model,'documento',array('placeholder'=>'Documento identidad','class'=>'form-control')),
                		'type'=>'raw',
                		'value'=>'$data->getInformacion()'
                		),
                    array(
                        'name'=>'telefono',
                        'header'=>'Contacto',
                        'type'=>'raw',
                        'value'=>'$data->getInformacionContacto()',
                        'htmlOptions'=>array(
                            'width'=>'20%'
                            )
                        ),
                    array(
                        'name'=>'ciudad_id',
                        'filter'=>CHtml::activeDropDownList($model,'ciudad_id',CHtml::listData(Ciudad::model()->findAll(),'id','ciudadCompleto'),array('empty'=>'Todas','class'=>'form-control')),
                        'type'=>'raw',
                        'value'=>'$data->getUbicacion()',
                        'htmlOptions'=>array(
                            'width'=>'10%'
                            )
                        ),
                	array(
                		'name'=>'estado',
                        'filter'=>CHtml::activeDropDownList($model,'estado',array("0"=>"Inactivo","1"=>"Activo"),array("empty"=>"Todos","class"=>"form-control")),
                		'type'=>'raw',
                		'value'=>'$data->getEstadoRaw()',
                        'htmlOptions'=>array(
                            'width'=>'10%'
                            )
                		),
                    array(
                        'header'=>'Acción',
                        'type'=>'raw',
                        'value'=>'$data->getButtons()',
                        )
                	)
                )
            );
?>
