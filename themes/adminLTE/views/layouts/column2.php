<?php /* @var $this Controller */ ?>
<style>
.box-header>.nav>li>a {
	padding: 0px 10px 3px 10px !important;
}
</style>
<?php $this->beginContent('//layouts/main'); ?>
<section class="content-header">
	<h1><?php echo $this->controller_name; ?></h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-header with-border"> 
			<h3 class="box-title"><?php echo $this->action_name; ?></h3>
			<?php $this->widget('ext.yiibooster.widgets.TbMenu', array(
			    'type'=>'pills',
			    #'tooltip'=>'bottom',
			    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom: 0px'),
			    'items'=>$this->menu,
			)); ?>
		</div>
		<div class="box-body">
			<?php echo $content; ?>
		</div>
	</div>
</section>
<?php $this->endContent(); ?>