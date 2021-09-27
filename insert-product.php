<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	
if(isset($_POST['submit']))
{
	$productname=$_POST['productName'];
	$productcompany=$_POST['productCompany'];
	$productprice=$_POST['productprice'];
	$productdescription=$_POST['productDescription'];
	$productscharge=$_POST['productShippingcharge'];
	$productavailability=$_POST['productAvailability'];
	$productfeatured=$_POST['productfeatured'];
	$productstock=$_POST['stock'];
	$productimage1=$_FILES["productimage1"]["name"];
	$productimage2=$_FILES["productimage2"]["name"];
	$productimage3=$_FILES["productimage3"]["name"];

	$temp_name1=$_FILES["productimage1"]["tmp_name"];
	$temp_name2=$_FILES["productimage2"]["tmp_name"];
	$temp_name3=$_FILES["productimage3"]["tmp_name"];

	move_uploaded_file($temp_name1,"images/medicines/$productimage1");
	move_uploaded_file($temp_name1,"images/medicines/$productimage2");
	move_uploaded_file($temp_name1,"images/medicines/$productimage3");

			
	$sql=mysqli_query($con,"insert into medicine(name,company,price,description,shipping_charge,product_availability,feature,stock,image1,image2,image3) values('$productname','$productcompany','$productprice','$productdescription','$productscharge','$productavailability','$productfeatured', '$productstock','$productimage1','$productimage2','$productimage3')");

	// $_SESSION['msg']="Product Inserted Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('include/links.php')?>
	<title>Admin | Insert Product</title>
	

	<!-- Text Editor -->
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
									<button type="button" class="close" data-dismiss="alert">×</button>
									<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								<?php } ?> -->


								<?php if(isset($_GET['del']))
								{?>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
								</div>
								<?php } ?>

								<br />

								<form class="form-horizontal row-fluid" name="insertproduct" method="post"
									enctype="multipart/form-data">
																		
									<div class="control-group">
										<label class="control-label" for="basicinput">Product Name</label>
										<div class="controls">
											<input type="text" name="productName" placeholder="Enter Product Name" class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Company</label>
										<div class="controls">
											<input type="text" name="productCompany"
												placeholder="Enter Product Comapny Name" class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Price </label>
										<div class="controls">
											<input type="text" name="productprice" placeholder="Enter Product Price"
												class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Description</label>
										<div class="controls">
											<textarea name="productDescription" placeholder="Enter Product Description" rows="6" class="span8 tip">
											</textarea>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Shipping Charge</label>
										<div class="controls">
											<input type="text" name="productShippingcharge"
												placeholder="Enter Product Shipping Charge" class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Availability</label>
										<div class="controls">
											<select name="productAvailability" id="productAvailability"
												class="span8 tip" required>
												<option value="">Select</option>
												<option value="In Stock">In Stock</option>
												<option value="Out of Stock">Out of Stock</option>
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Number Of Stock</label>
										<div class="controls">
											<input type="text" name="stock" placeholder="Enter no of stock"
												class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Featured product?</label>
										<div class="controls">
											<input type="radio" name="productfeatured" id="productfeatured" value="yes"
												class="radio" /> Yes <br>
											<input type="radio" name="productfeatured" id="productfeatured" value="no"
												class="radio" /> No
										</div>
									</div>



									<div class="control-group">
										<label class="control-label" for="basicinput">Product Image1</label>
										<div class="controls">
											<input type="file" name="productimage1" id="productimage1" value=""
												class="span8 tip" required>
										</div>
									</div>


									<div class="control-group">
										<label class="control-label" for="basicinput">Product Image2</label>
										<div class="controls">
											<input type="file" name="productimage2" class="span8 tip">
										</div>
									</div>



									<div class="control-group">
										<label class="control-label" for="basicinput">Product Image3</label>
										<div class="controls">
											<input type="file" name="productimage3" class="span8 tip">
										</div>
									</div>

									<div class="control-group">
										<div class="controls">
											<button type="submit" name="submit" class="btn">Insert</button>
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