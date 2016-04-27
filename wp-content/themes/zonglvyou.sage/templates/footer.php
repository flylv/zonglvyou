<div class="container">
  <div class="friendLinker well clearfix row">
    <div class="col-xs-12 col-sm-1">
      <span><?php _e('友情链接', 'sage'); ?></span>
    </div>
    <div class="col-xs-12 col-sm-11">
       <?php
        if (has_nav_menu('footer')) :
          wp_nav_menu(['theme_location' => 'friend_liner', 'menu_class' => 'friendLinkermenu']);
        endif;
        ?>
    </div>    
  </div>  
</div>
<footer class="content-info clearfix">
<div class="fixbar hidden-xs well">
  <ul>
    <li class="qq"><span></span><ul><li>666565656</li></ul></li>
    <li class="wechat"><span></span><ul><li>666565656</li></ul></li>
    <li class="phone"><span></span><ul><li>666565656</li></ul></li>
  </ul>
</div>
<div class="container">
<div class="col-xs-12 col-sm-2">
	<div id="logo"></div>
</div>
 <div class="col-xs-12 col-sm-8">
      <?php
      if (has_nav_menu('footer')) :
        wp_nav_menu(['theme_location' => 'footer', 'menu_class' => 'footermenu']);
      endif;
      ?>
      <div class="site-info">
      	<p>客服专线：+33 01 44 23 80 86 (工作时间：早9点 - 晚7点) </p>
		<p>地址：6 Avenue de Choisy, 75013 Paris France. RCS number: 819 218 231</p>
      </div>
</div>
  <div class="col-xs-12 col-sm-2 text-right">
   wechat
  </div>
</div>
</footer>
