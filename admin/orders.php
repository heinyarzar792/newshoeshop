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
        <h1 class="h2">Order List</h1>
        
      </div>
      <div class="row">
        <div class="col-lg-10">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>User Name</th>
                <th>User Phone</th>
                <th>Date</th>
                <th>VoucherId</th>
                
                
                <th>Status</th>
              </tr>

            </thead>
            <tbody>
              <?php
              require 'connection.php';
              $sql = "SELECT u.user_name,u.user_phone,po.order_date,po.voucherid,os.status_name from users u inner join product_orders po on po.user_id=u.id inner join order_status os on os.id=po.order_status";
              $stmt = $pdo->prepare($sql);
              $stmt -> execute();
              $result = $stmt->fetchAll();
              // var_dump($result);
              $i=1;
              foreach ($result as $key => $order) {
                $user_name = $order['user_name'];
                $user_phone=$order['user_phone'];
                $order_date = $order['order_date'];
                $voucherid = $order['voucherid'];
                $status_name = $order['status_name'];
                echo "<tr>
                <td>$i</td>
                <td>$user_name</td>
                <td>$user_phone</td>
                <td>$order_date</td>
                <td>
                <a href='orders_detail.php?voucherid=$voucherid'>
                $voucherid</a>
                </td>
                <td>$status_name</td>
              </tr>";
              $i++;



              }


              ?>
              
            </tbody>
            
          </table>
          
        </div>
      </div>

    
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script></body>
</html>
