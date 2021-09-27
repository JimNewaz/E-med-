<?php
session_start();
error_reporting(0);
include('includes/config.php');	

// $pid=intval($_GET['pid']);

$blank=array(array());
$b=0;


// Update Cart
if(isset($_POST['submit'])){
	if(!empty($_SESSION['cart'])){
	foreach($_POST['quantity'] as $key => $val){
		if($val==0){
			unset($_SESSION['cart'][$key]);
		}else{
			$_SESSION['cart'][$key]['quantity']=$val;
		}
	}
		echo "<script>alert('Your Cart has been Updated');</script>";
	}
}



// Remove Cart
if(isset($_POST['remove_code']))
	{
	if(!empty($_SESSION['cart'])){
			foreach($_POST['remove_code'] as $key){				
				unset($_SESSION['cart'][$key]);
			}
				echo "<script>alert('Your Cart has been Updated');</script>";
		}
}

// Checkout
if(isset($_POST['abcd'])) 
{	
	
	if(strlen($_SESSION['login'])==0)
		{   
	header('location:login.php');
	}
	else{
		// $quantity=$_POST['quantity'];
		// $pdd=$_SESSION['pid'];
		// echo $quantity;
		//$pname=$_SESSION['name'];
		// $value=array_combine($pdd,$quantity);
			$value= $_SESSION['blank'];
			// print_r($_SESSION['blank']);

			$q="select max(id) from medicine_orders";
				$r=mysqli_query($con,$q);
				$r=mysqli_fetch_array($r);
				$r=$r['max(id)'];

				// echo $r;
			for($i=0; $i<count($value); $i++)
			{
				$qty=$value[$i]['pid'];
				$val34=$value[$i]['quantity'];
				

				$_SESSION['order_id'][$i]=$r+1;

				$run="insert into medicine_orders(user_id,product_id,quantity) values('".$_SESSION['id']."','$qty','$val34')";

				mysqli_query($con,$run);
				// echo $run." \n";
			}
			 header('location:payment_method.php ');

			// foreach($value as $qty=> $val34){
			// 	mysqli_query($con,"insert into medicine_orders(user_id,product_id,quantity) values('".$_SESSION['id']."','$qty','$val34')");
			// 	header('location:payment_method.php');
			// }
		}
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


	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12 mt-100" style="text-align:center; padding:50px;">
					<h1>My <span style="color:#E12454">Cart</span></h1>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form action="" name="cart" method="post">
					<?php
					if(!empty($_SESSION['cart'])){
				?>
					<div class="table-responsive">
						<table class="table table-bordered" style="text-align:center;">
							<thead>
								<tr>
									<th colspan="1">Remove</th>
									<th colspan="1">Image</th>
									<th colspan="1">Medicine Name</th>
									<th colspan="1">Quantity</th>
									<th colspan="1">Medicine Price</th>
									<th colspan="1">Shipping Charge</th>
									<th colspan="1">Total</th>
								</tr>
							</thead>

							<tfoot>
								<tr>
									<td colspan="7">
										<div class="shopping-cart-btn" style="float:left;"> 
											<span class="">
												<a href="index.php"
													class="btn btn-upper btn-primary outer-left-xs">Continue
													Shopping
												</a>

												<input type="submit" name="submit" value="Update shopping cart"	class="btn btn-primary pull-right" >
											</span>
										</div>
										
											
										
									</td>
								</tr>
							</tfoot>


							<tbody>
								<?php
									$pdtid=array();
									$sql = "SELECT * FROM medicine WHERE id IN(";
											foreach($_SESSION['cart'] as $id => $value){
											$sql .=$id. ",";
											}
											$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
											$query = mysqli_query($con,$sql);
											$totalprice=0;
											$totalqunty=0;
											$totalshipping=0;
											if(!empty($query)){
												while($row = mysqli_fetch_array($query)){
													$quantity=$_SESSION['cart'][$row['id']]['quantity'];

													
													$_SESSION['blank'][$b]['pid']=$row['id'];
													$_SESSION['blank'][$b]['quantity']=$quantity;
													$b++;

													$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['price']+$row['shipping_charge'];
													
													$subshipping= $_SESSION['cart'][$row['id']]['quantity']*$row['shippingCharge'];
													
													$totalprice += $subtotal;
													$totalshipping += $subshipping;
													$_SESSION['qnty']=$totalqunty+=$quantity;
													
													array_push($pdtid,$row['id']);
													 

                            	?>
								<tr>
									<td class="col-md-1 romove-item">
										<input type="checkbox" name="remove_code[]" value="<?php echo ($row['id']);?>" />										
									</td>

									<td class="col-md-2">
										<img src="admin/images/medicines/<?php echo $row['image1'];?>" alt=""
											width="114" height="146">
									</td>

									<td class="col-md-3">
										<a href="product_details.php?pid=<?php echo ($pd=$row['id']);?>">
											<?php echo $row['name']; ?></a>
									</td>

									<td class="col-md-1">
										<div class="">
											<div class="arrows">
												<div class="arrow plus gradient">
													<span class="ir">
														<i class="icon fa fa-sort-asc"></i>
													</span>
												</div>
												<div class="arrow minus gradient">
													<span class="ir">
														<i class="icon fa fa-sort-desc"></i>
													</span>
												</div>
											</div>

											<input type="number" min="1" max="5" value="<?php echo $_SESSION['cart'][$row['id']]['quantity'];?>" name="quantity[<?php echo $row['id']; ?>]">												
										</div>
									</td>

									<td class="col-md-2">
										<span> <i class="icofont-taka"></i>
											<?php 											
												echo (($_SESSION['cart'][$row['id']]['quantity']* $row['price']));
											?>
										</span>
									</td>

									<td class="col-md-2">
										<i class="icofont-taka"></i>
										<?php echo $row['shipping_charge']; ?>
									</td>

									<td class="col-md-1">
										<span>
											<i class="icofont-taka"></i>
											<?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['price']+$row['shipping_charge']); ?>
										</span>
									</td>
								</tr>
								<?php }}?>
							</tbody>
						</table>
					</div>
															
				</form>

			</div>
		</div>
	</div>

	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-8"></div>
			<div class="col-md-4">
				<div class="table-responsive">
					<table class="table table-bordered" style="text-align:center;">
						<thead>
							<tr>
								<th colspan="1">
									<h3>Grand <span style="color:#E12454; ">Total</span></h3>
								</th>
							</tr>
						</thead>
						<tbody>
							<form action="" method="post">
								<td>
									<h1><i class="icofont-taka"></i>
									<?php echo $_SESSION['tp']="$totalprice"; ?>
									</h1>	
									
									<button type="submit" name="abcd" class="btn btn-primary">CHEKOUT</button>					
								</td>	
							
							</form>
														
							
						</tbody>
					</table>
				</div>
			</div>

			<?php  }else {
				echo "Your shopping cart is empty";
			}?>
		</div>
	</div>



	<?php include('includes/footer.php')?>

	<!--Scripts -->
	<?php include('includes/scripts.php')?>
</body>

</html>