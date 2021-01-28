<!doctype html>
<html lang="en">
<!-- getcomposer.org download compose.ee -->

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
    require 'connection.php';
    ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Report Form</h1>
      </div>


      <form action="reports.php" method="POST">
        <div class="row">
          <div class="col-md-4">
            <label>Start Date</label>
            <input type="date" maxlength="50" name="start_date" id="start_date" class="form-control" >
          </div>

          <div class="col-md-4">
            <label>End Date</label>
            <input type="date" maxlength="50" name="end_date" id="end_date" class="form-control" >
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-4">
            <input type="submit" name="report" value="report" class="btn btn-success my-2 form-control btn_report" class="btn_report">
          </div>
          
        </div>
        
      </form>
       <div class="row">
        <div class="col-md-10 ">
          <table class="table table-bordered table1">
            <thead>
              <th>User Name</th>
              <th>VoucherID</th>
              <th>order_date</th>

            </thead>
            <tbody>
             <?php
            if(isset($_POST['report'])){
                $start_date =$_POST['start_date'];
                $end_date = $_POST['end_date'];
                
                $data = ['start_date'=>$start_date,
                'end_date'=>$end_date
            ];
                
                $sql="SELECT po.voucherid,u.user_name,po.order_date from product_orders po INNER join users u on po.user_id=u.id where po.order_date between :start_date and :end_date";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($data);
                $result = $stmt->fetchAll();
             
                foreach ($result as $key => $report) {

                    $user_name=$report['user_name'];
                    $voucherid=$report['voucherid'];
                    $order_date=$report['order_date'];
                    echo "<tr>
                    <td>$user_name</td>

                    <td><a href='order_detail.php?voucherid=$voucherid'>$voucherid</td>
                    <td>$order_date</td>

                    </tr>";
                  
                }
            }

            ?>
          </tbody>
        </table>
        
        </div>
    </div> 
  </main>
</div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script> -->

<script type="text/javascript" src="../assets/dist/js/jquery-3.5.1.min.js">
</script>
<script type="text/javascript">
    $(document).ready(function() {
        
    // $('.table1').hide();
    
    $('#btn_report').click(function(){
      
        // $('.table1').show();      
  });

    });

</script>



</body>
</html>
