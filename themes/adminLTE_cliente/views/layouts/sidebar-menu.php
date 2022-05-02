          <?php $menus = array(
            array('titulo'=>'Inicio','controller'=>'DefaultController','url'=>$this->createUrl('default/index'),'icon'=>'fa fa-home'),
              array('titulo'=>'Ordenes de mudanza','controller'=>'OrdenMudanzaController','url'=>$this->createUrl('ordenMudanza/index'),'icon'=>'fa fa-truck'),
              array('titulo'=>'Cuenta','controller'=>'CuentaController','url'=>$this->createUrl('cuenta/'),'icon'=>'fa fa-user'),              
          ); ?>
          <ul class="sidebar-menu">
            <li class="header">Navegación principal</li>
            <?php foreach($menus as $key=>$value): ?>
                <li<?php echo get_class($this)==$value['controller']?' class="active"':''; ?>><a href="<?php echo $value['url']; ?>"><i class="<?php echo $value['icon']; ?>"></i> <span><?php echo $value['titulo']; ?></span></a></li>
            <?php endforeach; ?>
          </ul>          