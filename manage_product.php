<?php
require('top.inc.php');

$categories_id="";
$name="";
$mrp="";
$price="";
$qty="";
$image="";
$short_desc="";
$description="";
$meta_title="";
$meta_description="";
$meta_keyword="";


// updating product 
if(isset($_GET['id']) && $_GET['id'] !='') {

   $id=get_safe_value($conn,$_GET['id']);
   $res= mysqli_query($conn,"select * from product where id='$id'");
   $check=mysqli_num_rows($res);
  
   if($check>0) {
      mysqli_query($conn,"update  product set categories_id='$categories_id',name='$name',mrp='$mrp',
      price ='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',
      meta_description='$meta_description',meta_keyword ='$meta_keyword', where id='$id'");
      $row=mysqli_fetch_assoc($res);
      $categories_id=$row['categories_id'];
      $name=$row['name'];
      $mrp=$row['mrp'];
      $price=$row['price'];
      $qty=$row['qty'];
      $short_desc=$row['short_desc'];
      $description=$row['description'];
      $meta_title=$row['meta_title'];
      $meta_description=$row['meta_description'];
      $meta_keyword =$row['meta_keyword '];
      

   }else {
      header('location:product.php');
      die();
   }
  
}

// adding data
if(isset($_POST['submit'])) {

    $categories_id=get_safe_value($conn,$_POST['categories_id']);
    $name=get_safe_value($conn,$_POST['name']);
    $mrp=get_safe_value($conn,$_POST['mrp']);
    $price=get_safe_value($conn,$_POST['price']);
    $qty=get_safe_value($conn,$_POST['qty']);
    $short_desc=get_safe_value($conn,$_POST['short_desc']);
    $description=get_safe_value($conn,$_POST['description']);
    $meta_title=get_safe_value($conn,$_POST['meta_title']);
    $meta_description=get_safe_value($conn,$_POST['meta_description']);
    $meta_keyword=get_safe_value($conn,$_POST['meta_keyword']);
   //  $categories=get_safe_value($conn,$_POST['categories']);s



    // if category is already exists
    $res= mysqli_query($conn,"select * from product where name='$name'");
    $check=mysqli_num_rows($res);

    if($check>0) {

      
      // while editing data also check 
       
      if(isset($_GET['id']) && $_GET['id'] !='') {
         $getData=mysqli_fetch_assoc($res);

         if($id==$getData['id']) {
           

         }else {
            $msg="Product already exist";
         }

      

      }else {
         $msg="Product already exist";
      }
    }
    

   if($msg=="") {
      if(isset($_GET['id']) && $_GET['id'] !='') {
         mysqli_query($conn,"update into product set categories_id='$categories_id',name='$name',mrp='$mrp',
      price ='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_description='meta_description',
      meta_keyword ='$meta_keyword', where id='$id'");
       }else {
        mysqli_query($conn,"insert into product(name,mrp,price,qty,short_desc,description,meta_title,meta_description,meta_keyword,status) 
         values('$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','meta_description','$meta_keyword',1)");

         
   
       }
        header('location:product.php');
      //   header('location:manage_product.php');

         die();
    
   }

 }


?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post">

                        <div class="card-body card-block">
                           <div class="form-group">
                               <label for="categories" class="form-control-label">Categories</label>
                               <select class="form-control" name="categories_id">
                                 <option>Select Category</option>
                                 <?php
                                  $res=mysqli_query($conn,"select id,categories from categories
                                  order by categories asc");

                                  while($row=mysqli_fetch_assoc($res)) {
                                     if($row['id']==$categories_id) {
                                       echo "<option selected value=".$row['id'].">".$row['categories']."<option>";

                                     }else {
                                       echo "<option selected value=".$row['id'].">".$row['categories']."<option>";

                                     }
                                  }
                                 ?>
                               </select>
                            </div>
                            <div class="form-group">
                               <label for="categories" class="form-control-label">Product Name</label>
                               <input type="text" name="name" placeholder="Enter  Product name" class="form-control"
                                value="<?php echo $name?>" required>
                            </div>
                            <div class="form-group">
                               <label for="categories" class="form-control-label">MRP</label>
                               <input type="text" name="mrp" placeholder="Enter  product mrp" class="form-control"
                                value="<?php echo $mrp?>" required>
                            </div>
                            <div class="form-group">
                               <label for="categories" class="form-control-label">Price</label>
                               <input type="number" name="price" placeholder="Enter  product price" class="form-control"
                                value="<?php echo $price?>" required>
                            </div>
                            <div class="form-group">
                               <label for="categories" class="form-control-label">Qty</label>
                               <input type="text" name="qty" placeholder="Enter  product qty" class="form-control"
                                value="<?php echo $qty?>" required>
                            </div>
                            <div class="form-group">
                               <label for="categories" class="form-control-label">Image</label>
                               <input type="file" name="image"  class="form-control" required>
                            </div>
                            <div class="form-group">
                               <label for="categories" class="form-control-label">Short Description</label>
                               <textarea  name="short_desc" placeholder="Enter  product short description" class="form-control" required>
                                <?php echo $short_desc?>
                              </textarea>
                            </div>
                            <div class="form-group">
                               <label for="categories" class="form-control-label"> Description</label>
                               <textarea  name="description" placeholder="Enter product  description" class="form-control" required>
                                <?php echo $description?>
                              </textarea>
                            </div>
                            <div class="form-group">
                               <label for="categories" class="form-control-label"> Meta Title</label>
                               <textarea  name="meta_title" placeholder="Enter  product  meta title" class="form-control">
                                <?php echo $meta_title?>
                              </textarea>
                            </div>
                            <div class="form-group">
                               <label for="categories" class="form-control-label">Meta Description</label>
                               <textarea name="meta_description"  placeholder="Enter  product meta description"  class="form-control">
                                <?php echo $meta_description?>
                              </textarea>
                            </div>
                            <div class="form-group">
                               <label for="categories" class="form-control-label">Meta Keyword</label>
                               <textarea name="meta_keyword" placeholder="Enter  product  meta keyword"  class="form-control" required>
                                <?php echo $meta_keyword?></textarea>
                            </div>
                            <button id="payment-button-amount" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                           <span  id="payment-button-amount">Submit</span>
                           </button>
                           <!-- <div class="field_error">
                              <?php echo $msg?>
                           </div> -->
                        </div>
                        </form>
                
                     </div>
                  </div>
               </div>
            </div>
         </div>
  <?php
require('footer.inc.php');
?>