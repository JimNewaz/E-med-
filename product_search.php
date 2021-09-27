<?php
session_start();
error_reporting(0);
include('includes/config.php');

$find="%{$_POST['medicine']}%";

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


<!DOCTYPE html>
<html lang="en">

<head>
	<title>E Med</title>
	<?php include('includes/links.php')?>
</head>

<body>
	<?php include('includes/header.php')?>

	
    <section class="shop">
		<div class="col-md-12 mt-100" style="text-align:center; padding:50px;">
			<h1>Search <span style="color:#E12454">Results</span></h1>
		</div>


		<div class="col-md-12">
			<div class="container">
				<div class="row">
					<?php
						$ret=mysqli_query($con,"select * from medicine where name like '$find'");
                        $num=mysqli_num_rows($ret);
                        if($num>0)
                        {
                        while ($row=mysqli_fetch_array($ret)) {
							
							$pro_id=$row['id'];
							$pro_title=$row['name'];
							$pro_price=$row['price'];
							$pro_company=$row['company'];
							$pro_img1=$row['image1'];
							$pro_avail=$row['product_availability'];
						?>

					<div class='col-md-4' style='margin-bottom:30px;'>
						<div class='card' style='width: 18rem; text-align:center;'>
							<?php echo "<img class='card-img-top' src='admin/images/medicines/$pro_img1'  alt='Card image cap' style='width:250px; height:220px'>"
									 ?>
							<div class='card-body'>
								<h5 class='card-title'><?php echo $pro_title?></h5>
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
						} }else {							
					?>
                    <div class="col-sm-6 col-md-4 wow fadeInUp"> <h3>No Product Found</h3>
                    </div>
                    
                    <?php } ?>	
				</div>
			</div>
		</div>
	
		<?php include('includes/footer.php')?>
	<!--Scripts -->
	<?php include('includes/scripts.php')?>
</body>

</html>