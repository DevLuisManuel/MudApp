<?php
/* @var $this OrdenMudanzaController */
/* @var $model OrdenMudanza */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creador'); ?>
		<?php echo $form->textField($model,'creador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ciudad_origen'); ?>
		<?php echo $form->textField($model,'ciudad_origen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion_origen'); ?>
		<?php echo $form->textArea($model,'direccion_origen',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'responsable_origen'); ?>
		<?php echo $form->textArea($model,'responsable_origen',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ciudad_destino'); ?>
		<?php echo $form->textField($model,'ciudad_destino'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion_destino'); ?>
		<?php echo $form->textArea($model,'direccion_destino',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'responsable_destino'); ?>
		<?php echo $form->textArea($model,'responsable_destino',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asegurado'); ?>
		<?php echo $form->textField($model,'asegurado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'embalaje'); ?>
		<?php echo $form->textField($model,'embalaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'operario'); ?>
		<?php echo $form->textField($model,'operario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_recojida'); ?>
		<?php echo $form->textField($model,'fecha_recojida'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cliente_id'); ?>
		<?php echo $form->textField($model,'cliente_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location'); ?>
		<?php echo $form->textArea($model,'location',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->