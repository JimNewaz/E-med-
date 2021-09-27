<?php
session_start();
include('include/config.php');

if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

$id=$_GET['id'];

$upd="UPDATE prescriptions SET status='1' WHERE id='$id'";
$con->query($upd);

$q=mysqli_query($con,"select user_id from prescriptions where id='$id'");
$r=mysqli_fetch_array($q);

$user_id= $r['user_id'];


if($con)
{
	$update=mysqli_query($con,"update user set point=point+100 where id='$user_id'");
}

header("location:manage-prescriptions.php");
}
?>