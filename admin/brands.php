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
        <h1 class="h2">Brands Registration</h1>
        <?php 
        // recall status from brand_registration.php
        if(isset($_REQUEST['status'])){
          $status = $_REQUEST['status'];
          if($status==1){
            echo "<div class='alert alert-success'>
            Brand Registration Successfully!</div>";
          }else if($status==2){
            echo "<div class='alert alert-success'>
            Brand Updatet Successfully!</div>";
          }else if($status==3){
            echo "<div class='alert alert-success'>
            Brand Delete Successfully!</div>";
          }
        }
        ?>

        
      </div>
      <!-- link to brand_registration.php -->
      <form action="brand_registration.php" method="post">
        <div class="row">
          <div class="col-lg-4">
            <label>Brand Name</label>
            <input type="text" class="form-control" name="brand_name" required="required">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-">
            <label>Brand Code</label>
            <input type="text" class="form-control" name="brand_code" required="required">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <input type="submit" value="Register" class="btn btn-info">
          </div>
        </div>

        </form>


        <h1>Brand List</h1>
        <div class="row">
          <div class="col-lg-6">
            <table class="table  table_bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Brand Name</th>
                  <th>Brand Code</th>
                  <th>Edit</th>
                  <th>Delete</th>

                </tr>
              </thead>
              <tbody>
                <?php 
                require 'connection.php';
                $sql = "SELECT * from brands";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                // var_dump($result);
                if(sizeof($result)){
                  $i=1;
                  foreach ($result as $key => $brand) {
                    // var_dump($brand);
                    $id = $brand['id'];
                    $brand_name = $brand['brand_name'];
                    $brand_code = $brand['brand_code'];
                    // echo "$id => $brand_name => $brand_code<br>";
                    echo "<tr>
                            <td>$i</td>
                            <td>$brand_name</td>
                            <td>$brand_code</td>
                            <td><a href='edit_brand.php?id=$id' class='btn btn-warning'> Edit </a></td>

                            <td><form action='delete_brand.php' method='POST' onsubmit='return confirm(\"Are you sure?\")'>
                            <input type='hidden' name='id' value=$id>
                            <input type='submit' value='Delete' class='btn btn-danger'>
                            </form>
                            </td>



                            
                          </tr>";
                          $i++;


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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <script src="dashboard.js"></script></body>
  </html>
