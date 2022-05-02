		<?php echo $form->errorSummary($cliente,'<div class="alert alert-danger">','</div>'); ?>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->label($cliente,'tipo_documento_id'); ?>
					<?php echo $form->dropDownList($cliente,'tipo_documento_id',CHtml::listData(TipoDocumento::model()->findAll(),'id','abreviatura'),array('empty'=>'Seleccione...','class'=>'form-control','readonly'=>'readonly')); ?>
					<?php echo $form->error($cliente,'tipo_documento_id',array('class'=>'text-danger')); ?>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->label($cliente,'documento'); ?>
					<?php echo $form->textField($cliente,'documento',array('class'=>'form-control','readonly'=>'readonly')); ?>
					<?php echo $form->error($cliente,'documento',array('class'=>'text-danger')); ?>						
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->label($cliente,'primer_nombre'); ?>
					<?php echo $form->textField($cliente,'primer_nombre',array('class'=>'form-control')); ?>
					<?php echo $form->error($cliente,'primer_nombre',array('class'=>'text-danger')); ?>						
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->label($cliente,'segundo_nombre'); ?>
					<?php echo $form->textField($cliente,'segundo_nombre',array('class'=>'form-control')); ?>
					<?php echo $form->error($cliente,'segundo_nombre',array('class'=>'text-danger')); ?>						
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->label($cliente,'primer_apellido'); ?>
					<?php echo $form->textField($cliente,'primer_apellido',array('class'=>'form-control')); ?>
					<?php echo $form->error($cliente,'primer_apellido',array('class'=>'text-danger')); ?>						
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->label($cliente,'segundo_apellido'); ?>
					<?php echo $form->textField($cliente,'segundo_apellido',array('class'=>'form-control')); ?>
					<?php echo $form->error($cliente,'segundo_apellido',array('class'=>'text-danger')); ?>						
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo $form->label($cliente,'email'); ?>
			<?php echo $form->textField($cliente,'email',array('class'=>'form-control')); ?>
			<?php echo $form->error($cliente,'email',array('class'=>'text-danger')); ?>						

		</div>	

		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php
					if($cliente->ciudad_id!=null){
						$cliente->departamento_id = $cliente->ciudad->departamento->id;
					}
				?>
				<div class="form-group">
					<?php echo $form->label($cliente,'departamento_id'); ?>
					<?php echo $form->dropDownList($cliente,'departamento_id',CHtml::listData(Departamento::model()->findAll(),'id','nombre'),array(
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
					<?php echo $form->error($cliente,'departamento_id',array('class'=>'text-danger')); ?>						
				</div>
			</div>
			<?php 
				$cliente_ciudad = array();
				
				if($cliente->departamento_id!=null){
					$cliente_ciudad = CHtml::listData(Ciudad::model()->findAll('departamento_id=:departamento',array(':departamento'=>$cliente->departamento_id)),'id','nombre');
				} 
			?>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<?php echo $form->label($cliente,'ciudad_id'); ?>
					<?php echo $form->dropDownList($cliente,'ciudad_id',$cliente_ciudad,array('empty'=>'Seleccione ciudad','class'=>'form-control')); ?>
					<?php echo $form->error($cliente,'ciudad_id',array('class'=>'text-danger')); ?>						
				</div>
			</div>
		</div>

		<div class="form-group">
			<?php echo $form->label($cliente,'direccion'); ?>
			<?php echo $form->textField($cliente,'direccion',array('class'=>'form-control')); ?>
			<?php echo $form->error($cliente,'direccion',array('class'=>'text-danger')); ?>						
		</div>

		<div class="form-group">
			<?php echo $form->label($cliente,'telefono'); ?>
			<?php echo $form->textField($cliente,'telefono',array('class'=>'form-control')); ?>
			<?php echo $form->error($cliente,'telefono',array('class'=>'text-danger')); ?>						
		</div>

		<div class="form-group">
			<?php echo $form->label($cliente,'genero'); ?>
			<?php echo $form->dropDownList($cliente,'genero',array('1'=>'Femenino','2'=>'Masculino'),array('empty'=>'Seleccione género','class'=>'form-control')); ?>
			<?php echo $form->error($cliente,'genero',array('class'=>'text-danger')); ?>						
		</div>	

		<div class="form-group">
			<?php echo $form->label($cliente,'fecha_nacimiento'); ?>
			<?php echo $form->dateField($cliente,'fecha_nacimiento',array('class'=>'form-control')); ?>
			<?php echo $form->error($cliente,'fecha_nacimiento',array('class'=>'text-danger')); ?>						
		</div>		
