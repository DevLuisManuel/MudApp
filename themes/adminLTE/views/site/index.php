<section class="content">
	<div class="row">
		
		<div class="col-md-offset-2 col-sm-offset-2 col-md-8 col-sm-8">
			<div class="login-logo" style="text-align:left">
				<a href="#"><?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/logo_32.png','alt'); ?> <b>Mud</b>App</a>
			</div>
			<div class="login-box-body" style="border-radius:7px">
				<div class="row">
					<div class="col-md-4">
						<h3>¿Que es MudApp?</h3>
						<p align="justify">Es un sistema de gestión de mudanza que le permitirá: 
						   localizar mediante GPS la posición exacta donde se 
						   encuentra la mudanza en camino a su destino descargue, 
						   tambien usted podra verificar los productos que se 
						   inventariaron en la mudanza.
						</p>
						<p align="justify">Usted tambien, tiene la opción de solicitar el servicio de embalaje por si no cuenta con la logistica para hacerlo y tiene la opción de asegurar su envío para que sus bienes esten protegidos ante cualquier eventualidad inesperada.</p>
						<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/localizador.jpg','alt',array('style'=>'width:100%')); ?>
					</div>
					<div class="col-md-4">
						<h3>Cree una cuenta para solicitar mudanza</h3>
						<p>Si usted ya cuenta con una cuenta haga inicie sesión como cliente</p>
						<?php $form = $this->beginWidget('CActiveForm',array(
							'id'=>'solicitud-form',
							'action'=>$this->createUrl('Clientes/default/registro'),
							'enableClientValidation'=>true,
							'enableAjaxValidation'=>false,
							'clientOptions'=>array(
								'validateOnSubmit'=>true
								)
						)); ?>
						<div class="group-form">
							<?php echo $form->labelEx($model,'tipo_documento_id'); ?>
							<?php echo $form->dropDownList($model,'tipo_documento_id',CHtml::listData(TipoDocumento::model()->findAll(),'id','nombre'),array('empty'=>'Seleccione tipo documento','class'=>'form-control')); ?>
							<?php echo $form->error($model,'tipo_documento_id',array('class'=>'text-danger')); ?>
						</div>
						<div class="group-form">
							<?php echo $form->labelEx($model,'documento'); ?>
							<?php echo $form->textField($model,'documento',array('class'=>'form-control')); ?>
							<?php echo $form->error($model,'documento',array('class'=>'text-danger')); ?>
						</div>
						<div class="group-form">
							<?php echo $form->labelEx($model,'email'); ?>
							<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
							<?php echo $form->error($model,'email',array('class'=>'text-danger')); ?>
						</div>
						<div class="group-form">
							<?php echo $form->labelEx($model,'primer_nombre'); ?>
							<?php echo $form->textField($model,'primer_nombre',array('class'=>'form-control')); ?>
							<?php echo $form->error($model,'primer_nombre',array('class'=>'text-danger')); ?>
						</div>
						<div class="group-form">
							<?php echo $form->labelEx($model,'primer_apellido'); ?>
							<?php echo $form->textField($model,'primer_apellido',array('class'=>'form-control')); ?>
							<?php echo $form->error($model,'primer_apellido',array('class'=>'text-danger')); ?>
						</div>
						<br />
						<?php echo CHtml::submitButton('continuar con el registro',array('class'=>'btn btn-primary btn-block btn-flat')); ?>

						<?php $this->endWidget(); ?>
					</div>
					<div class="col-md-4">
						<h3>Inicio de sesión</h3>
						<p>Si usted es un cliente y esta registrado haga clic en el boton area de clientes. Si usted es un Administrador de sistema haga clic sobre area de Administración</p>
						<?php echo CHtml::link('<span class="fa fa-user"></span> Area de clientes',$this->createUrl('Clientes/default/login'),array('class'=>'btn btn-warning btn-block btn-flat')); ?><br />
						<?php echo CHtml::link('<span class="fa fa-users"></span> Area de Administración',$this->createUrl('site/login'),array('class'=>'btn btn-warning btn-block btn-flat')); ?><br />
					</div>
				</div>
			</div>
			<br />
			<div align="center">MudApp. &copy; Monteria 2015</div>
		</div>		
	</div>
</section>