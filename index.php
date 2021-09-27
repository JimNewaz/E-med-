<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');	
?>

<?php 

// MY CART
if(isset($_GET['action']) && $_GET['action']=='add')
	{
		$id=intval($_GET['pid']);
		if(isset($_SESSION['cart'][$id]))
		{
			$_SESSION['cart'][$id]['quantity']++;
		}else{
			$sql_p="SELECT * FROM medicine WHERE id={$id}";
			$query_p=mysqli_query($con,$sql_p);

			if(mysqli_num_rows($query_p)!=0)
			{
				$row=mysqli_fetch_array($query_p);
				$_SESSION['cart'][$row['id']]=array("quantity" => 1, "price" => $row_p['medicinePrice']);
			}else{
				$message="Product ID is invalid";
			}
		}
		echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='mycart.php'; </script>";
	}

?>

<style>
	
</style>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>E Med</title>
	<?php include('includes/links.php')?>
</head>

<body>
	<?php include('includes/header.php')?>

	<!-- Banner Start -->
	<section class="banner">
		<div class="container">
			<div class="row">
				<div class=" col-md-6 ">
					<div class="block">
						<h1 style="margin-top:50px; font-size:60px; color:#223A66">Upload Your Prescription And
							<span style="color:#E12454; text-weight:bold;">Earn Money</span></h1>

						<p style="color:black;">We are providing you this opportunity to earn some money from online, if
							you have any prescription please upload it to our site and earn money.</p>

						<div class="btn-container mt-5">
							<div class="row">
								<div class="col-md-6">
									<a href="prescription.php" class="btn btn-primary">Upload Prescription <i
										class="icofont-simple-right "></i>
									</a> 
								</div>
								<div class="col-md-6">
									<a href="upload-requirements.php" class="btn btn-primary" style="background-color:#223A66;">How To Upload Prescription? 
									</a> 
								</div>
							</div>
																
						</div>						
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- Banner End -->

	<section class="features">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="feature-block d-lg-flex">
						<div class="feature-item mb-5 mb-lg-0">
							<div class="feature-icon mb-4" style="text-align: center;">
								<i class="icofont-prescription"></i>
							</div>
							<h4 class="mb-3" style="text-align: center;">Upload Prescription & <span
									style="color: #E12454;">Earn Money </span> </h4>
							<p class="mb-4" style="text-align: center;">Upload your prescription with proper information
								and earn money in your wallet. </p>
							<p class="mb-4" style="text-align: center;">
								<a href="prescription.html" class="btn btn-main">Upload Prescription</a>
							</p>
						</div>

						<div class="feature-item mb-5 mb-lg-0">
							<div class="feature-icon mb-4" style="text-align: center;">
								<i class="icofont-first-aid-alt"></i>
							</div>
							<h4 class="mb-3" style="text-align: center;">Buy Prescription In A <span
									style="color: #E12454;">Cheaper Rate </span></h4>
							<p class="mb-4" style="text-align: center;">Register as a company and purchase a bunch of
								prescription from us </p>
							<p class="mb-4" style="text-align: center;">
								<a href="pharma/company_login.php" class="btn btn-main">Buy Prescriptions</a>
							</p>
						</div>

						<div class="feature-item mb-5 mb-lg-0">
							<div class="feature-icon mb-4" style="text-align: center;">
								<i class="icofont-shopping-cart"></i>
							</div>
							<h4 class="mb-3" style="text-align: center;">Shop Medicine <span
									style="color: #E12454;">Free </span></h4>
							<p style="text-align: center;">You can also purchase medicine from us with your wallet
								points and cash which is completly free.</p>
							<p class="mb-4" style="text-align: center;">
								<a href="#" class="btn btn-main">Shop Medicines Free</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Shop area -->

	<!-- Featured -->
	<section class="shop" style="height:2100px">
		<div class="col-md-12 mt-100" style="text-align:center; padding:50px;">
			<h1>Featured <span style="color:#E12454">Products</span></h1>
		</div>


		<div class="col-md-12">
			<div class="container">
				<div class="row">
					<?php
						$get_product="select * from medicine where feature='yes' order by 1 DESC LIMIT 0,6 ";
						$run_products=mysqli_query($con,$get_product);
						
						while($row_product=mysqli_fetch_array($run_products)){
							
							$pro_id=$row_product['id'];
							$pro_title=$row_product['name'];
							$pro_price=$row_product['price'];
							$pro_company=$row_product['company'];
							$pro_img1=$row_product['image1'];
							$pro_avail=$row_product['product_availability'];
						?>

					<div class='col-md-4' style='margin-bottom:30px;'>
						<div class='card' style='width: 18rem; text-align:center;'>
							<?php echo "<img class='card-img-top' src='admin/images/medicines/$pro_img1'  alt='Card image cap' style='width:250px; height:220px'>"
									 ?>
							<div class='card-body'>
								<h5 class='card-title'><?php echo $pro_title?></h5>

								<!-- Product Reviews -->
								
								<div class="">
									<?php 
										// $pid=$row['id'];
										$sel="select round(AVG(ratting),1) as rr from ratting 
											WHERE pid='$pro_id' AND isapproved='1'";
											
										$rs=mysqli_query($con,$sel);
										$rss=mysqli_fetch_array($rs);

										
										
									?>
															
									<?php 
										$i = 1;
											while ($i <= 5) {
															
											if ($i <= $rss['rr']) {
																
											echo '<span class="icofont-star checked"></span>';
											}else {
															
											echo '<span class="icofont-star"></span>';
												}
											$i++;
											}
														
									?>
								</div>

							 	<!-- Product Reviews End-->






								<p> BDT <?php echo $pro_price?> </p>
								<a href='product_details.php?pid=<?php echo $pro_id;?>' class='btn btn-primary'>More
									Details</a>

								<?php
											if($pro_avail == 'In Stock'){
												echo"<a href='index.php?page=product&action=add&pid= $pro_id' class='btn btn-primary' style='background-color:#222222'>Add To Cart</a>";
											}else{
												echo"<a href='#' class='btn btn-primary' style='background-color:white; color:red;'>Out of Stock</a>";
											}
										?>


							</div>
						</div>
					</div>

					<?php	
						}							
					?>

				</div>
			</div>
		</div>

		<!-- Featured End -->


		<!-- New Products -->
		<div class="col-md-12 mt-100" style="text-align:center; padding:50px;">
			<h1>New <span style="color:#E12454">Products</span> </h1>
		</div>

		<div class="col-md-12">
			<div class="container">
				<div class="row">
					<?php
						$get_product="select * from medicine order by 1 DESC LIMIT 0,3 ";
						$run_products=mysqli_query($con,$get_product);
						
						while($row_product=mysqli_fetch_array($run_products)){
							
							$pro_id=$row_product['id'];
							$pro_title=$row_product['name'];
							$pro_price=$row_product['price'];
							$pro_company=$row_product['company'];
							$pro_img1=$row_product['image1'];
							$pro_avail=$row_product['product_availability'];
						?>

					<div class='col-md-4' style='margin-bottom:30px;'>
						<div class='card' style='width: 18rem; text-align:center;'>
							<?php echo "<img class='card-img-top' src='admin/images/medicines/$pro_img1'  alt='Card image cap' style='width:250px; height:220px'>"
									 ?>
							<div class='card-body'>
								<h5 class='card-title'><?php echo $pro_title?></h5>

								<!-- Product Reviews -->
								
								<div class="">
									<?php 
										$pid=$row['id'];
										$sel="select round(AVG(ratting),1) as rr from ratting 
											WHERE pid='$pro_id' AND isapproved='1'";
											
										$rs=mysqli_query($con,$sel);
										$rss=mysqli_fetch_array($rs);
									?>
															
									<?php 
										$i = 1;
											while ($i <= 5) {
															
											if ($i <= $rss['rr']) {
																
											echo '<span class="icofont-star checked"></span>';
											}else {
															
											echo '<span class="icofont-star"></span>';
												}
											$i++;
											}
														
									?>
								</div>

							 	<!-- Product Reviews End-->


								<p> BDT <?php echo $pro_price?> </p>
								<a href='product_details.php?pid=<?php echo $pro_id;?>' class='btn btn-primary'>More
									Details</a>



								<?php
											if($pro_avail == 'In Stock'){
												echo"<a href='index.php?page=product&action=add&pid=$pro_id;' class='btn btn-primary' style='background-color:#222222'>Add To Cart</a>";
											}else{
												echo"<a href='#' class='btn btn-primary' style='background-color:white; color:red;'>Out of Stock</a>";
											}
										?>


							</div>
						</div>
					</div>

					<?php	
						}							
					?>

				</div>
			</div>
		</div>
		<!-- NEW End -->
	</section>

	<!-- Shop End -->

	<!--Scripts -->
	<?php include('includes/footer.php')?>

	<?php include('includes/scripts.php')?>
	

</body>

</html>