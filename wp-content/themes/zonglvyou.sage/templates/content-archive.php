<?php
$args = array(
'post_type' => 'trip',
'post_status' => 'publish',
'posts_per_page' => -1,
'cat' => get_query_var('cat')
);
$the_query = new WP_Query($args);?>
<div class="cat-info clearfix img-rounded animated slideInLeft">
  <div class="col-xs-2 cat-name">
    <h1><?php echo get_cat_name(get_query_var('cat') ) ?></h1>
    <div class="trip-count">
      <?php _e('一共有', 'sage'); ?><?php echo count($the_query->posts) ?><?php _e('条路线', 'sage'); ?>
    </div>
  </div>
  
  <?php if (z_taxonomy_image_url(get_query_var('cat'))): ?>
    <div class="col-xs-10 cat-img" style="background-image: url(<?php echo z_taxonomy_image_url(get_query_var('cat')); ?>)"></div>
  <?php endif ?>
 
</div>
<div class="main tirp-list animated slideInRight">
<?php $i = 1; while ($the_query->have_posts()) :  $the_query->the_post(); ?>
  <?php $furtureImg = wp_get_attachment_image_src(get_post_thumbnail_id( $the_query->ID), 'full' );
    if(count($furtureImg))
      $url = $furtureImg[0];
    else
      $url = '';
   ?>
  <div class="well row items">
    <div class="col-xs-12 col-sm-5 trip-img" style="background-image: url(<?php echo $url; ?>)">
       <div class="tip-num"><?php _e('线路', 'sage'); ?> <i><?php echo $i ?></i></div>
    </div>
    <div class="col-xs-12 col-sm-7">
      <h2><?php the_title(); ?></h2>
      <div class="trip-meta">       
     
        <?php if (get_field( "city")): ?>
          <span><?php _e('出发城市', 'sage'); ?>： <?php echo get_field( "city") ?></span>
        <?php endif ?>

        <?php if (get_field( "thedays")): ?>
          <span><?php _e('行程天数', 'sage'); ?>： <?php echo get_field( "thedays") ?></span>
        <?php endif ?>


        <hr/>
         <?php if (get_field( "thefocus")): ?>
          <div><?php echo get_field( "thefocus") ?></div>
        <?php endif ?>
      
      </div>
      <div class="text-right">       
        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#tripSum<?php echo $i ?>" aria-expanded="false" aria-controls="ripSum<?php echo $i ?>">
          <?php _e('行程概要', 'sage'); ?>
        </button>

        <a class="btn btn-info" href="<?php echo get_permalink(17)?>" target="_blank" title="<?php _e('订制行程', 'sage'); ?>"><?php _e('订制行程', 'sage'); ?></a>
        <a class="btn btn-warning" href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php _e('详细行程', 'sage'); ?></a>
      </div>

    <div class="collapse" id="tripSum<?php echo $i ?>">
      <div><?php the_content() ?></div>
    </div>
      
    </div>
  </div>
<?php $i++;endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>


