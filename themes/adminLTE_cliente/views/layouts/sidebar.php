        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <?php echo CHtml::image('http://www.gravatar.com/avatar/'.md5($this->getUserInfo('email')).'?s=50','avatar',array('class'=>'img-circle')); ?>
            </div>
            <div class="pull-left info">
              <p><?php echo Yii::app()->user->getName(); ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>          
          <!-- Sidebar Menu -->
          <?php echo $this->renderPartial('/layouts/sidebar-menu'); ?>
          <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->