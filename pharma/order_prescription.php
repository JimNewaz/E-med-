<?php 
  if( !session_start() ){ session_start(); }
  //error_reporting(0);
	include('includes/config.php');
	
	# verify login
  if(!isset($_SESSION['login']) || !$_SESSION['login']){
		header('Location: company_login.php');
		exit;
	}
	
	// get order request and execute
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$_SESSION['postdata'] = $_POST;
		unset($_POST);
		header("Location: ".$_SERVER['REQUEST_URI']);
		exit;
	}
	
	if (@$_SESSION['postdata']){
		$_POST = $_SESSION['postdata'];
		unset($_SESSION['postdata']);
		

		$prescription_price = 50; // same entry at buy_prescription.php
		
		$company_id = $_SESSION['id'];
		$ids = explode(',', $_POST['prescription_id']);
		$paymethod = $_POST['paymethod'];
		foreach($ids as $k=>$v){
			$get_prescription = mysqli_query($con, "SELECT * FROM prescriptions where id=$v");
			//print_r($get_prescription);
			//exit;
			$row = mysqli_fetch_array($get_prescription);
			if(!$row || !$row['id']){
				exit('Access Denied!');
			}
			
			// insert order information (item wise)
			mysqli_query($con, "INSERT INTO prescription_order (
			company_id, prescription_id, quantity, amount, hospital, doctor, disease_type, payment_method, order_status
			) VALUES(".$company_id.",".$v.",1,".$prescription_price.",'".$row['hospital']."','".$row['doctor']."','".$row['disease_type']."','".$paymethod."','Pending')");
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>E Med - Buy Prescription</title>
	<?php include('includes/links.php')?>
	<style>

	</style>
</head>

<body>

	<header>
		<?php include('includes/header.php')?>
	</header>

	<section class="page-title">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8" style="border:1px solid grey; margin-top:100px; padding:20px">
					<div class="block text-center">
						<h1 style="color:red">ORDER COMPLETED!</h1> <br>

					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</section>

	<section class="order_prescription section">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 text-center" style="border:1px solid grey; padding:20px;margin-bottom:100px;">
					<br />
					<h5>Your order has been placed successfully! We will contact you soon and deliver your parcel
						accordingly.</h5>
					<br /><br />
					Thank You.
				</div>

			</div>
			<div class="col-md-2"></div>
		</div>
	</section>


	<!-- Footer Start -->

	<?php include('includes/footer.php')?>

	<!-- Footer End -->

	<!--     Essential Scripts    -->
	<?php include('includes/scripts.php'); ?>

	<script>
		$(document).ready(function () {

		});
	</script>
</body>

</html>