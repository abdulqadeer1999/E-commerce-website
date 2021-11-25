<?php
require('top.inc.php');
if(isset($_POST['submit'])) {

    $categories=get_safe_value($conn,$_POST['categories']);
      mysqli_query($conn,"insert into categories(categories,status) values('$categories','1')");
     header('location:categories.php');
      die();
}


// updating product 
if(isset($_GET['id']) && $_GET['id'] !='') {

   $id=get_safe_value($conn,$_GET['id']);
   $res= mysqli_query($conn,"select * from categories where id='$id'");
   $row=mysqli_fetch_assoc($res);
   $categories=$row['categories'];
}

?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="post">

                        <div class="card-body card-block">
                           <div class="form-group">
                               <label for="categories" class="form-control-label">Categories</label>
                               <input type="text" name="categories" placeholder="Enter  Category name" class="form-control" value=<?php echo $categories?> required>
                            </div>
                            <button id="payment-button-amount" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                           <span  id="payment-button-amount">Submit</span>
                           </button>
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