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
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true
		)
)); ?>
		
		<?php if(Yii::app()->user->hasFlash('error')): ?>
			<div class="alert alert-danger"><?php echo Yii::app()->user->getFlash('error'); ?></div>
		<?php endif ?>
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Información del cliente</h3>
		</div>

		<?php 
			if(!$model->isNewRecord) $cliente = $model->cliente;
		?>
		<div class="panel-body">
			<?php if($model->isNewRecord): ?>
			<div class="pull-right"><?php echo CHtml::link('<span class="fa fa-close"></span> Cambiar cliente',array('/ordenMudanza/create'),array('class'=>'btn btn-warning btn-flat','encode'=>false,'confirm'=>"¿Está seguro que desea cambiar el cleinte?\nSi desea hacerlo, si ingreso datos de la mudanza se perderan.")); ?></div>
			<?php endif ?>
			<div class="row">
				<div class="col-md-1 col-sm-1 col-xs-12"><?php echo CHtml::image('http://www.gravatar.com/avatar/'.md5($cliente->email).'?s=70','avatar'); ?></div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<h4 style="margin:0px"><strong><?php echo CHtml::encode($cliente->getNombreCompleto()); ?></strong></h4>
					<div><?php echo $cliente->getTipoDocumento(true); ?>. <?php echo $cliente->documento; ?></div>
					<div><strong><em><?php echo $cliente->getAnos(); ?> Años</em></strong></div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div><strong><span class="fa fa-map-marker"></span> Dirección:</strong></div>
					<div><?php echo CHtml::encode($cliente->direccion)." ".$cliente->getUbicacion(); ?></div>
					<div><strong><span class="fa fa-phone"></span> Teléfono:</strong></div>
					<div><?php echo CHtml::encode($cliente->telefono); ?></div>
				</div>
			</div>
			
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading"><h3 class="panel-title">Origen de la mudanza</h3></div>
		<div class="panel-body">
			<div class="form-group col.">
				<?php echo $form->labelEx($model,'responsable_origen'); ?>
				<?php echo $form->textField($model,'responsable_origen',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
				<?php echo $form->error($model,'responsable_origen',array('class'=>'text-danger')); ?>
			</div>

			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<?php 
							if($model->ciudad_origen!=null){
								$model->departamento_origen = $model->ciudadOrigen->departamento->id;
							} 
						?>
						<?php echo $form->labelEx($model,'departamento_origen'); ?>
						<?php echo $form->dropDownList($model,'departamento_origen',CHtml::listData(Departamento::model()->findAll(),'id','nombre'),array(
							'empty'=>'Seleccione departamento',
							'class'=>'form-control',
							'ajax'=>array(
								'type'=>'POST',
								'url'=>$this->createUrl('/site/cargarCiudades'),
								'update'=>'#OrdenMudanza_ciudad_origen',
								'data'=>array('departamento_id'=>'js:this.value')
								)
							)
						); ?>
						<?php echo $form->error($model,'departamento_origen',array('class'=>'text-danger')); ?>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<?php 
						$ciudad_origen = array();
						if($model->departamento_origen!=null){
							$ciudad_origen = CHtml::listData(Ciudad::model()->findAllByAttributes(array('departamento_id'=>$model->departamento_origen)),'id','nombre');
						}
					 ?>
					<div class="form-group">
						<?php echo $form->labelEx($model,'ciudad_origen'); ?>
						<?php echo $form->dropDownList($model,'ciudad_origen',$ciudad_origen,array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'ciudad_origen',array('class'=>'text-danger')); ?>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<?php echo $form->labelEx($model,'direccion_origen'); ?>
						<?php echo $form->textField($model,'direccion_origen',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
						<?php echo $form->error($model,'direccion_origen',array('class'=>'text-danger')); ?>
					</div>			
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Destino de la mudanza</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<?php echo $form->labelEx($model,'responsable_destino'); ?>
				<?php echo $form->textField($model,'responsable_destino',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
				<?php echo $form->error($model,'responsable_destino',array('class'=>'text-danger')); ?>
			</div>

			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<?php
							if($model->ciudad_destino!=null){
								$model->departamento_destino = $model->ciudadDestino->departamento->id;
							}
						 ?>
						<?php echo $form->labelEx($model,'departamento_destino'); ?>
						<?php echo $form->dropDownList($model,'departamento_destino',CHtml::listData(Departamento::model()->findAll(),'id','nombre'),array(
							'empty'=>'Seleccione departamento',
							'class'=>'form-control',
							'ajax'=>array(
								'type'=>'POST',
								'url'=>$this->createUrl('/site/cargarCiudades'),
								'update'=>'#OrdenMudanza_ciudad_destino',
								'data'=>array('departamento_id'=>'js:this.value')
								)
							)
						); ?>
						<?php echo $form->error($model,'departamento_destino',array('class'=>'text-danger')); ?>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<?php 
						$ciudad_destino = array();

						if($model->departamento_destino!=null){
							$ciudad_destino = CHtml::listData(Ciudad::model()->findAllByAttributes(array('departamento_id'=>$model->departamento_destino)),'id','nombre');
						}
					?>
					<div class="form-group">
						<?php echo $form->labelEx($model,'ciudad_destino'); ?>
						<?php echo $form->dropDownList($model,'ciudad_destino',$ciudad_destino,array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'ciudad_destino',array('class'=>'text-danger')); ?>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<?php echo $form->labelEx($model,'direccion_destino'); ?>
						<?php echo $form->textField($model,'direccion_destino',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
						<?php echo $form->error($model,'direccion_destino',array('class'=>'text-danger')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-body">
			<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/secure.png','asegurado',array('class'=>'pull-right')); ?>
			<?php echo $form->checkBox($model,'asegurado'); ?>  <strong>Asegurar esta mudanza.</strong>
			<p>Seleccione esta opción en caso de que el cliente solicite que su mudanza sea asegurada por la aseguradora de su preferencia.</p>

		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/packing.png','embalaje',array('class'=>'pull-right')); ?>
			<?php echo $form->checkBox($model,'embalaje'); ?> <strong>Servicio de embalaje</strong>
			<p>En caso que el cleinte solicite que su mercancia sea embalada.</p>
		</div>
	</div>

		<?php echo $form->hiddenField($model,'cliente_id'); ?>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear Orden de Mudanza' : 'Guardar cambios',array('class'=>'btn btn-success btn-block btn-flat')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->