	<div class="box box-primary">
		<div class="box-header">Reporte de Mudanza Mensual</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-12">					
					<?php $form = $this->beginWidget('CActiveForm',array(
								'method'=>'get',
								'htmlOptions'=>array(
									'role'=>'form',
									'class'=>'form-inline'
									)
					)); ?>
						<div class="form-group">
							<?php echo CHtml::label('Mes del reporte','OrdenMudanza_fecha_creacion'); ?>
							<?php echo $form->dropDownList($model,"fecha_creacion",$model->getLisDateMinMax(),array('class'=>'form-control')); ?>
							<?php echo CHtml::submitButton('Filtrar',array('class'=>'btn btn-primary')); ?>
						</div>
					<?php $this->endWidget(); ?>

					<?php $this->widget('zii.widgets.grid.CGridView',array(
							'id'=>'reporte-mudanza',
							'dataProvider'=>$model->reporteMudanza(),
							'template'=>'{items}{pager}',
							'ajaxUpdate'=>false,				
							'columns'=>array(
								array(
									'name'=>'id',
									'type'=>'raw',
									'value'=>'CHtml::link($data->id,Yii::app()->controller->createUrl("ordenMudanza/view",array("id"=>$data->id)))',
									'htmlOptions'=>array(
										'width'=>'5%'
										)
									),
								array(
									'name'=>'fecha_creacion',
									'header'=>'Fecha',
									'type'=>'raw',
									'value'=>'date("d/m/Y",strtotime($data->fecha_creacion))',
									'htmlOptions'=>array(
										'width'=>'10%'
										)
									),
								array(
									'name'=>'cliente_id',
									'type'=>'raw',
									'value'=>'$data->cliente->getInformacion(30)',
									'htmlOptions'=>array(
										'width'=>'35%'
										)
									),
								array(
									'name'=>'ciudad_origen',
									'type'=>'raw',
									'value'=>'$data->ciudadOrigen->getCiudadCompleto()',
									'htmlOptions'=>array(
										'width'=>'15%'
										)
									),
								array(
									'name'=>'ciudad_destino',
									'type'=>'raw',
									'value'=>'$data->ciudadDestino->getCiudadCompleto()',
									'htmlOptions'=>array(
										'width'=>'15%'
										)
									),
								array(
									'name'=>'estado',
									'type'=>'raw',
									'value'=>'$data->getEstadosRaw()',
									'htmlOptions'=>array(
										'width'=>'20%'
										)
									)
								)							
							)
						);
					?>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div id="chart-mudanza"></div>
					<div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Indicador de inconsistencia por operario</h3>
							</div>
							<div class="panel-body">
								<?php $this->widget('ext.yiibooster.widgets.TbGridView',array(
									'dataProvider'=>$model->reporteMaxInconsistencia(),
									'template'=>'{items}',
									'columns'=>array(										
										array(											
											'header'=>'Nombre operario',
											'type'=>'raw',
											'value'=>'CHtml::link($data->getNombreCompleto(),Yii::app()->controller->createUrl("usuario/view",array("id"=>$data->id)))'
											),
										array(
											'header'=>'Cant.',
											'type'=>'raw',
											'value'=>'$data->n_inconsistencia',
											'htmlOptions'=>array(
												'style'=>'text-align:center',
												'width'=>'10%'
												)
											)
										)
									)
								); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 		
		Yii::app()->clientScript->registerScript('chart1',"
			var donut = new Morris.Donut({
				element: 'chart-mudanza',
				resize: true,
				colors: ['#d2d6de','#dd4b39','#f0ad4e'],
				data:".$model->getIndicadores().",
				hideHover: 'auto'
			});
			",CClientScript::POS_READY);
	 ?>