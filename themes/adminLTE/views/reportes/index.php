<?php
$this->layout = '/layouts/column1';
?>
<section class="content-header">
	<h3 class="title"><span class="fa fa-bar-chart"></span> Reportes</h3>
</section>
<section class="content">
	<?php echo $this->renderPartial('reporte_mudanza',array('model'=>$model1)); ?>
</section>

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/plugins/morris/morris.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/dist/js/raphael-min.js',CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/plugins/morris/morris.min.js',CClientScript::POS_END); ?>