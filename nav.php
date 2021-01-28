
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="index.php">ShoeShop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">

       
          <?php
          require 'admin/connection.php';
          $sql = "SELECT * from categories";
          $stmt =$pdo->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll();
          foreach($result as $key => $category){
            $category_name =$category['category_name'];
            $id = $category['id'];
            echo "<a class='dropdown-item' href='search_product.php?id=$id&type=1'>$category_name</a>";
          }

          ?>
         
        </div>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Brand</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <?php
          require 'admin/connection.php';
          $sql = "SELECT * from brands";
          $stmt =$pdo->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll();
          foreach($result as $key => $brand){
            $brand_name =$brand['brand_name'];
            $id = $brand['id'];
            echo "<a class='dropdown-item' href='search_product.php?id=$id&type=2'>$brand_name</a>";
          }

          ?>
         
        </div>
      </li>
      <?php
      error_reporting(E_ALL & ~E_NOTICE);
      // session_start();
      if(isset($_SESSION['user_loggedin'])){
        if($_SESSION['user_loggedin']){
          $user_name = $_SESSION['user_name'];
          $user_id = $_SESSION['user_id'];
        
        echo "<li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle'
         href='#' id='dropdown03'
          data-toggle='dropdown' 
          aria-haspopup='true'
          aria-expanded='false'>".$user_name."
          </a>
        <div class='dropdown-menu' aria-labelledby='dropdown03'>";

        echo"<a class='dropdown-item' href='logout.php'>Log Out</a>";

        echo"<a class='dropdown-item' href='order_history.php'>Order History</a>";
        echo"<a class='dropdown-item' 
        href='edit_profile.php?id=$user_id'>Edit Profile</a>";
        echo"</div></li>";

      }else{
        echo "<li class='nav-item'>
        <a class='nav-link' href='login.php'>Login</a>
      </li>";
    }

      }else{
        echo "<li class='nav-item'>
        <a class='nav-link' href='login.php'>Login</a>
      </li>";
      }
    
  ?>
        <li class='nav-item'>
          <a class='nav-link' href='register.php'>Register</a>
        </li>

<!-- heinyarzar -->
 <li class="nav-item">
        <a class="nav-link " id="cart" onclick="openNav()" >
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          <span class="badge cart_item_count">0</span>
        </a>
  <div id="mySidenav" class="sidenav">
    <div class="closebtn" onclick="closeNav()"><h1 style="color: red;" id="cancel" title="Close" ><b>&times;</b></h1></div>
    <div id="mydiv"></div><center><button style="color:#FAFAFA;background-color: #4A148C;border-radius: 30%;" ><a id="viewall" class="nav-link" href="show_cart.php">View All</button></a></center>
    <!-- style="color:#FAFAFA;background-color: #4A148C;" -->
  </div>
  </li>
  <!-- heinyarzar -->




  <!-- end ok -->
  


      
     
      
    </ul>


    
    <form action="search_product.php" class="form-inline my-2 my-lg-0">
      <input type="hidden" name="type" value="3">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="product_name" class="form-control mr-sm-2" type="text">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>


  
