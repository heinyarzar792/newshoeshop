<?php
$id = $_POST['id'];
$data  = ['id' => $id];
require 'connection.php';
$sql = "DELETE from categories where id=:id";
$stmt = $pdo->prepare($sql);
$result = $stmt->execute($data);
if($result){
	header("location:categories.php?status=3");
}else{
	echo "Error";
}


?>