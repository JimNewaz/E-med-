<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	$pid=intval($_GET['id']);// product id

if(isset($_POST['submit']))
{	
	$productname=$_POST['productName'];
	$productcompany=$_POST['productCompany'];
	$productprice=$_POST['productprice'];
	$productdescription=$_POST['productDescription'];
	$productscharge=$_POST['productShippingcharge'];
	$productavailability=$_POST['productAvailability'];
	$productstock=$_POST['stock'];
	$productfeatured=$_POST['productfeatured'];
	
	
	$sql=mysqli_query($con,"update medicine set name='$productname',company='$productcompany',price='$productprice',description='$productdescription',shipping_charge='$productscharge',product_availability='$productavailability',stock='$productstock',feature='$productfeatured' where id='$pid' ");

	$msg="Product Updated Successfully !!";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('include/links.php')?>
	<title>Admin| Edit Product</title>

	<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
	<script type="text/javascript">
		bkLib.onDomLoaded(nicEditors.allTextAreas);
	</script>	
</head>

<body>
	<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<?php include('include/sidebar.php');?>
				<div class="span9">
					<div class="content">
						<div class="module">
							<div class="module-head">
								<h3>Insert Product</h3>
							</div>
							<div class="module-body">

								<!-- <?php if(isset($_POST['submit']))
									{?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">×</button>		<?php echo $msg; ?>
								</div>
								<?php } ?> -->


								<!-- <?php if(isset($_GET['del']))
									{?>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>	
									<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
								</div>
								<?php } ?> -->

								<br />

								<form class="form-horizontal row-fluid" name="insertproduct" method="post"
									enctype="multipart/form-data">

									<?php 

									$query=mysqli_query($con,"select * from medicine where id='$pid'");
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{
  
									?>

					
									<div class="control-group">
										<label class="control-label" for="basicinput">Product Name</label>
										<div class="controls">
											<input type="text" name="productName" placeholder="Enter Product Name"
												value="<?php echo htmlentities($row['name']);?>"
												class="span8 tip">
										</div>
									</div>

										
									<div class="control-group">
										<label class="control-label" for="basicinput">Product Company</label>
										<div class="controls">
											<input type="text" name="productCompany"
												placeholder="Enter Product Comapny Name"
												value="<?php echo htmlentities($row['company']);?>"
												class="span8 tip" required>
										</div>
									</div>

									
									<div class="control-group">
										<label class="control-label" for="basicinput">Product Price</label>
										<div class="controls">
											<input type="text" name="productprice" placeholder="Enter Product Price"
												value="<?php echo htmlentities($row['price']);?>"
												class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Description</label>
										<div class="controls">
											<textarea name="productDescription" placeholder="Enter Product Description"
												rows="6" class="span8 tip">
											<?php echo htmlentities($row['description']);?>
											</textarea>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Shipping Charge</label>
										<div class="controls">
											<input type="text" name="productShippingcharge"
												placeholder="Enter Product Shipping Charge"
												value="<?php echo htmlentities($row['shipping_charge']);?>"
												class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Availability</label>
										<div class="controls">
											<select name="productAvailability" id="productAvailability"
												class="span8 tip" required>
												<option value="<?php echo htmlentities($row['productAvailability']);?>">
													<?php echo htmlentities($row['product_availability']);?></option>
												<option value="In Stock">In Stock</option>
												<option value="Out of Stock">Out of Stock</option>
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Stock</label>
										<div class="controls">
											<input type="text" name="stock" placeholder="Enter No Of Stock"
												value="<?php echo htmlentities($row['stock']);?>" class="span8 tip">
										</div>
									</div>


									<div class="control-group">
										<label class="control-label" for="basicinput">Featured Product</label>
										<div class="controls">

											<input type="radio" name="productfeatured" id="productfeatured"
												<?php if($row['feature']=="yes") echo "checked";?> value="yes">Yes <br>
											<input type="radio" name="productfeatured" id="productfeatured"
												<?php if($row['feature']=="no") echo "checked";?> value="no">No

										</div>
									</div>





									<div class="control-group">
										<label class="control-label" for="basicinput">Product Image1</label>
										<div class="controls">
											<img src="images/medicines/<?php echo htmlentities($row['image1']);?>"
												width="200" height="100"> <a
												href="update-image.php?id=<?php echo $row['id'];?>">Change Image</a>
											&nbsp; &nbsp;
											<a href="removeimg.php?id=<?php echo $row['id'];?>">Remove Image</a>
										</div>
									</div>


									<div class="control-group">
										<label class="control-label" for="basicinput">Product Image2</label>
										<div class="controls">
											<img src="images/medicines/<?php echo htmlentities($row['image2']);?>"
												width="200" height="100"> <a
												href="update-image2.php?id=<?php echo $row['id'];?>">Change
												Image</a>&nbsp; &nbsp;
											<a href="removeimg2.php?id=<?php echo $row['id'];?>">Remove Image</a>
										</div>
									</div>



									<div class="control-group">
										<label class="control-label" for="basicinput">Product Image3</label>
										<div class="controls">
											<img src="images/medicines/<?php echo htmlentities($row['image3']);?>"
												width="200" height="100"> <a
												href="update-image3.php?id=<?php echo $row['id'];?>">Change
												Image</a>&nbsp; &nbsp;
											<a href="removeimg3.php?id=<?php echo $row['id'];?>">Remove Image</a>
										</div>
									</div>
									<?php } ?>
									<div class="control-group">
										<div class="controls">
											<button type="submit" name="submit" class="btn">Update</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--/.content-->
				</div>
				<!--/.span9-->
			</div>
		</div>
		<!--/.container-->
	</div>
	<!--/.wrapper-->

	
	<?php include('include/scripts.php')?>
	<script>
		$(document).ready(function () {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
			
		});
	</script>
</body>
<?php } ?>