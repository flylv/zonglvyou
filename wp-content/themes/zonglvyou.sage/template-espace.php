<?php
/**
 * Template Name: User Order Search
 */
?>
<?php 
$result = false;
if(isset($_POST) && count($_POST)){
	if(isset($_POST['phone']) && $_POST['phone']){
		global $wpdb;
		$tb = $wpdb->prefix.'order';
		$sq = "SELECT * FROM $tb WHERE phone LIKE '".trim($_POST['phone'])."'";
	  	$result = $wpdb->get_results($sq);
	  }	
	
}?>

<?php while (have_posts()) : the_post(); ?>
	<div class="page-simple clearfix">	
	  <?php get_template_part('templates/page', 'header'); ?>	
		<div class="col-xs-12 col-sm-6 clearfix">
		<p class="text-center"><?php _e('查询已预订的行程或订单，请出入订单联系手机号。', 'sage'); ?></p>
		<form class="form-horizontal" id="searchOrder" action="<?php the_permalink()?>" method="POST" data-toggle="validator" role="form">
		  <div class="form-group">
		    <label for="phone" class="col-sm-3 control-label"><?php _e('手机号', 'sage'); ?><strong>*</strong></label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="phone" name="phone" placeholder="<?php _e('手机号', 'sage'); ?>" required>
		    </div>
		  </div>

		   <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10 text-center">
		      <button type="submit" name="submit" class="btn btn-success"><?php _e('查询', 'sage'); ?></button>
		    </div>
		  </div>
		</form>
		</div>

		<?php if ($result): ?>
			<?php $i=1;foreach ($result as $row): ?>
				<div class="col-xs-12 orderlist">
					<div class="col-xs-12 col-sm-6"><span><?php _e('订单', 'sage'); ?><?php echo $i ?> ： </span><?php echo get_the_title($row->trip_id);?></div>
					<div class="col-xs-12 col-sm-2"><span><?php _e('人数', 'sage'); ?> ： </span><?php echo $row->quality ?></div>					
					<div class="col-xs-12 col-sm-2"><span><?php _e('出发时间', 'sage'); ?> ：</span><?php echo $row->tripDate;?></div>
					<div class="col-xs-12 col-sm-2"><span><?php _e('状态', 'sage'); ?> ： </span><?php echo ($row->status)?'<font style="color:#0a0"">已处理</font>':'<font style="color:red"">未处理</font>';?></div>
				<hr/>
				</div>
			<?php $i++;endforeach ?>
		<?php elseif(isset($_POST)  && count($_POST)): ?>
			<div class="col-xs-12 ">
				<p class="text-center"><?php _e('对不起，没有相关信息，请确认您的手机号码或联系管理员。', 'sage'); ?></p>
			</div>
		<?php endif ?>
	</div>
<?php endwhile; ?>


