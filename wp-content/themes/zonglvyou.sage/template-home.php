<?php
/**
 * Template Name: Home Page
 */
?>

<?php while (have_posts()) : the_post(); ?>

<?php if( have_rows('slideshow') ): ?>
<div id="homeslide" class="carousel slide" data-ride="carousel">
<a href="<?php echo get_permalink(17)?>" title="<?php _e('帮我订制行程', 'sage'); ?>" class="privite"><span class="glyphicon glyphicon-send"></span><?php _e('帮我订制行程', 'sage'); ?></a>

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
<div class="all-cat clearfix well animated fadeInDown">
	<div class="col-xs-12 col-sm-3">
		<div class="list-left">
			<h2><?php _e('热门路线', 'sage'); ?></h2>
		 	<?php if (has_nav_menu('hot_trip')) :
		    	wp_nav_menu(['theme_location' => 'hot_trip', 'menu_class' => 'hotTrip']);
		  	endif;?>
		</div>	 
	</div>

	<div class="col-xs-12 col-sm-9">
	<div class="highline">
		<?php $i=1;foreach (get_terms('category') as $cat) : ?>
			<?php if($i>8) break; ?>
		 	<?php if(z_taxonomy_image_url($cat->term_id)): ?>
			 <a href="<?php echo get_term_link($cat->slug, 'category'); ?>" >
			 <div class="col-xs-6 col-sm-3 items clearfix" style="background-image: url(<?php echo z_taxonomy_image_url($cat->term_id); ?>);">
			 	<?php echo $cat->name; ?>
			 </div>
			 </a>
			<?php $i++;endif; ?>
	 	<?php endforeach; ?>
 	</div>
	</div>
</div>

<div class="hightrip clearfix animated fadeInUp">
<h2 class="home-title"><?php _e('当季主推行程', 'sage'); ?></h2>
	<?php
	$args = array( 
		'posts_per_page' => 4,
		'category_name' => 'hightrip',
		'post_status'      => 'publish',
		'post_type'        => 'trip',
	);
	$lastposts = get_posts( $args );

	foreach ( $lastposts as $post ) : setup_postdata( $post ); ?>
	<?php $furtureImg = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID),'full');

		if(count($furtureImg))
			$url = $furtureImg[0];
		else
			$url = '';
	 ?>
	<div class="col-xs-12 col-sm-3">
		<a href="<?php the_permalink(); ?>" class="tirpTitle">
		<div class="items img-rounded" style="background-image: url(<?php echo $url; ?>);">
			<div class="des">
				<?php the_title(); ?>
				<?php if (get_field( "totalprice")): ?>
					<div class="priceInfo"><span class="price"><?php echo get_field( "totalprice") ?></span> <?php _e('起/人', 'sage'); ?></div>
				<?php endif ?>
				
			</div>
		</div>
		</a>
	</div>	

	<?php endforeach; 
	wp_reset_postdata(); ?>
</div>
</div>
<?php endwhile; ?>

