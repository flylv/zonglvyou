<div class="topbrand">
    <div class="text-right">
        <span class="glyphicon glyphicon-envelope"></span>contact@europeluyou.com | <span class="glyphicon glyphicon-earphone"></span>xxx 84 xxx 85（中国）+xxxxxxxxxx（法国）
    </div>
</div>
<header class="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
  </div>
</header>
