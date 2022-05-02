
<?php 
	$this->action_name = "Cambio de contraseña";
	$form = $this->beginWidget('CActiveForm',array(
		'id'=>'resetpassword',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>true
			)
	)); ?>

	<?php $form->errorSummary($model,'<div class="alert alert-danger">','</div>'); ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'actual'); ?>
		<?php echo $form->passwordField($model,'actual',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'actual',array('class'=>'text-danger')); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'nueva'); ?>
		<?php echo $form->passwordField($model,'nueva',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'nueva',array('class'=>'text-danger')); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'re_nueva'); ?>
		<?php echo $form->passwordField($model,'re_nueva',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'re_nueva',array('class'=>'text-danger')); ?>
	</div>

	<br />
	<?php echo CHtml::submitButton('Actualizar contraseña',array('class'=>'btn btn-success btn-block btn-flat')); ?>

<?php $this->endWidget(); ?>