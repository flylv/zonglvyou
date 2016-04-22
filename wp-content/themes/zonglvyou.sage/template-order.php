<?php
/**
 * Template Name: Order Page
 */
?>
<?php 
$result = false;
$tripId = false;
if(isset($_POST) && count($_POST)){
	global $wpdb;
	$tb = $wpdb->prefix.'order';
	$result = $wpdb->insert( $tb, array( 
			'trip_id' => (int)$_POST['tripId'], 
			'quality' => (int)$_POST['quality'], 
			'name' => $_POST['username'], 
			'phone' => $_POST['phone'],
			'tripDate' => $_POST['tripDate'],  
	));
}?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
	<div class="order-dev well clearfix">
		<?php if($result && $_POST['tripId']): ?>
		<?php $tripId = $_POST['tripId']?>	
		<?php if (get_field( "adminemail")) {
			$headers = "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
			$headers .= "From: ".get_bloginfo('name')." <contact@xxxx.com>" . "\r\n";
			$message = "<p>新的行程已预订：</p><p>旅行路线：".get_the_title($tripId)."</p><p>出发日期: ".$_POST['tripDate']."</p><p>联系人姓名: ".$_POST['username']."</p><p>手机号: ".$_POST['phone']."</p><p>旅行人数: ".$_POST['quality']."</p>";
			wp_mail( get_field( "adminemail"), "预订行程", $message, $headers);
		} ?>
		<div class="col-xs-12 col-sm-6">
			<?php if (get_field( "success_text")): ?>
	          <div><?php echo get_field( "success_text") ?></div>
	        <?php endif ?>
	        <p class="text-center"><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('返回主页', 'sage'); ?></a></p>
		</div>
		<?php elseif (isset($_GET['token']) && $_GET['token']) :?>		
		<?php $tripId =  $_GET['token'];?>	
			<div class="col-xs-12 col-sm-6">
			<form class="form-horizontal" id="orderForm" action="<?php the_permalink()?>" method="POST" data-toggle="validator" role="form">
				<input type="hidden" name="tripId" value="<?php echo $tripId?>">

				<div class="form-group">
				 	<label for="username" class="col-sm-3 control-label"><?php _e('出发日期', 'sage'); ?></label>
	                <div class='input-group date col-sm-9' id='datetimepicker'>
	                    <input type='text' class="form-control" name="tripDate" />
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>
	            </div>

			  <div class="form-group">
			    <label for="username" class="col-sm-3 control-label"><?php _e('联系人姓名', 'sage'); ?><strong>*</strong></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="username" name="username" placeholder="<?php _e('姓名', 'sage'); ?>" required>
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="quality" class="col-sm-3 control-label"><?php _e('旅行人数', 'sage'); ?></label>
			    <div class="col-sm-9">
			      <select class="form-control" name="quality">
				  	<?php for ($i=1; $i <= 20; $i++) :?>
				  		 <option value="<?php echo $i ?>"><?php echo $i ?></option>
			  		<?php endfor; ?>				 
					</select>
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="phone" class="col-sm-3 control-label"><?php _e('手机号', 'sage'); ?><strong>*</strong></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="phone" name="phone" placeholder="<?php _e('手机号', 'sage'); ?>" required>
			    </div>
			  </div>

			
			   <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10 text-center">
			      <button type="submit" name="submit" class="btn btn-success"><?php _e('确定', 'sage'); ?></button>
			    </div>
			  </div>
			</form>
			</div>
		<?php endif ?>

		<?php if ($tripId): ?>
			<div class="col-xs-12 col-sm-6 des">			
				 <?php $furtureImg = wp_get_attachment_image_src(get_post_thumbnail_id($tripId), 'full' );
			    if(count($furtureImg))
			      $url = $furtureImg[0];
			    else
			      $url = '';
			   ?>
			   	<a href="<?php echo get_permalink($tripId)?>" target="_blank">
				  <div class="col-xs-12 col-sm-5 trip-img" style="background-image: url(<?php echo $url; ?>)"></div>
			   </a>
		      <div class="col-xs-12 col-sm-7">
		      		<a href="<?php echo get_permalink($tripId)?>" target="_blank"><h2 class="orderTitle"><?php echo $tripTitle = get_the_title($tripId);?></h2></a>
		      		<?php if (get_field( "totalprice",$tripId)): ?>
						<div class="priceInfo"><span class="price"><?php echo get_field( "totalprice",$tripId) ?></span> <?php _e('起/人', 'sage'); ?></div>
					<?php endif ?>

					<a href="<?php echo get_permalink($tripId)?>" class="moreinfo" target="_blank"><?php _e('查看线路详情', 'sage'); ?>>></a>
		      </div>
		     
			</div>
		<?php endif ?>
	</div>
<?php endwhile; ?>


