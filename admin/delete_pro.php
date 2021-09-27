<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
	header('location:index.php');
	}
else{

if(isset($_GET['del']))
		  {
		    mysqli_query($con,"delete from medicine where id = '".$_GET['id']."'");
               
		  }

          header('location:manage-products.php');

        }
?>