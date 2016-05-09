<?php
/**
 * Template Name: Home Page
 */
?>

<?php while (have_posts()) : the_post(); ?>
<div id="homepage">

<?php if( have_rows('slideshow') ): ?>
<div id="homeslide" class="carousel slide" data-ride="carousel" data-interval="3000">
<a href="<?php echo get_permalink(17)?>" title="<?php _e('帮我订制行程', 'sage'); ?>" class="privite"><?php _e('帮我订制行程', 'sage'); ?></a>

<ol class="carousel-indicators">
	<?php $i = 0;
  	while( have_rows('slideshow') ): the_row(); ?>
    <li data-target="#homeslide" data-slide-to="<?php echo $i?>" class="<?php if($i == 0) echo 'active' ?>"></li>
	<?php $i++;endwhile; ?>
</ol>
<div class="carousel-inner" role="listbox">
  <?php $first = true;
  while( have_rows('slideshow') ): the_row(); ?>
    <?php  
    $image = get_sub_field('image');
    $link = get_sub_field('link');?>
    <?php if($image):?>
		<div class="item <?php if($first) echo 'active'?>">
			<?php if($link):?>
				<a href="<?php echo $link ?>">
			<?php endif ?>

		    <div class="img" style="background-image: url(<?php echo $image; ?>);">
				
		    </div> 
	
		    <?php if($link):?>
				</a>
			<?php endif ?>
		</div>
	<?php $first = false; endif ?>
  <?php endwhile; ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#homeslide" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#homeslide" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php endif; ?>

<div class="container">

<div class="clearfix animated fadeIn">
	<h2><?php _e('主题定制', 'sage'); ?></h2>
	<?php if (has_nav_menu('discovery_trip')) :?>
	<div class="discovery">
		<?php $i=1;foreach (wp_get_nav_menu_items("Discovery world") as $row) : ?>
		 	<?php if(z_taxonomy_image_url($row->object_id)): ?>
			 <a href="<?php echo $row->url; ?>" >
			 <div class="col-xs-12 <?php if($i == 1) echo 'col-sm-8';elseif($i == 7) echo 'col-sm-8';else echo 'col-sm-4'?> items clearfix" style="background-image: url(<?php echo z_taxonomy_image_url($row->object_id); ?>);">
			 	<div class="title"><?php echo $row->title; ?></div>
			 </div>
			 </a>
			<?php $i++;endif; ?>
	 	<?php endforeach; ?>
 	</div>
<?php endif;?>
</div>

<div class="clearfix animated fadeInDown">
	<h2><?php _e('热门路线', 'sage'); ?></h2>
	<?php if (has_nav_menu('hot_trip')) :?>
	<div class="highline">
		<?php foreach (wp_get_nav_menu_items("Hot trip") as $row) : ?>
		 	<?php if(z_taxonomy_image_url($row->object_id)): ?>
			 <a href="<?php echo $row->url; ?>" >
			 <div class="col-xs-12 col-sm-4 items clearfix" style="background-image: url(<?php echo z_taxonomy_image_url($row->object_id); ?>);">
			 	<div class="title"><?php echo $row->title; ?></div>
			 </div>
			 </a>
			<?php ;endif; ?>
	 	<?php endforeach; ?>
 	</div>
<?php endif;?>	
</div>



<div class="hightrip clearfix animated fadeInUp">
<h2 class="home-title"><?php _e('当季主推', 'sage'); ?></h2>
	<?php
	$args = array( 
		'posts_per_page' => 8,
		'category_name' => 'hightrip',
		'post_status'      => 'publish',
		'post_type'        => 'trip',
	);
	$lastposts = get_posts( $args );

	$i=1;foreach ( $lastposts as $post ) : setup_postdata( $post ); ?>
	<?php $furtureImg = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID),'full');

		if(count($furtureImg))
			$url = $furtureImg[0];
		else
			$url = '';
	 ?>
	<a href="<?php the_permalink(); ?>">
	<div class="col-xs-12 col-sm-3 items clearfix <?php if( ($i<4 && $i%2) || ($i > 4 && !($i%2))) echo 'signle'?>" style="background-image: url(<?php echo $url; ?>);">
		<div class="insider" style="background:#fff;">
		<div class="title">
			<?php if (get_field( "home_icon")): ?>
				<img class="theIcon" src="<?php echo get_field( "home_icon")?>" />
			<?php endif ?>
			<?php the_title(); ?>
		</div>	
		</div>	
	</div>	
	</a>

	<?php $i++;endforeach; 
	wp_reset_postdata(); ?>
</div>
</div>
</div>
<?php endwhile; ?>

