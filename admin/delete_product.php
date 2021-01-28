<?php
$id = $_POST['id'];
$product_photo = $_POST['product_photo'];


$data  = ['id' => $id];
require 'connection.php';
$sql = "DELETE from products where id=:id";
$stmt = $pdo->prepare($sql);
$result = $stmt->execute($data);
if($result){
	unlink($product_photo);
	header("location:product_list.php?status=3");
}else{
	echo "Error";
}


?>