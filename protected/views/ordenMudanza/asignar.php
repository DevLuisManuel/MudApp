<?php $this->action_name = "Asignación de mudanza"; ?>

<?php $form = $this->beginWidget('CActiveForm',array(
	'id'=>'form-asignar',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true
		)
	)); 
?>
	<p>Seleccione el operario y la fecha en que realizará la recogida de la mudanza.</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'operario'); ?>
		<?php $operarios = CHtml::listData(Usuario::model()->findAll('rol=2'),'id','nombreCompleto'); ?>
		<?php echo $form->dropDownList($model,'operario',$operarios,array('empty'=>'Seleccione operario','class'=>'form-control')); ?>	
		<?php echo $form->error($model,'operario'); ?>

	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'fecha_recogida'); ?>
		<?php echo $form->dateTimeLocalField($model,'fecha_recojida',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'fecha_recojida'); ?>
	</div>	

	<br />
	<div class="row">
		<div class="col-md-6 col-sm-6"><?php echo CHtml::submitButton('Asignar',array('class'=>'btn btn-success btn-block btn-flat')); ?></div>
		<div class="col-md-6 col-sm-6"><?php echo CHtml::link('Cancelar',array('ordenMudanza/view/'.$model->id),array('class'=>'btn btn-danger btn-block btn-flat')); ?></div>
	</div>
<?php $this->endWidget(); ?>