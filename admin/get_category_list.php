



<select name="product_category_id" class="form-control" id="product_category_id" >
            <?php 
           require 'connection.php';
           $sql = "SELECT * FROM categories";
           $stmt = $pdo->prepare($sql);
           $stmt->execute();
           $result= $stmt->fetchAll();
           // var_dump($result);
           foreach ($result as $key => $category) {
             $id = $category['id'];
             $category_name = $category['category_name'];
             $category_code = $category['category_code'];

              // echo $product_category_id;

        
      


             if(isset($product_category_id)){
               if($id==$product_category_id){
                 echo "<option value=$id data-code=$category_code selected='selected'> $category_name</option>";
                
                 }else{
                echo "<option value=$id data-code=$category_code > $category_name</option>";
                 }
             }else{
                echo "<option value=$id data-code=$category_code > $category_name</option>";

             }  
           }

           ?>
          </select>
         