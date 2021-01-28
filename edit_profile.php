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
    <h2>User Registration Form</h2>
    </div>

      <?php
      $id = $_REQUEST["id"];
      
      require 'admin/connection.php';
      $data = ['id'=>$id];
      $sql ='SELECT * from users where id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt ->execute($data);
      $result=$stmt->fetchAll();
      // var_dump($result);

      $user_name = $result[0]['user_name'];
      $user_email = $result[0]['user_email'];
      $user_phone = $result[0]['user_phone'];
      $user_password = $result[0]['user_password'];

      if(isset($_REQUEST['status'])){
          $status = $_REQUEST['status'];
          if($status==5){
            echo "<div class='alert alert-success col-lg-6'>
            Edit User Successfully!</div>";
          }
          

        }

      ?>

    <form action="user_update.php" method="POST" >
      <input type="hidden" name="id" value="<?php echo $id?>"> 
      
    <div class="row">
      <div class="col-md-6">
        <label>User Name</label>
        <input type="text" maxlength="50" id="user_name" name="user_name"  class="form-control" value="<?php echo $user_name ?>">
      </div>

      <div class="col-md-6">
        <label>User Email</label>
        <input type="text" maxlength="50" id="user_email" name="user_email"  class="form-control" value="<?php echo $user_email ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <label>User Phone Numver</label>
        <input type="text" maxlength="50" id="user_phone" name="user_phone"  class="form-control" value="<?php echo $user_phone ?>">
      </div>
      
    
      <div class="col-md-6">
        <label>Password</label>
        <input type="password" minlength="6" maxlength="8" id="user_password" id="user_password" name="user_password"  class="form-control" value="<?php echo $user_password ?>">
      </div>
    </div><br>

      <div class="row ml-5">
      <div class="col-md-4">
        
        <input type="submit" id="btn_edit_user" class="btn btn-success" value="Edit User">
      </div>
    </div>
      

    </div>
  </form>
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
<script type="text/javascript">

 
</script>

 </body>    

</html>
