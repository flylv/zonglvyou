<?php
/**
 * Template Name: Order Page
 */
?>
<?php 
if(isset($_POST) && count($_POST)){
	var_dump($_POST);exit;
	global $wpdb;
	$tb = $wpdb->prefix.'order';
	$result = $wpdb->insert( $tb, array( 
			'trip_id' => (int)$_POST['tripId'], 
			'quality' => (int)$_POST['quality'], 
			'status' => 1, 
			'name' => $_POST['name'], 
			'phone' => $_POST['phone'], 
	));
	if($result)
		echo 'good';
	else
		echo 'erroe';
}
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
	<div>
		<?php if (isset($_GET['token']) && $_GET['token']) :?>
			<?php echo $tripTitle = get_the_title($_GET['token']);?>
			<form action="<?php the_permalink()?>" method="POST">
				<label>name</label><input type="text" name="name" value="" />
				<label>quality</label><input type="text" name="quality" value="" />
				<label>phone</label><input type="text" name="phone" value="" />
				<input type="hidden" name="tripId" value="<?php echo $_GET['token']?>">
				<input type="submit" name="submit" value="send" />
			</form>

		<?php endif ?>
	</div>
<?php endwhile; ?>
