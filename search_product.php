<!doctype html>
<html lang="en">
<?php
require 'head.php';
?>
  
  <body>
    <?php
require 'nav.php';
?>
    

<main role="main">

  <?php 
  require 'admin/connection.php';
  $type = $_REQUEST['type'];
  if($type==1){
    $id = $_REQUEST['id'];
    $sql = 'SELECT * from products where product_category_id=:id';
    $data = ['id'=>$id];

  }else if($type==2){
    $id = $_REQUEST['id'];
    $sql = 'SELECT * from products where product_brand_id=:id';
    $data = ['id'=>$id];

  }else{
    $product_name =$_REQUEST['product_name'];
    $data =['product_name'=>$product_name];
    $sql = "SELECT * from products where product_name LIKE '%' :product_name '%' ";


  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute($data);
  $result=$stmt->fetchAll();

  ?>
  <div class="container"><br><br>
    <?php
    $i = 1;
    foreach ($result as $key => $product) {
      $product_name = $product['product_name'];
      $product_price = $product['product_price'];
      $product_code = $product['product_code'];
      $product_photo = $product['product_photo'];
      $id = $product['id'];
      if($i%3==1){
        echo "<div class='row'>";
      }
      echo "<div class='col-md-4'>";
      echo "<h2>$product_name</h2>";
      echo "<img class='img img-responsive' src='admin/$product_photo'>";
      echo "<p>$product_price MMK</p>";
      echo "<a href='product_detail.php?id=$id' class='btn btn-info'>Detail</a>";
      echo "</div>";
      if($i%3==0){
        echo "</div>";
      }
      $i++;

    }

    ?>
    <hr>

  </div> 

</main>

<footer class="container">
  <p>&copy; Company 2017-2020</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
      <script type="text/javascript" src="assets/dist/js/jquery-3.5.1.min.js"></script>
      <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

</html>
