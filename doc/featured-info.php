<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');

    if(strlen($_SESSION['login'])==0)
    {
        header('location:login.php');
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>E Med | My accout</title>
 	<?php include('includes/links.php')?>

</head>

<body id="top">	
	<?php include('includes/header.php')?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol>
                    <li>For getting more reach</li>
                    <li>For getting more appointment</li>
                    <li>Earn more</li>
                </ol>
            </div>
        </div>
    </div>

    <br>
    <br>

<!-- Footer Start -->
<?php include('includes/footer.php')?>   
<!-- Footer End -->

 <!--     Essential Scripts    -->
 <?php include('includes/scripts.php')?> 
    

</body>
</html>