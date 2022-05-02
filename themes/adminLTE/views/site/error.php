<section class="content">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/logo_32.png','alt'); ?> <b>Mud</b>App</a>
		</div>
		<div class="login-box-body">
			<h2>Error <?php echo $code; ?></h2>

			<div class="error">
			<?php echo CHtml::encode($message); ?>
			</div>
		</div>
	</div>
	
</section>