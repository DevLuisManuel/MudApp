<?php $this->action_name = "Registro"; ?>

<div class="register-box" style="width:750px">
      <div class="register-logo">
        <a href="#"><?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/logo_32.png','alt'); ?> <b>Mud</b>App</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Registro de clientes</p>

        <?php echo $this->renderPartial('_form',array('model'=>$model,'userpassword'=>true)); ?>        
            
        <br />
        <?php echo CHtml::link('Ya tengo una cuenta, iniciar sesión','login',array('class'=>'text-center')); ?>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->