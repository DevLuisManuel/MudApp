					<p>
						Búsque un cliente por documento de identidad:
					</p>
					<div class="form-group">
						<?php echo $form->label($search,'tipo_documento_id'); ?>
						<?php echo $form->dropDownList($search,'tipo_documento_id',CHtml::listData(TipoDocumento::model()->findAll(),'id','nombre'),array('empty'=>'Seleccione...','class'=>'form-control')); ?>
						<?php echo $form->error($search,'tipo_documento_id',array('class'=>'text-danger')); ?>
					</div>

					<div class="form-group">
						<?php echo $form->label($search,'documento'); ?>
						<?php echo $form->textField($search,'documento',array('class'=>'form-control')); ?>
						<?php echo $form->error($search,'documento',array('class'=>'text-danger')); ?>						
					</div>

					<div>
						<?php echo CHtml::submitButton('Búscar cliente',array('class'=>'btn btn-primary btn-block btn-flat')); ?>
					</div>
