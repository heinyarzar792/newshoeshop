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
      $id = $_REQUEST['id'];
      // echo $id;
      // die();
      require 'connection.php';
      $data = ['id'=>$id];
      $sql ='SELECT * from products where id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt ->execute($data);
      $result=$stmt->fetchAll();
      // var_dump($result);

      $product_name = $result[0]['product_name'];
      $product_code = $result[0]['product_code'];
      $product_price = $result[0]['product_price'];
      $product_description = $result[0]['product_description'];
      $product_brand_id = $result[0]['product_brand_id'];
      $product_category_id = $result[0]['product_category_id'];
      $product_gender_id = $result[0]['product_gender_id'];
      $product_photo = $result[0]['product_photo'];

      // $product_brand_code = $result[0]['product_brand_code'];
      ?>
      <!-- link to  product_registration.php -->
      <form action="product_update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id ?>" >
        <input type="hidden" name="old_photo" value="<?php echo $product_photo?>">

      <div class="row">
        <div class="col-md-6">
          <label>Product Name</label>
          <input class="form-control" type="text" name="product_name" required="required" value="<?php echo $product_name ?>">
        </div>

        <div class="col-md-4">
          <label>Product Price</label>
          <input class="form-control" type="text" name="product_price" required="required" value="<?php echo $product_price ?>">
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
          <input class="form-control product_code" type="text" name="product_code" required="required" readonly="readonly" value="<?php echo $product_code ?>">
        </div>

        <div class="col-md-4">
          <label>Gender</label><br>
          <input class="radio-inline" type="radio" name="gender" required="required" value="1" <?php if($product_gender_id==1){echo "checked='checked' ";} ?>>Male
          <input class="radio-inline" type="radio" name="gender" required="required" value="2" <?php if($product_gender_id==2){echo "checked='checked' ";} ?>>Female
        </div>
      </div>

<div class="row">
        <div class="col-md-6">
          <label>Product Photo</label>
          <div id="show_photo">
            <img src="<?php echo $product_photo ?>" width=100 height=100>
            <a href="#" class="btn btn-danger btn_delete_photo">Delete</a>

          </div>
          <input class="form-control" type="file" name="product_photo"  enctype="muitipart/from-data" id="upload_photo">
        </div>
        <div class="col-md-4">
          <label>Product Description</label>
          <textarea class="form-control" name="product_description"><?php echo $product_description ?></textarea>
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
    $('#upload_photo').hide();
    $('#show_photo').show();
    $('.btn_delete_photo').click(function(){
      var ans=confirm('Are you sure?');
      if(ans){
        $('#upload_photo').show();
        
        $('#show_photo').hide();
      }

    })




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

