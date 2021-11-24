<?php
require('top.inc.php');

if(isset($_POST['submit'])) {

    $categories=get_safe_value($conn,$_POST['categories']);
      mysqli_query($conn,"insert into categories(categories,status)values('$categories','1')");
      header('location:categories.php');
      die();
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
                               <input type="text" name="categories" placeholder="Enter your company name" class="form-control" required>
                            </div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                           <span  name="submit">Submit</span>
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