<?php
/* @var $this OrdenMudanzaController */
/* @var $model OrdenMudanza */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orden-mudanza-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
		<?php echo $form->error($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creador'); ?>
		<?php echo $form->textField($model,'creador'); ?>
		<?php echo $form->error($model,'creador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ciudad_origen'); ?>
		<?php echo $form->textField($model,'ciudad_origen'); ?>
		<?php echo $form->error($model,'ciudad_origen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion_origen'); ?>
		<?php echo $form->textArea($model,'direccion_origen',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'direccion_origen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'responsable_origen'); ?>
		<?php echo $form->textArea($model,'responsable_origen',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'responsable_origen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ciudad_destino'); ?>
		<?php echo $form->textField($model,'ciudad_destino'); ?>
		<?php echo $form->error($model,'ciudad_destino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion_destino'); ?>
		<?php echo $form->textArea($model,'direccion_destino',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'direccion_destino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'responsable_destino'); ?>
		<?php echo $form->textArea($model,'responsable_destino',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'responsable_destino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'asegurado'); ?>
		<?php echo $form->textField($model,'asegurado'); ?>
		<?php echo $form->error($model,'asegurado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'embalaje'); ?>
		<?php echo $form->textField($model,'embalaje'); ?>
		<?php echo $form->error($model,'embalaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'operario'); ?>
		<?php echo $form->textField($model,'operario'); ?>
		<?php echo $form->error($model,'operario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->textField($model,'estado'); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_recojida'); ?>
		<?php echo $form->textField($model,'fecha_recojida'); ?>
		<?php echo $form->error($model,'fecha_recojida'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cliente_id'); ?>
		<?php echo $form->textField($model,'cliente_id'); ?>
		<?php echo $form->error($model,'cliente_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textArea($model,'location',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->