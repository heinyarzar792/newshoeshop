<!doctype html>
<html lang="en">
  

  <?php
   require 'head.php';
  ?>
  <body>
     <?php
   require 'nav.php';
    ?>
    
<div class="container-fluid">
  <div class="row">
    <?php
   require 'sidebar.php';
    ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Product Registration</h1>
        </div>
        <?php 

        // recall status from product_registration.php
        if(isset($_REQUEST['status'])){
          $status = $_REQUEST['status'];
          if($status==1){
            echo "<div class='alert alert-success col-lg-6'>
            Product Registration Successfully!</div>";
          }
          else if($status==2){
            echo "<div class='alert alert-success col-lg-6'>
            Update Product  Successfully!</div>";
          }
          else if($status==3){
            echo "<div class='alert alert-danger col-lg-6'>
            Delete Product  Successfully!</div>";
          }

        }

          ?>
        
      
      <!-- link to  product_registration.php -->
      <form action="product_registration.php " method="POST" enctype="multipart/form-data">

      <div class="row">
        <div class="col-md-6">
          <label>Product Name</label>
          <input class="form-control" type="text" name="product_name" required="required">
        </div>

        <div class="col-md-4">
          <label>Product Price</label>
          <input class="form-control" type="text" name="product_price" required="required">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label>Product Brand</label>
          <?php
          require 'get_brand_list.php';
          ?>
          
        </div>
        

        <div class="col-md-4">
          <label>Product Category</label>
          <?php
          require 'get_category_list.php';
          ?>
        </div>
      </div>
       

      <div class="row">
        <div class="col-md-6">
          <label>Product Code</label>
          <input class="form-control product_code" type="text" name="product_code" required="required" readonly="readonly">
        </div>

        <div class="col-md-4">
          <label>Gender</label><br>
          <input class="radio-inline" type="radio" name="gender" required="required" value="1" checked="checked">Male
          <input class="radio-inline" type="radio" name="gender" required="required" value="2">Female
        </div>
      </div>

<div class="row">
        <div class="col-md-6">
          <label>Product Photo</label>
          <input class="form-control" type="file" name="product_photo" required="required" enctype="muitipart/from-data">
        </div>
        <div class="col-md-4">
          <label>Product Description</label>
          <textarea class="form-control" name="product_description"></textarea>
        </div>
</div>
<div class="row">
        <div class="col-md-6">
          
          <input  type="submit" value="Register" class="btn btn-success">
        </div>
</div>



    </form>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script>

<script type="text/javascript" src="../assets/dist/js/jquery-3.5.1.min.js">
  
</script>
<script type="text/javascript">
  $(document).ready(function  () {
    // console.log("Hello");
    $(".product_code").click(function  () {
      var product_brand_id = $("#product_brand_id").val();
      var product_brand_code = $("#product_brand_id :selected").data('code');


      var product_category_id = $("#product_category_id").val();
      var product_category_code = $("#product_category_id :selected").data('code');

// console.log(product_category_id,product_category_code);
//       console.log(product_brand_id);
//       console.log(product_brand_code);


// call get _latest_product_code.php
$.post(
  "get_latest_product_code.php",
{
product_brand_id : product_brand_id,
product_brand_code : product_brand_code,
product_category_id : product_category_id,
product_category_code : product_category_code
}
  ).done(function  (data) {
    $(".product_code").val(data); 
  });

      
    })

    
  })
</script>
      </body>
</html>
