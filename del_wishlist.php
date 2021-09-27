<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
	header('location:index.php');
	}
else{

    $pid=intval($_GET['id']);
    // echo $pid;
	if(isset($_GET['del']))
		  {
		    mysqli_query($con,"delete from wishlist where medicine_id = $pid");
               
		  }

          header('location:wishlist.php');

        }
?>