<?php
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];

$product_brand_id = $_POST['product_brand_id'];
$product_category_id = $_POST['product_category_id'];

$gender = $_POST['gender'];
$product_description = $_POST['product_description'];
$product_code = $_POST['product_code'];
$product_photo_name = $_FILES['product_photo']['name'];
	// echo "$product_name, $product_price, $product_brand_id, $product_category_id,$product_photo_name, $product_code,$gender, $product_description";


// get file extension
$ext = pathinfo($product_photo_name,PATHINFO_EXTENSION);
echo $product_photo_name;
echo "<br>";
echo $ext;

$my_photo_name =date('dmyhis').uniqid().".".$ext;
echo "<br>$my_photo_name";
$file_path = "images/".$my_photo_name;
echo "<br> $file_path";

if(move_uploaded_file($_FILES['product_photo']['tmp_name'], $file_path)){
	$sql = "INSERT into products(product_name,product_price,product_code,product_brand_id,product_category_id,product_gender_id,product_description,product_photo)values(:product_name,:product_price,:product_code,:product_brand_id,:product_category_id,:product_gender_id,:product_description,:product_photo)";

$data = [
'product_name' => $product_name,
'product_price' => $product_price,
'product_code' => $product_code,
'product_brand_id' => $product_brand_id,
'product_category_id' => $product_category_id,
'product_gender_id' => $gender,
'product_description' => $product_description,
'product_photo' => $file_path

];
require 'connection.php';
$stmt = $pdo->prepare($sql);
$result = $stmt->execute($data);
if($result){
	header("location:products.php?status=1");

}else{
	echo "Error in db insert!";
}

}else{
	echo "error";
}
// var_dump($data);



?>

