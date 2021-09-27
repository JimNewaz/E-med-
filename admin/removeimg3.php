<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
    
	$pid=intval($_GET['id']);// product id
	
	

	$run=mysqli_query($con,"UPDATE medicine set image3 = null WHERE id='$pid'");
	
	while($row=mysqli_fetch_array($run))
    {
	   $img1=$row['image3'];

    }
    unlink($img1);
    

   
    header("location:edit-products.php?id=$pid");

}
?>