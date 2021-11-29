<?php
require('top.inc.php');

// if(isset($_GET['type']) && $_GET['type']!=''){
// 	$type=get_safe_value($con,$_GET['type']);
// 	if($type=='delete'){
// 		$id=get_safe_value($con,$_GET['id']);
// 		$delete_sql="delete from users where id='$id'";
// 		mysqli_query($con,$delete_sql);
// 	}
// }
$order_id=get_safe_value($con,$_GET['id']);

?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order Detail </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
				   <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Product Name</th>
                                <th class="product-thumbnail">Product Image</th>
                                <th class="product-name">Qty</th>
                                <th class="product-price">Price</th>
                                <th class="product-price">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // display here current users order from order table and their price image and other things
                          
                            $res=mysqli_query($con,"select distinct(order_detail.id) ,order_detail.*,product.name,product.image,
                            `order`.address,`order`.city,`order`.pincode from order_detail,product,`order` 
                            where order_detail.order_id='$order_id' and order_detail.product_id=product.id");
                            $total_price=0;
                            while($row=mysqli_fetch_assoc($res)){
                                $address=$row['address'];
                                $city=$row['city'];
                                $pincode=$row['pincode'];

                            $total_price=$total_price+($row['qty']*$row['price']);
                            ?>
                            <tr>
                                <td class="product-name"><?php echo $row['name']?></td>
                                <td class="product-name"> <img src="../media/product/<?php echo $row['image']?>"></td>
                                <td class="product-name"><?php echo $row['qty']?></td>
                                <td class="product-name"><?php echo $row['price']?></td>
                                <td class="product-name"><?php echo $row['qty']*$row['price']?></td>
                                
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3"></td>
                                <td class="product-name">Total Price</td>
                                <td class="product-name"><?php echo $total_price?></td>
                                
                            </tr>
                        </tbody>
                        
                        
                    </table>
                    <div id="address_details">
                            <strong>Address</strong>
                            <?php echo $address?>&nbsp
                            <?php echo $city ?>&nbsp<?php echo $pincode?><br>
                            <strong>Order Status</strong>
                              <?php

                                $order_status_arr=mysqli_fetch_assoc(mysqli_query($con,
                                
                                "select order_status.name from order_status,`order` where `order`.id='$order_id'
                                and `order`.order_status=order_status.id"));
                                echo $order_status_arr['name']
                              ?>

                              <div>
                                  <form>
                                  <select class="form-control" name="update_order_status">
										<option>Select Status</option>
										<?php
										$res=mysqli_query($con,"select * from order_status");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$categories_id){
												echo "<option selected value=".$row['id'].">".$row['name']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['name']."</option>";
											}
											
										}
										?>
									</select>       
                                    <input type="submit" class="form_control">                         
                                  </form>
                              </div>
               

                        </div>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>