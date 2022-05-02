          <?php $menus = array(
              array('titulo'=>'Inicio','controller'=>'SiteController','url'=>$this->createUrl('/site/dashboard'),'icon'=>'fa fa-home'),
              array('titulo'=>'Ordenes de Mudanza','controller'=>'OrdenMudanzaController','url'=>$this->createUrl('/ordenMudanza'),'icon'=>'fa fa-truck'),
              array('titulo'=>'Usuarios','controller'=>'UsuarioController','url'=>$this->createUrl('/usuario'),'icon'=>'fa fa-users'),
              array('titulo'=>'Cliente','controller'=>'ClienteController','url'=>$this->createUrl('/cliente'),'icon'=>'fa fa-user'),
              array('titulo'=>'Reportes','controller'=>'ReportesController','url'=>$this->createUrl('/reportes'),'icon'=>'fa fa-bar-chart')
          ); ?>
          <ul class="sidebar-menu">
            <li class="header">Navegación principal</li>
            <?php foreach($menus as $key=>$value): ?>
                <li<?php echo get_class($this)==$value['controller']?' class="active"':''; ?>><a href="<?php echo $value['url']; ?>"><i class="<?php echo $value['icon']; ?>"></i> <span><?php echo $value['titulo']; ?></span></a></li>
            <?php endforeach; ?>
          </ul>          