<?php
$args = array(
'post_type' => 'trip',
'post_status' => 'publish',
'posts_per_page' => -1,
'cat' => get_query_var('cat')
);
$the_query = new WP_Query($args);?>
<div class="cat-info clearfix img-rounded">
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
<div class="col-xs-12 col-sm-9 tirp-list">
<?php $i = 1; while ($the_query->have_posts()) :  $the_query->the_post(); ?>
  <?php $furtureImg = wp_get_attachment_image_src(get_post_thumbnail_id( $the_query->ID), 'full' );
    if(count($furtureImg))
      $url = $furtureImg[0];
    else
      $url = '';
   ?>
  <div class="well row items">
    <a href="<?php the_permalink()?>" title="<?php the_title(); ?>">
      <div class="col-xs-12 col-sm-5 trip-img" style="background-image: url(<?php echo $url; ?>)">
         <div class="tip-num"><?php _e('线路', 'sage'); ?> <i><?php echo $i ?></i></div>
      </div>
    </a>
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
<!--         <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#tripSum<?php echo $i ?>" aria-expanded="false" aria-controls="ripSum<?php echo $i ?>">
          <?php _e('行程概要', 'sage'); ?>
        </button> -->

        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#tripSum<?php echo $i ?>" aria-expanded="false" aria-controls="ripSum<?php echo $i ?>"><?php _e('咨询顾问', 'sage'); ?></button>
        <a class="btn btn-warning" href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php _e('详细行程', 'sage'); ?></a>
      </div>

    <div class="collapse" id="tripSum<?php echo $i ?>">
      <div class="contactForm">
      <p><?php _e('请输入电话号码，我们会主动跟您联系。', 'sage'); ?></p>
      <?php if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 11 ); }?>
      </div>
    </div> 
      
    </div>
  </div>
<?php $i++;endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>

<div class=" col-xs-12 col-sm-3">
    <div class="client clearfix">
     <h2 class="home-title"><?php _e('旅行归来用户体验', 'sage'); ?></h2>
        <?php
        $args = array( 
                'posts_per_page' => 4,
                'post_status'      => 'publish',
                'post_type'        => 'clientcomment',
        );
        $lastposts = get_posts( $args );

        foreach ( $lastposts as $post ) : setup_postdata( $post ); ?>
        <div class="col-xs-12 comment-div">
            <div class="user"><span class="glyphicon glyphicon-user"></span><?php the_title()?></div>
            <div class="comments">				
                    <?php the_content();?>
            </div>
            <div class="happy"><?php _e('满意度', 'sage'); ?> : <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span></div>
        </div>
        <?php endforeach; 
        wp_reset_postdata(); ?>
    </div>
</div>
<div id="cboxOverlay"></div>


