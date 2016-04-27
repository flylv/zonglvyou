<?php
/**
 * Template Name: Custom Trip Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  	<div id="customeTrip" class="row">
  	<div class="col-xs-12 col-sm-6">
  		<div class="custom-form ">
  		<h1><?php the_title() ?></h1>
  			<?php the_content(); ?>
		</div>
  	</div>
	<div class="col-xs-12 col-sm-6">
		<?php if (get_field( "textarea_top")): ?>
			<div class="custome-text"><?php echo get_field( "textarea_top") ?></div>
			<hr/>
		<?php endif ?>

		<?php if (get_field( "textarea_Middle")): ?>
			<div class="custome-text"><?php echo get_field( "textarea_Middle") ?></div>
		<?php endif ?>
	</div>

	<div class="col-xs-12">		
		<?php if (get_field( "textarea_bot")): ?>
			<div class="custome-bot"><?php echo get_field( "textarea_bot") ?></div>
		<?php endif ?>
	</div>

  </div>

  
<?php endwhile; ?>
