<?php
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
$data = [
	'user_email'=>$user_email,
	'user_password'=>$user_password

];
$sql = "SELECT * from users where user_email=:user_email and user_password=:user_password";
require 'admin/connection.php';
$stmt = $pdo->prepare($sql);
$stmt->execute($data);
$result = $stmt->fetchAll();
// var_dump($result);
if(sizeof($result)){
	session_start();
	$_SESSION['user_loggedin']=true;
	$_SESSION['user_id']=$result[0]['id'];
	$_SESSION['user_name']=$result[0]['user_name'];

	header("location:show_cart.php");


}else{
	header("location:login.php?status=2");
}



?>
