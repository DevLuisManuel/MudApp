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
	<?php if(!isset($_POST['Cliente'])&&!$cliente):  ?>
	<?php $form = $this->beginWidget(
		'CActiveForm',
		array(
			'id'=>'crear-odm',
			'enableClientValidation'=>true,
			'enableAjaxValidation'=>false,
			'clientOptions'=>array(
				'validateOnSubmit'=>true
				)
			)
	); ?>
	<h3>Buscar cliente que realiza la mudanza</h3>
	<div class="group-form">
		<?php echo $form->label($search,'tipo_documento_id'); ?>
		<?php echo $form->dropDownList($search,'tipo_documento_id',CHtml::listData(TipoDocumento::model()->findAll(),'id','nombre'),array('empty'=>'Seleccione...','class'=>'form-control')); ?>
		<?php echo $form->error($search,'tipo_documento_id',array('class'=>'text-danger')); ?>
	</div>
	<div class="group-form">
		<?php echo $form->label($search,'documento'); ?>
		<?php echo $form->textField($search,'documento',array('class'=>'form-control')); ?>
		<?php echo $form->error($search,'documento',array('class'=>'text-danger')); ?>
	</div>
	<br />
	<div class="group-form">
		<?php echo CHtml::submitButton('Buscar cliente',array('class'=>'btn btn-primary btn-block btn-flat')) ?>
	</div>
	<?php $this->endWidget(); ?>
	<?php elseif(!$cliente): ?>
	<h3>El cliente no existe</h3>
	<?php $tipo = TipoDocumento::model()->findByPk($search->tipo_documento_id); ?>
	<p>El cliente que buscó identificado con <b><?php echo $tipo->nombre.' # '.$search->documento; ?></b>, no se encuentra registrado.</p>
	<p>Seleccione una opción a continuación:</p>
	<form method="post">
		<?php echo CHtml::activeHiddenField($search,'tipo_documento_id'); ?>
		<?php echo CHtml::activeHiddenField($search,'documento'); ?>
		<?php echo CHtml::link('Regresar',array('/ordenMudanza/create'),array('class'=>'btn btn-default btn-flat')); ?>
		<?php echo CHtml::link('Crear cliente','#',array('submit'=>array('/cliente/create'),'class'=>'btn btn-primary btn-flat')); ?>
	</form>
	<?php else: ?>
		<?php $model->cliente_id = $cliente->id;  ?>
		<?php $this->renderPartial('_form',array('model'=>$model,'cliente'=>$cliente)); ?>
	<?php endif ?>
