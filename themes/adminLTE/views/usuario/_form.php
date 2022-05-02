<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true
		)
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php if(isset($_POST['Usuario'])): ?>
		<?php echo $form->passwordField($model,'password',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php else: ?>
		<?php echo $form->TextField($model,'password',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php endif ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'rol'); ?>
		<?php echo $form->dropDownList($model,'rol',array('1'=>'Administrador','2'=>'Operario'),array('empty'=>'Seleccione rol','class'=>'form-control')); ?>
		<?php echo $form->error($model,'rol'); ?>
	</div>
	<br />
	<div class="control-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear usuario' : 'Guardar cambios',array('class'=>'btn btn-success btn-block btn-flat')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->