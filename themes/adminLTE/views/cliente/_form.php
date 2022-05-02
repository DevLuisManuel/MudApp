		<?php $form = $this->beginWidget('CActiveForm',
			array(
				'id'=>'form-crear-cliente',
				'enableClientValidation'=>true,
				'enableAjaxValidation'=>false,
				'clientOptions'=>array(
					'validateOnSubmit'=>true
					)
				)
		); ?>
		<?php echo $form->errorSummary($model,'<div class="alert alert-danger">','</div>'); ?>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->labelEx($model,'tipo_documento_id'); ?>
					<?php echo $form->dropDownList($model,'tipo_documento_id',CHtml::listData(TipoDocumento::model()->findAll(),'id','abreviatura'),array('empty'=>'Seleccione...','class'=>'form-control')); ?>
					<?php echo $form->error($model,'tipo_documento_id',array('class'=>'text-danger')); ?>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->labelEx($model,'documento'); ?>
					<?php echo $form->textField($model,'documento',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'documento',array('class'=>'text-danger')); ?>						
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->labelEx($model,'primer_nombre'); ?>
					<?php echo $form->textField($model,'primer_nombre',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'primer_nombre',array('class'=>'text-danger')); ?>						
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->labelEx($model,'segundo_nombre'); ?>
					<?php echo $form->textField($model,'segundo_nombre',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'segundo_nombre',array('class'=>'text-danger')); ?>						
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->labelEx($model,'primer_apellido'); ?>
					<?php echo $form->textField($model,'primer_apellido',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'primer_apellido',array('class'=>'text-danger')); ?>						
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->labelEx($model,'segundo_apellido'); ?>
					<?php echo $form->textField($model,'segundo_apellido',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'segundo_apellido',array('class'=>'text-danger')); ?>						
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'email',array('class'=>'text-danger')); ?>						

		</div>	

		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php
					if($model->ciudad_id!=null){
						$model->departamento_id = $model->ciudad->departamento->id;
					}
				?>
				<div class="form-group">
					<?php echo $form->labelEx($model,'departamento_id'); ?>
					<?php echo $form->dropDownList($model,'departamento_id',CHtml::listData(Departamento::model()->findAll(),'id','nombre'),array(
						'empty'=>'Seleccione departamento',
						'class'=>'form-control',
						'ajax'=>array(
							'type'=>'POST',
							'url'=>$this->createUrl('/site/cargarCiudades'),
							'update'=>'#Cliente_ciudad_id',
							'data'=>array('departamento_id'=>'js:this.value')
							)
						)
					); ?>
					<?php echo $form->error($model,'departamento_id',array('class'=>'text-danger')); ?>						
				</div>
			</div>
			<?php 
				$model_ciudad = array();
				
				if($model->departamento_id!=null){
					$model_ciudad = CHtml::listData(Ciudad::model()->findAll('departamento_id=:departamento',array(':departamento'=>$model->departamento_id)),'id','nombre');
				} 
			?>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->labelEx($model,'ciudad_id'); ?>
					<?php echo $form->dropDownList($model,'ciudad_id',$model_ciudad,array('empty'=>'Seleccione ciudad','class'=>'form-control')); ?>
					<?php echo $form->error($model,'ciudad_id',array('class'=>'text-danger')); ?>						
				</div>
			</div>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'direccion'); ?>
			<?php echo $form->textField($model,'direccion',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'direccion',array('class'=>'text-danger')); ?>						
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'telefono'); ?>
			<?php echo $form->textField($model,'telefono',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'telefono',array('class'=>'text-danger')); ?>						
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'genero'); ?>
			<?php echo $form->dropDownList($model,'genero',array('1'=>'Femenino','2'=>'Masculino'),array('empty'=>'Seleccione género','class'=>'form-control')); ?>
			<?php echo $form->error($model,'genero',array('class'=>'text-danger')); ?>						
		</div>	

		<div class="form-group">
			<?php echo $form->labelEx($model,'fecha_nacimiento'); ?>
			<?php echo $form->dateField($model,'fecha_nacimiento',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'fecha_nacimiento',array('class'=>'text-danger')); ?>						
		</div>	

		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php echo CHtml::link('Cancelar',array('/cliente/'),array('class'=>'btn btn-danger btn-block btn-flat')); ?>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php echo CHtml::submitButton($model->isNewRecord?'Crear cliente':'Actualizar cliente',array('class'=>'btn btn-success btn-block btn-flat')); ?>
			</div>
		</div>
		<?php $this->endWidget(); ?>	
