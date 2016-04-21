<?php
/*
Plugin Name: Trip Order
Description: Manager order list, This plugin is created by Jason.lv all rights reserver. 
Author: Fei
Version: 1.0

*/

if( !class_exists('TripOrder') ):
	class TripOrder{

		function TripOrder() { //constructor
        add_action( 'admin_menu', array($this, 'mainPage') );
		}    
		
		function mainPage(){
			add_menu_page( __("行程预订单",'TO'), __("行程预订单",'TO'), 'manage_options', 'TripOrder',array($this, 'View'));			
		}

    function View(){
      global $wpdb;

      if($_GET['page'] == 'TripOrder' && isset($_GET['orderId']) && isset($_GET['action'])){
          if($_GET['action'] == "del")
            $this->deleteOrder($_GET['orderId']);
     
          if($_GET['action'] == "edit")
            $this->viewOrder($_GET['orderId']);
      }                
      
      if( $_GET['page'] == 'TripOrder' && isset($_GET['eventId']) ){                
          $this->listUser($_GET['eventId']);
      }elseif( $_GET['page'] == 'TripOrder' && isset($_GET['userId'])){                    
          $this->viewUser($_GET['userId']); 
      }

      $tb = $wpdb->prefix.'order';
      $result = $wpdb->get_results("SELECT * FROM $tb ORDER BY addDate DESC");?>

      <div class="wrap">
    	<h2><?php _e('订单列表', 'TO')?></h2>
        <table cellspacing="0" class="wp-list-table widefat fixed users">
            <thead>
            <tr>
                  <th style="" class="manage-column column-username" scope="col">
                     <span>订单ID </span>
                  </th>
                   <th style="" class="manage-column column-username" scope="col">
                     <span>路线名称 </span>
                  </th>
                   <th style="" class="manage-column column-username" scope="col">
                     <span>联系人姓名 </span>
                  </th>
                  <th style="" class="manage-column column-username" scope="col">
                     <span>旅行人数 </span>
                  </th>
                  <th style="" class="manage-column column-username" scope="col">
                     <span>联系号码 </span>
                  </th>
                  <th style="" class="manage-column column-username" scope="col">
                     <span>状态 </span>
                  </th>
                  <th style="" class="manage-column column-username" scope="col">
                     <span>日期 </span>
                  </th>
                  <th style="" class="manage-column column-username" scope="col">
                     <span>操作 </span>
                  </th>
            </tr>
            </thead>

            <tbody class="list:user" id="the-list">
                <?php foreach($result as $row):?>
            <tr class="alternate" id="user-1">
              <td class="username column-username"><?php echo $row->order_id;?></td>
                <td class="username column-username"><?php echo get_the_title($row->trip_id);?></td>
                <td class="username column-username"><?php echo $row->name;?></td>
                <td class="username column-username"><?php echo $row->quality;?></td>
                <td class="username column-username"><?php echo $row->phone;?></td>
                <td class="username column-username"><?php echo ($row->status)?'<font style="color:#0a0"">已处理</font>':'<font style="color:red"">未处理</font>';?></td>                       
                <td class="username column-username"><?php echo date("d/m/Y", strtotime($row->addDate));?></td>
                <td> <a href="<?php echo trailingslashit(get_option('siteurl')).'wp-admin/admin.php?page=TripOrder&action=edit&orderId='.$row->order_id;?>">编辑</a> | 
                     <a href="javascript:if(confirm('确定删除?')) {window.location='<?php echo trailingslashit(get_option('siteurl')).'wp-admin/admin.php?page=TripOrder&action=del&orderId='.$row->order_id;?>'}else{}">删除</a> </td>
            </tr>   
             <?php endforeach;?>
        </table>
       </div> 
                
	<?php }

  function viewOrder($orderId = false)
  {
      global $wpdb;
     
      if($orderId){
          $tb = $wpdb->prefix.'order';
          $sq = "SELECT * FROM $tb WHERE order_id = ".(int)$orderId;
          $order = $wpdb->get_results($sq);

          if(count($order)>0) :?> 
            <?php foreach ($order as $row):?>
              <div class="wrap">
              <h2><?php _e('修改订单', 'TO')?></h2>
               <table cellspacing="0" class="wp-list-table widefat fixed users">
              <form action="<?php echo trailingslashit(get_option('siteurl')).'wp-admin/admin.php?page=TripOrder';?>" method="POST">
              <input type="hidden" name="orderId" value="<?php echo $orderId?>">
                 <thead>
                 <col width="15%" />
                 <col width="85%" />
                 </thead>
                <tbody class="list:user">

                <tr>
                    <td colspan="2"><label class="control-label"><?php echo get_the_title($row->trip_id);?></label></td>
                </tr>

                  <tr>
                    <td><label for="username" class="control-label"><?php _e('联系人姓名', 'sage'); ?><strong>*</strong></label></td>
                     <td>
                        <input type="text" class="form-control" id="username" name="username" placeholder="<?php _e('姓名', 'sage'); ?>" value="<?php echo $row->name;?>">
                      </td>
                  </tr>

                  <tr>
                    <td><label for="quality" class="col-sm-3 control-label"><?php _e('旅行人数', 'sage'); ?></label></td>
                    <td>
                      <select class="form-control" name="quality">
                      <?php for ($i=1; $i <= 20; $i++) :?>
                         <option value="<?php echo $i ?>" <?php if($i == $row->quality) echo "selected='selected'"?>><?php echo $i ?></option>
                      <?php endfor; ?>         
                    </select>
                    </td>
                  </tr>

                  <tr>
                    <td><label for="phone" class="col-sm-3 control-label"><?php _e('手机号', 'sage'); ?><strong>*</strong></label></td>
                    <td>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="<?php _e('手机号', 'sage'); ?>" value="<?php echo $row->phone;?>">
                   </td>
                  </tr>

                  <tr>
                    <td><label class="col-sm-3 control-label"><?php _e('状态', 'sage'); ?></label></td>
                    <td>
                      <label class="control-label"><?php _e('已处理', 'sage'); ?><input type="radio" class="form-control" name="status" value="1" <?php if($row->status) echo "checked='checked'"?>/></label>
                      <label class="control-label"><?php _e('未处理', 'sage'); ?><input type="radio" class="form-control" name="status" value="0" <?php if(!$row->status) echo "checked='checked'"?>/></label>
                    </td>
                  </tr>

                  <tr><td colspan="2"><input type="submit" name="submit" class="btn btn-success" value="<?php _e('确定', 'sage'); ?>" /></td></tr>
               
                </tbody>
              </form>
              </table>
              </div>
            <?php endforeach;?>        
          <?php endif;
      }
  }
        
  function deleteOrder($orderId = false)
  {
    global $wpdb;
    if($orderId){
        $table_name = $wpdb->prefix . "order";
        $del = "DELETE FROM $table_name WHERE order_id = ".(int)$orderId." LIMIT 1"; 
        $wpdb->query($del);
    }      
  }		

}//END Class TripOrder
endif;

if( class_exists('TripOrder') )
    $TripOrder = new TripOrder();

