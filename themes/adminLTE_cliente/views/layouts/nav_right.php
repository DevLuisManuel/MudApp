<div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <?php echo CHtml::image('http://www.gravatar.com/avatar/'.md5($this->getUserInfo('email')).'?s=50','avatar',array('class'=>'user-image')); ?>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $this->getUserInfo('primer_nombre') ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/user_icon.png" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $this->getUserInfo('primer_nombre')." ".$this->getUserInfo('primer_apellido'); ?>

                      <small><?php echo $this->getUserInfo('email'); ?></small>
                    </p>
                  </li>                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <?php echo CHtml::link('Salir',$this->createUrl('default/logout'),array('class'=>'btn btn-default btn-flat')); ?>
                    </div>
                  </li>
                </ul>
              </li>              
            </ul>
          </div>