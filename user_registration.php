<?php
$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_phone = $_POST['user_phone'];
$user_password = $_POST['user_password'];
$user_confirm_password = $_POST['user_confirm_password'];


// echo "$user_name, $user_email , $user_phone, $user_password, $user_confirm_password";
if($user_password==$user_confirm_password){
	$data = [
		'user_name'=>$user_name,
		'user_email'=>$user_email,
		'user_password'=>$user_password,
		'user_phone'=>$user_phone
	];
	require 'admin/connection.php';
	$sql = "INSERT into users(user_name,user_email,user_phone,user_password,user_role)
	values(:user_name,:user_email,:user_phone,:user_password,1)";
	$stmt = $pdo->prepare($sql);
	$result=$stmt->execute($data);
	// var_dump($result);
	if($result){
		header('location:login.php?status=1');
	}else{
		echo "Error";
	}

}else{
	echo "Error in Password";
}

?>