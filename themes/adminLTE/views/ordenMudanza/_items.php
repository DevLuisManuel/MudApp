<?php if($cat===null): ?>
	<h3>Todos los items</h3>
<?php else: ?>
	<?php $c = Categoria::model()->findByPk($cat); ?>
	<h3><?php echo $c->nombre; ?>s</h3>
<?php endif ?>
<?php 
	$this->widget('ext.yiibooster.widgets.TbGridView',array(
		'dataProvider'=>$model->getItemsCategoria($cat),
		'template'=>'{items}',
		'columns'=>array(
			array(
				'header'=>'Producto',
				'type'=>'raw',
				'value'=>'$data->getProductoRaw()'
				),
			array(
				'name'=>'estado',
				'type'=>'raw',
				'value'=>'$data->getEstadoRaw()'
				)
			)
		)
	); 
?>