<div class="login-box">
      <div class="login-logo">
        <a href="#"><?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/logo_32.png'); ?><b>Mud</b>App</a> Clientes
      </div><!-- /.login-logo -->
      <?php if(Yii::app()->user->hasFlash('success')): ?>
          <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('success'); ?></div>
        <?php endif; ?>
      <div class="login-box-body">        
        <p class="login-box-msg">Ingrese su email y contraseña para iniciar sesión.</p>
        <?php $form = $this->beginWidget('CActiveForm',array(
          'id'=>'loginForm',
          'enableClientValidation'=>true,
          'enableAjaxValidation'=>false,
          'clientOptions'=>array(
            'validateOnSubmit'=>true
            )
          )
        ); 
          
          ?>     
          <div class="form-group has-feedback">
            <!-- <input type="email" class="form-control" placeholder="Email"/> -->
            <?php echo $form->textField($model,'username',array('class'=>'form-control','placeholder'=>'Email')); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback" style="top:0px"></span>
            <p><?php echo $form->error($model,'username',array('class'=>'text-danger')); ?></p>
          </div>
          <div class="form-group has-feedback">
            <!-- <input type="password" class="form-control" placeholder="Password"/> -->
            <?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>'Contraseña')); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback" style="top:0px"></span>
            <p><?php echo $form->error($model,'password',array('class'=>'text-danger')); ?></p>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck" style="padding-left:0px">
                <label>
                  <!-- <input type="checkbox"> Recordar mis datos -->
                  <?php echo $form->checkBox($model,'rememberMe'); ?> Mantener la sesión abierta
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
            </div><!-- /.col -->
          </div>
        <?php $this->endWidget(); ?>

        <?php echo CHtml::link('Crear una cuenta','registro'); ?>

      </div><!-- /.login-box-body -->