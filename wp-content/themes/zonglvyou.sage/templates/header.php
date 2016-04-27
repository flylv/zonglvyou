<div class="topbrand">
    <div class="text-right">
        <span class="glyphicon glyphicon-envelope"></span>contact@europeluyou.com | <span class="glyphicon glyphicon-earphone"></span>+33 01 44 23 80 86（法国）
    </div>
</div>
<header class="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <button class="menuSwitch" type="button" data-toggle="collapse" data-target=".nav-primary" aria-expanded="false" aria-controls="nav-primary" class="collapsed">
      <?php _e("MENU") ?><span class="glyphicon glyphicon-align-justify" ></span>
    </button>
    <nav class="nav-primary" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
    <a href="<?php echo get_permalink(244)?>" class="checkOrder"><?php _e('我的订单', 'sage'); ?></a>
    
  </div>
</header>
