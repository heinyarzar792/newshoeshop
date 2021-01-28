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
    <h2>User Login Form</h2>

    <?php
    if(isset($_REQUEST['status'])){
      $status=$_REQUEST['status'];
      if($status==1){
        echo "<alert class='alert alert-success'>You have successfully.Please Login!</div>";
      }
    }
    ?>

    <form action="user_login.php" method="POST" onsubmit="return check()">

    <div class="row">
      
      <div class="col-md-4">
        <label>User Email</label>
        <input type="text" maxlength="50" name="user_email" required="required" class="form-control">
      </div>
      
    </div>

    <div class="row">
      <div class="col-md-4">
        <label>Password</label>
        <input type="password" maxlength="6" id="user_password" name="user_password" required="required" class="form-control">
      </div>
      
    </div>
    <div class="col-md-4"><br>
        
        <input type="submit" class="btn btn-success" value="Login">
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
  function check () {
    var user_password=document.getElementById('user_password').value;
    var user_confirm_password=document.getElementById('user_confirm_password').value;
    // not equal use !==
    if(user_password!==user_confirm_password){
      alert('password and Confirm password doesnot match!');
      return false;
    }else{
      return true;
    }
  }
</script>

 </body>    

</html>
