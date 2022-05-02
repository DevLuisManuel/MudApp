<div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/user_icon.png" class="user-image" alt="User Image"/>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $this->getUserInfo('username') ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/user_icon.png" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $this->getUserInfo('nombre')." ".$this->getUserInfo('apellido'); ?>

                      <small><?php echo $this->getUserInfo('username'); ?></small>
                    </p>
                  </li>                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <?php echo CHtml::link('Salir',array('/site/logout'),array('class'=>'btn btn-default btn-flat')); ?>
                    </div>
                  </li>
                </ul>
              </li>              
            </ul>
          </div>