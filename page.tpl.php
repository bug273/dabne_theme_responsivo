<?php
?>
  <?php print render($page['header']); ?>

  <div id="wrapper">
    <div id="container" class="clearfix">

      <div id="header">
        <div id="logo-floater">
        <?php if ($logo || $site_name): ?>
          <?php if ($title): ?>
            <div id="branding"><strong><a href="<?php print $front_page ?>">
            <?php if ($logo): ?>
              <img src="<?php print $logo; ?>" alt="<?php print t('Home') ?>" title="<?php print t('Home') ?>" id="logo" />
            <?php endif; ?>
            <?php print $site_name ?>
            </a></strong></div>
          <?php else: /* Utiliza h1 cuando el nombre del contenido esta vacio */ ?>
            <h1 id="branding"><a href="<?php print $front_page ?>">
            <?php if ($logo): ?>
              <img src="<?php print $logo ?>" alt="<?php print ($site_name || $site_slogan) ?>" title="<?php print ($site_name || $site_slogan) ?>" id="logo" />
            <?php endif; ?>
            <?php print $site_name ?>
            </a></h1>
        <?php endif; ?>
        <?php endif; ?>
        </div>

        <?php if ($tabs && ($tabs['#primary'] || $tabs['#secondary'])): ?>
          <div class="tabs">
            <?php print render($tabs); ?>
          </div>
        <?php endif; ?>

        <?php print render($page['branding']); ?>
        <?php print render($page['header']); ?>
        <?php print render($page['main_menu']); ?>
          <?php print theme('links__system_main_menu', array(
            'links' => $main_menu,
            'attributes' => array(
              'id' => 'main-menu',
              'class' => array(
                'links', 'inline', 'clearfix',
              ),
            ),
           
          )); ?>
        <?php print render($page['navigation']); ?>

      </div> <!-- /#header -->
      
      <!-- Search --> 
      <?php if($page['search']): ?>
        <div id="search">
          <?php print render($page['search']); ?>
        </div>
      <?php endif; ?>

      <!-- Mainmenu -->
      <?php if($main_menu): ?>
        <div id="mainmenu">
          <?php print render($page['mainmenu']); ?> 
        </div>
      <?php endif; ?> 

      <!-- Breadcrumb --> 
      <?php if($breadcrumb): ?>
        <div id="breadcrumb">
          <?php print render($page['breadcrumb']); ?>
        </div>
      <?php endif; ?>
      
      <!-- Bloque de la derecha -->
      <?php if ($page['sidebar_first']): ?>
        <div id="sidebar-first" class="sidebar-uno">
          <?php print render($page['sidebar_first']); ?>
        </div>
      <?php endif; ?>


      <!-- Bloque de la izquierda -->
      <?php if($page['sidebar_second']): ?>
        <div id="sidebar-second" class="sidebar_dos">
          <?php print render($page['sidebar_second']); ?>
        </div>
      <?php endif; ?> 
      <?php print render($page['help']); ?>

      <!-- Contenido -->
      <!-- Título -->
      <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="title" id="page-title">
          <?php print $title; ?></h1>
        <?php endif; ?>
      <?php print render($title_suffix); ?>

      
      <div id="content">
        <?php print render($page['content']); ?>
      </div>

      <?php if($page['sidebar_first'] && $page['sidebar_second'] && theme_get_setting('layout_type') != 2 ): ?>
      <?php endif; ?>

      
    </div> <!-- /#container -->
  </div> <!-- /#wrapper -->
  <footer id="footer">
  <p>Tema creado por <a href="http://dabne.net">Dabne</a></p>
    <?php print render($page['footer']); ?>
  </footer>
