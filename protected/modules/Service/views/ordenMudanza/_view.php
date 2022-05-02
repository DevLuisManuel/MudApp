<?php
/* @var $this OrdenMudanzaController */
/* @var $data OrdenMudanza */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creador')); ?>:</b>
	<?php echo CHtml::encode($data->creador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad_origen')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad_origen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion_origen')); ?>:</b>
	<?php echo CHtml::encode($data->direccion_origen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable_origen')); ?>:</b>
	<?php echo CHtml::encode($data->responsable_origen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad_destino')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad_destino); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion_destino')); ?>:</b>
	<?php echo CHtml::encode($data->direccion_destino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable_destino')); ?>:</b>
	<?php echo CHtml::encode($data->responsable_destino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asegurado')); ?>:</b>
	<?php echo CHtml::encode($data->asegurado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('embalaje')); ?>:</b>
	<?php echo CHtml::encode($data->embalaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('operario')); ?>:</b>
	<?php echo CHtml::encode($data->operario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_recojida')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_recojida); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_id')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	*/ ?>

</div>