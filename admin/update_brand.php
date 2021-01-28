<?php
$id= $_POST['id'];
$brand_name = $_POST['brand_name'];
$brand_code = $_POST['brand_code'];
$data = [
'id' => $id,
'brand_name' => $brand_name,
'brand_code' => $brand_code

];
require 'connection.php';
$sql = "UPDATE brands set brand_name=:brand_name,
brand_code=:brand_code
where id=:id ";
$stmt = $pdo->prepare($sql);
$result = $stmt->execute($data);
// var_dump($result);
if($result){
	header("location:brands.php?status=2");

}else{
	echo "Error";
}
?>