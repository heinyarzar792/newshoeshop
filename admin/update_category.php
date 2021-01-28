<?php
$id= $_POST['id'];
$category_name = $_POST['category_name'];
$category_code = $_POST['category_code'];
$data = [
'id' => $id,
'category_name' => $category_name,
'category_code' => $category_code,

];
require 'connection.php';
$sql = "UPDATE categories set category_name=:category_name,
category_code=:category_code
where id=:id ";
$stmt = $pdo->prepare($sql);
$result = $stmt->execute($data);
// var_dump($result);
if($result){
	header("location:categories.php?status=2");

}else{
	echo "Error";
}
?>