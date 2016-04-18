<footer class="content-info clearfix">
<div class="container">
<div class="col-xs-12 col-sm-2">
	Logo
</div>
 <div class="col-xs-12 col-sm-8">
      <?php
      if (has_nav_menu('footer')) :
        wp_nav_menu(['theme_location' => 'footer', 'menu_class' => 'footermenu']);
      endif;
      ?>
      <div class="site-info">
      	<p>客服专线：xxx-xxx-xxx (工作时间：早9点 - 晚7点) 传真：xxx-xxxxxxxxx</p>
		<p>地址：法国巴黎xxxxxx街xxx号</p>
      </div>
</div>
  <div class="col-xs-12 col-sm-2 text-right">
   wechat
  </div>
</div>
</footer>
