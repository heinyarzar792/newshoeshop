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

  

  <div class="container"><br><br>
    <?php
    $voucherid=$_REQUEST['voucherid'];

    // echo "$voucherid";

    ?>
    <h2>Your Order History#<?php echo $voucherid ?></h2><hr>
    <div class="row">
      <div class="col-md-10">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Photo</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
              

            </tr>
          </thead>
          <tbody>
      <?php
      require 'admin/connection.php';
      $sql = "SELECT p.product_name,
      p.product_photo,
      pod.product_price,
      pod.product_quantity
      from products p INNER join product_orders_detail pod on p.id=pod.product_id and pod.voucherid=:voucherid";
      $data = ['voucherid'=>$voucherid];
      $stmt = $pdo->prepare($sql);
      $stmt->execute($data);
      $result= $stmt->fetchAll();
      // var_dump($result);
      $i=1;
      $total = 0;
      foreach ($result as $key => $product) {
        $product_name = $product['product_name'];
        $product_photo =$product['product_photo'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
        $Subtotal = $product_price*$product_quantity;
        $total +=$Subtotal;
        echo "<tr>
        <td>$i</td>
        <td>$product_name</td>
        <td><img src='admin/$product_photo' width=120 height=100></td>
        <td>$product_price</td>
        <td>$product_quantity</td>
        <td>$Subtotal</td>
        </tr>";
        $i++;
        
      }
      echo "<tr>
      <td colspan=5>Total</td>
      <td>$total</td>
      ";



      ?>
      

            
          </tbody>
          
        </table>
        
      </div>
      
    </div>

    





    
    <hr>

  </div> <!-- /container -->

</main>

<footer class="container">
  <p>&copy; Company 2017-2020</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
      <script type="text/javascript" src="assets/dist/js/jquery-3.5.1.min.js"></script>
      <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
     

</html>
