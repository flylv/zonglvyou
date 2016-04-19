<div class="row well">
	<div class="col-xs-12">
		<h1><?php the_title()?></h1>
	</div>
	<div class="col-xs-12 col-sm-6">
		<?php if( have_rows('slideshow') ): ?>
		<div id="tripslide" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
		<div class="item active">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} ?>			
		</div>

		  <?php $i=1;
		  while( have_rows('slideshow') ): the_row(); ?>
		    <?php  
		    $image = get_sub_field('images');
		    if($image):?>
				<div class="item">
					<img src="<?php echo $image?>" />
				</div>
			<?php $i++;endif ?>
		  <?php endwhile; ?>
		  </div>
		  <ol class="carousel-indicators">
			<?php $j=0;
		  	while($j<$i):?>
		    <li data-target="#tripslide" data-slide-to="<?php echo $j?>" class="<?php if($j == 0) echo 'active' ?>"></li>
			<?php $j++;endwhile; ?>
		</ol>
		</div>
		<?php endif; ?>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="col-xs-12 col-sm-7">
			<div class="trip-meta">     
	        <?php if (get_field( "city")): ?>
	          <div><span><?php _e('出发城市', 'sage'); ?>：</span> <?php echo get_field( "city") ?></div>
	        <?php endif ?>

	        <?php if (get_field( "thedate")): ?>
	          <div><span><?php _e('出发日期', 'sage'); ?>：</span> <?php echo get_field( "thedate") ?></div>
	        <?php endif ?>

	        <?php if (get_field( "thedays")): ?>
	          <div><span><?php _e('行程天数', 'sage'); ?>：</span> <?php echo get_field( "thedays") ?></div>
	        <?php endif ?>
	        
	        <?php 
			$field = get_field_object('themenu');
			$value = $field['value'];
			if( $value ): ?>
		 	<div><span><?php _e('套餐包含', 'sage'); ?></span></div>
			<ul class="menuCon">
				<?php foreach( $value as $v ): ?>
				<li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					<?php echo $v; ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
	      </div>
      </div>
      
      <div class="col-xs-12 col-sm-5 trip-action">
      	<?php if (get_field( "totalprice")): ?>
			<div class="priceInfo"><span class="price"><?php echo get_field( "totalprice") ?></span> <?php _e('起/人', 'sage'); ?></div>
		<?php endif ?>
        <a class="btn btn-success" href="" title="<?php the_title(); ?>"><?php _e('开始预定', 'sage'); ?></a>
        <a class="btn btn-info" href="<?php echo get_permalink(17)?>" target="_blank" title="<?php _e('私人订制', 'sage'); ?>"><?php _e('私人订制', 'sage'); ?></a>
      </div>
      
      <div class="col-xs-12">
      	 <?php if (get_field( "thefocus")): ?>
	          <div><span><?php _e('行程亮点', 'sage'); ?></span></div>
	          <div><?php echo get_field( "thefocus") ?></div>
	        <?php endif ?>
      </div>
	</div>
</div>

<div class="row">
	<ul class="col-xs-12 top-menu">
		<?php if( have_rows('alltrips') ): ?>
			<li><a href="#thedetail"><?php _e('详细行程', 'sage'); ?></a></li>
		<?php endif; ?>

		<?php if (get_field( "theprice")): ?>
			<li><a href="#theprice"><?php _e('费用说明', 'sage'); ?></a></li>
		<?php endif; ?>

		<?php if (get_field( "specialprice")): ?>
			<li><a href="#specialprice"><?php _e('特别说明', 'sage'); ?></a></li>
		<?php endif; ?>
	</ul>
	<div class="col-xs-12">
		<div class="col-xs-12 col-sm-2 inside-title" id="thedetail"><span><?php _e('详细行程', 'sage'); ?></span></div>
		
		<div class="col-xs-12 col-sm-10 trip-detail">
		<?php if( have_rows('alltrips') ): ?>		
		  <?php $i=1;
		  while( have_rows('alltrips') ): the_row(); ?>
		    <?php  
		    $title = get_sub_field('title');
		    $tripinfo = get_sub_field('tripinfo');?>
			
			<div class="trip-waps">				
			    <div class="jour-day clearfix"> <span class="day-icon"></span> <span class="day-num"><?php echo $i ?></span>
	                <div class="day-inf"> <span class="day-day">DAY</span>
	                    <div class="day-dest-list"> <?php echo $title ?></div>
	                </div>
	            </div>
				<div class="trip-des"><?php echo $tripinfo ?></div>
			</div>

		  <?php $i++;endwhile; ?>	 

		<?php endif; ?>
		</div>
	</div>

 	<?php if (get_field( "theprice")): ?>
	<div class="col-xs-12 theprice">
		<div class="col-xs-12 col-sm-2 inside-title" id="theprice"><span><?php _e('费用说明', 'sage'); ?></span></div>
		
		<div class="col-xs-12 col-sm-10">
	          <div><?php echo get_field( "theprice") ?></div>
		</div>
	</div>
	 <?php endif ?>

	 <?php if (get_field( "specialprice")): ?>
	<div class="col-xs-12 theprice">
		<div class="col-xs-12 col-sm-2 inside-title" id="specialprice"><span><?php _e('特别说明', 'sage'); ?></span></div>
		
		<div class="col-xs-12 col-sm-10">
	          <div><?php echo get_field( "specialprice") ?></div>
		</div>
	</div>
	 <?php endif ?>
</div>

