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
  $sql = "SELECT * from products order by id desc limit 9";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result=$stmt->fetchAll();
  // var_dump($result);

  ?>
<section class="featured spad">
  <div class="container">


            

        

    <?php
    $i = 1;
    foreach ($result as $key => $product) {
      $product_name = $product['product_name'];
      $product_price = $product['product_price'];
      $product_code = $product['product_code'];
      $product_photo = $product['product_photo'];
      $id = $product['id'];


      
      
      // echo "<h2>$product_name</h2>";
      // echo "<img class='img img-responsive' src='admin/$product_photo'>";
      // echo "<p>$product_price MMK</p>";
      // echo "<a href='product_detail.php?id=$id' class='btn btn-info'>Detail</a>";
      // echo "</div>";
      // if($i%3==0){
      //   echo "</div>";
      // }
      // $i++;

      if($i%4==1){
        echo "<div class='row featured__filter'>";
      }


      echo "<div class='col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat'>";
      echo"<div class='featured__item'>";
      echo "<div class='featured__item__pic set-bg'  data-setbg='admin/$product_photo'>";
      echo "<ul class='featured__item__pic__hover'>";
      echo "<li><a href='#''><i class='fa fa-heart'></i></a></li>";
      echo "<li><a href='product_detail.php?id=$id' class=' btn-info' title='Detail'><i class='fa fa-retweet'></i></a></li>";
      echo"<li><a class='btn-info btn_add_to_cart' 
      data-id=$id 
      data-product_name='$product_name'
      data-product_price='$product_price'
      data-product_photo ='$product_photo'
      title='Add To Cart'><i class='fa fa-shopping-cart'></i></a></li>";
      echo"</ul>";
      echo"</div>";
      echo"<div class='featured__item__text'>";
      echo "<h6><a>$product_name</a></h6>";
      echo "<h5>$product_price Ks</h5>";
      echo"</div>";
      echo "</div>";
      echo "</div>";

    
    if($i%4==0){
        echo "</div>";
      }
      $i++;

    }
    ?>
    

  </div> 
</section>
<hr style="background-color:red;">


</main>

<footer class="container">
  <p>&copy; Company 2017-2020</p>
</footer>


<!-- heinyarzar -->
<script type="text/javascript">
  function openNav(){

   document.getElementById("mySidenav").style.width='400px';
    }
    function closeNav(){
      document.getElementById("mySidenav").style.width='0';
    }
</script>
<!-- heinyarzar -->



<script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/jquery.slicknav.js"></script>
    <script src="assets/js/mixitup.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
      <script type="text/javascript" src="assets/dist/js/jquery-3.5.1.min.js"></script>
      <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
      
      </script>
      
      <script type="text/javascript">
// heinyarzar
        $(document).ready(function  () {

          $('#mySidenav').hide();
          // example
          $('#cart').click(function  () {
            $('#mySidenav').show();
            show_cart();
          })
          $('#cancel').click(function  () {
            $('#mySidenav').hide();
          })
// heinyarzar
          function show_cart () {
            var mycart = localStorage.getItem('mycart');
            if(mycart){
              var mycart_obj = JSON.parse(mycart);
              if(mycart_obj.product_list.length){
                var html='';
                var j=1;var total=0;
                $.each(mycart_obj.product_list,function  (i,v) {
                  var id=v.id;
                  var product_name=v.product_name;
                  var product_price=v.product_price;
                  var product_photo= v.product_photo;
                  var quantity=v.quantity;
                  var subtotal=quantity*product_price;
                  total+=subtotal;
// heinyarzar
                  html+=`
                  <em><div style='color:#4A148C;'>${product_name}</div></em>
                  <span><img src='admin/${product_photo}' width=100 height=100></span>
                  <span><i><b style='color:black;'>${product_price} Ks</b></i></span><br><br>
                  
                  
                  
                  `;
                  j++;


                })
                
                
                $('#mydiv').html(html);

              }else{
                $('#mydiv').html('');
              }
            }
            else{
              $('table').html('');
              $('.btn_order').hide();
            }
          }
// heinyarzar
          // end example
          
          update_cart_count();
          $('.btn_add_to_cart').click(function  () {
            // console.log("hello");
            var id=$(this).data('id');
            var product_name=$(this).data('product_name');
            var product_price=$(this).data('product_price');
            var product_photo=$(this).data('product_photo');
            // console.log(id,product_name,product_price,product_photo);
            var product = {
              id:id,
              product_name:product_name,
              product_price:product_price,
              product_photo:product_photo,
              quantity:1
            }
            // console.log(product);
            add_to_cart(product);
            update_cart_count();

          })
          function  add_to_cart(product) {
            
            var mycart = localStorage.getItem('mycart');
            if(!mycart){
              // call json string
              mycart='{"product_list":[]}';
            }
            var mycart_obj = JSON.parse(mycart);
            console.log(mycart_obj);
            // push product into mycart_obj
            var has_id=false;
            $.each(mycart_obj.product_list,function  (i,v) {
              if(v.id==product.id){
                has_id=true;
                v.quantity++;
              }

              
            })
            if(!has_id){
              mycart_obj.product_list.push(product);
            }

            // mycart_obj.product_list.push(product);
            // convert mycart to json string and store in localstorage
            localStorage.setItem('mycart',JSON.stringify(mycart_obj));
          }
          function update_cart_count(){
            var mycart=localStorage.getItem('mycart');
            if(mycart){
              var mycart_obj=JSON.parse(mycart);
              if(mycart_obj.product_list.length){
                var total= 0;
                $.each(mycart_obj.product_list,function  (i,v) {
                  // console.log(i,v);
                  total+=v.quantity;

                  
                })
                $('.cart_item_count').html(total);
              }
            }

          }
        })
        




      </script>
     

</html>
