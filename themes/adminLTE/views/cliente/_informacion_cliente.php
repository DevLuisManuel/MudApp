<div class="row">
	<div class="col-md-2">
		<?php echo CHtml::image('http://www.gravatar.com/avatar/'.md5($model->email).'?s='.$s,'avatar',array('class'=>'img-circle')); ?>
	</div>
	<div class="col-md-10">
		<div>
			<b><?php echo $model->getNombreCompleto() ?></b>
		</div>
		<div>
			<span class="label bg-blue"><?php echo $model->getTipoDocumento(true) ?></span> <?php echo $model->documento; ?>
		</div>
		<div><em><?php echo $model->getAnos() ?> Años</em></div>
	</div>
</div>