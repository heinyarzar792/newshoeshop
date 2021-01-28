<?php 

$id = $_POST['id'];
$old_photo = $_POST['old_photo'];

$product_name = $_POST['product_name'];

$product_price = $_POST['product_price'];

$product_brand_id = $_POST['product_brand_id'];
$product_category_id = $_POST['product_category_id'];

$product_gender_id = $_POST['gender'];
$product_description = $_POST['product_description'];

$product_code = $_POST['product_code'];
$product_photo_name_new = $_FILES['product_photo']['name'];

// echo "$old_photo<br> $product_photo_name_new";
if($product_photo_name_new){
	$ext = pathinfo($product_photo_name_new,PATHINFO_EXTENSION);
echo $ext;

	$my_photo_name =date('dmyhis').uniqid().".".$ext;
	
	$file_path = "images/".$my_photo_name;
	if(move_uploaded_file($_FILES['product_photo']['tmp_name'], $file_path)){
		unlink($old_photo);
		$product_photo = $file_path;

	}

}else{
	$product_photo = $old_photo;
}

$data = [
'product_name' => $product_name,
'product_price' => $product_price,
'product_code' => $product_code,
'product_brand_id' => $product_brand_id,
'product_category_id' => $product_category_id,
'product_gender_id' => $product_gender_id,
'product_description' => $product_description,
'product_photo' => $product_photo,
'id' => $id,

];
var_dump($data);
require 'connection.php';
$sql = "UPDATE products 
set product_name=:product_name,
product_code=:product_code,
product_price=:product_price,
product_gender_id=:product_gender_id,
product_category_id=:product_category_id,
product_brand_id=:product_brand_id,
product_photo=:product_photo,
product_description=:product_description
where id=:id
";


$stmt = $pdo->prepare($sql);

$result= $stmt->execute($data);

if($result){
	header("location:product_list.php?status=2");
}else{
	echo "Error";
}


?>












