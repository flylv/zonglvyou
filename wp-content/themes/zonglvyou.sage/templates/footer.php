<footer class="content-info container">
<div class="col-xs-12 col-sm-2">
	Logo
</div>
 <div class="col-xs-12 col-sm-8">
      <?php
      if (has_nav_menu('second_navigation')) :
        wp_nav_menu(['theme_location' => 'footer', 'menu_class' => 'footermenu']);
      endif;
      ?>
</div>
  <div class="col-xs-12 col-sm-2">
   wechat
  </div>
</footer>
