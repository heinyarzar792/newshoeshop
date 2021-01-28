<?php
$product_brand_id = $_POST['product_brand_id'];
$product_brand_code = $_POST['product_brand_code'];
$product_category_id = $_POST['product_category_id'];
$product_category_code = $_POST['product_category_code'];

$porduct_code_first_portion = trim($product_brand_code).'-'.trim($product_category_code).'-';

$default_product_code = $porduct_code_first_portion.'00001';

// echo $porduct_code_first_portion;
require 'connection.php';
$sql = "SELECT * from products where product_brand_id=
:product_brand_id and product_category_id=
:product_category_id order by id desc LIMIT 1";

$data = [
	'product_brand_id' => $product_brand_id,
	'product_category_id' => $product_category_id
];

$stmt = $pdo->prepare($sql);
$stmt->execute($data);

$result= $stmt->fetchAll();
// echo "aa<br>";
// var_dump($data);
// var_dump($result);
if(sizeof($result)){
	// echo "Have product";
// var_dump($result[0]['product_code']);
$latest_code = $result[0]['product_code'];
// var_dump($latest_code);
$code_array = explode('-',$latest_code);
// check 
// var_dump($code_array);
// output array(1) {  [0]=>  string(32) "array(1) {  [0]=>  string(0) ""}"}
$update_code_value = $code_array[2]+1;
// var_dump($update_code_value);
$update_code_value_withzero = sprintf('%05d',$update_code_value);
// var_dump($update_code_value_withzero);
$my_latest_product_code = $code_array[1].'-'.$code_array[1].'-'.$update_code_value_withzero;
echo $my_latest_product_code;




}else {
	echo $default_product_code;
}





































?>