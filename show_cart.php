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
   <h2>Your Cart</h2>

   <div id="div_message"></div>

    <div class="row">
      <div class="col-md-8">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Photo</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
              <th>Delete</th>

            </tr>
          </thead>
          <tbody class="product_table">
            
          </tbody>
          
        </table>
        
      </div>
      
    </div>

    <?php 
    // session_start();
    if(isset($_SESSION['user_loggedin'])){
      if($_SESSION['user_loggedin']==true){
        $user_name = $_SESSION['user_name'];
        $user_id =$_SESSION['user_id'];

        echo "<a href='#' class='btn btn-success btn_order' data-user_id=$user_id>Order</a>";

      }else{

      }
    }else{
      echo "<p>Please<a href='login.php'> Login</a> to order.If you are not a member, please <a href='register.php'>Register</a>!</p>";
    }
    ?>
    
    <hr>

  </div> 

</main>
</body>

<footer class="container">
  <p>&copy; Company 2017-2020</p>
</footer>

      
      <script type="text/javascript" src="assets/dist/js/jquery-3.5.1.min.js"></script>
      <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

      <script type="text/javascript">
        $(document).ready(function  () {
          update_cart_count();
          show_cart();
          $('.btn_order').click(function  () {
            var user_id = $(this).data('user_id');
            console.log(user_id);
            var mycart = localStorage.getItem('mycart');
            // var mycart_obj = JSON.parse(mycart);
            $.post(
              'order_products.php',
              {
                user_id:user_id,mycart:mycart
              }

              ).done(function  (data) {
                // console.log(data);
                var data=data;
                if(data!='Error' && data!='Error2'){
                  var mydata = JSON.parse(data);
                  var voucherid = mydata.voucherid;
                  var html=`<div class="alert alert-success"><h2>You have order successfully with Voucherid #${voucherid}</h2></div>`;
                  $("#div_message").html(html); 
                  localStorage.clear();
                  show_cart();
                  update_cart_count();

                }


              })


          })

          $('.product_table').on('click','.fa-plus-circle',function  () {
            var id=$(this).data('id');
             // alert(id);

            var mycart = localStorage.getItem('mycart');
            var mycart_obj= JSON.parse(mycart);
            $.each(mycart_obj.product_list,function  (i,v) {
              if(v.id==id){
                v.quantity++;
              }
            })
            
            localStorage.setItem('mycart',JSON.stringify(mycart_obj));
            show_cart();
            update_cart_count();
            
          })


          // start minus
          $('.product_table').on('click','.fa-minus-circle',function  () {
            var id=$(this).data('id');
            var mycart = localStorage.getItem('mycart');
            var mycart_obj= JSON.parse(mycart);

            $.each(mycart_obj.product_list,function  (i,v) {
              if(v){
              if(v.id==id){
                if(v.quantity==1){
                  var ans = confirm('Are you sure to delete?');
                  if(ans){
                    mycart_obj.product_list.splice(i,1);
                  }
                }else{
                  v.quantity--;
                }
              }
            }
            })

            localStorage.setItem('mycart',JSON.stringify(mycart_obj));
            show_cart();
            update_cart_count(); 
          })
          //end minus
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
                  html+=`<tr>
                  <td>${j}</td>
                  <td>${product_name}</td>
                  <td><img src='admin/${product_photo}' width=100 height=100></td>
                  <td>${product_price}</td>
                  <td>
                  <i class='btn fa fa-plus-circle fa-2x' style='color:blue' data-id=${v.id}>
                  </i>
                  <span class='badge badge-success' style='font-size:24px'> 
                   ${quantity}
                   </span>
                   <i class='btn fa fa-minus-circle fa-2x' style='color:red' data-id=${v.id}>
                   </i>
                   </td>
                  <td>${subtotal}</td>
                  <td>Delete</td>

                  </tr>`;
                  j++;


                })
                html +=`
                <tr>
                <td colspan=5>Total</td>
                <td colspan=2>${total}</td>
                </tr>
                `;
                $('.product_table').html(html);

              }else{
                $('.product_table').html('');
              }
            }
            else{
              $('table').html('');
              $('.btn_order').hide();
            }
          }
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
              }else{
                $('.cart_item_count').html(0);
            }

            }else{
              $('.cart_item_count').html(0);
            }

          }
        })
      </script>

</html>
