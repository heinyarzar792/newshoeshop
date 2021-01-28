


<select class="form-control "id="product_brand_id" name="product_brand_id">
           <?php 
           require 'connection.php';
           $sql = "SELECT * FROM brands";
           $stmt = $pdo->prepare($sql);
           $stmt->execute();
           $result= $stmt->fetchAll();
           // var_dump($result);
           // die();
           foreach($result as $key => $brand) {
             $id = $brand['id'];
             $brand_name = $brand['brand_name'];
             $brand_code = $brand['brand_code'];
             if(isset($product_brand_id)){
              if($id==$product_brand_id){
                echo "<option value=$id data-code=$brand_code selected='selected'> 
                $brand_name</option>";
              }

              } else{  
            echo "<option value=$id data-code=$brand_code> $brand_name</option>";

          }
        }
           ?>  
 </select>