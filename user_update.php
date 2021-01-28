

<?php 

$id = $_POST['id'];
// echo $id;
$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_phone = $_POST['user_phone'];
$user_password = $_POST['user_password'];
$data = [
'user_name' => $user_name,
'user_email' => $user_email,
'user_phone' => $user_phone,
'user_password' => $user_password,
'id' => $id,

];
// var_dump($data);
require 'admin/connection.php';
$sql = "UPDATE users
set user_name=:user_name,
user_email=:user_email,
user_phone=:user_phone,
user_password=:user_password
where id=:id
";
$stmt = $pdo->prepare($sql);

$result= $stmt->execute($data);


if($result){
	header("location:logout.php?status=5");
}else{
	echo "Error";
}





?>












