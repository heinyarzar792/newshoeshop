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
    <h2>Your Order History</h2><hr>
    <div class="row">
      <div class="col-md-10">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>Date</th>
              <th>Voucher ID</th>
              <th>Status</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
      <?php
      require 'admin/connection.php';
      $sql = "SELECT p.*,s.status_name from product_orders p INNER JOIN order_status s on s.id=p.order_status where p.user_id=:user_id";
      session_start();
      $user_id= $_SESSION['user_id'];
      $data = [
        'user_id'=>$user_id
      ];
      $stmt = $pdo->prepare($sql);
      $stmt ->execute($data);
      $result = $stmt->fetchAll();
      // var_dump($result);
      $i=1;
      foreach ($result as $key => $order) {
        $order_date = $order['order_date'];
        $status_name = $order['status_name'];
        $voucherid = $order['voucherid'];
      }
      echo "<tr>
      <td>$i</td>
      <td>$order_date</td>
      <td><a href='order_detail.php?voucherid=$voucherid'>$voucherid</td>
      <td>$status_name</td>
      <td>
      <a href='order_detail.php?voucherid=$voucherid' class='btn btn-info'>Detail</a>

      </td>
    
      </tr>";
      $i++;
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
