        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/user_icon.png" class="img-circle" alt="User Image" />
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