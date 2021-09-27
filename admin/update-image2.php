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

	
	$productimage2=$_FILES["image2"]["name"];
	$temp_name2=$_FILES["image2"]["tmp_name"];

		
	move_uploaded_file($temp_name1,"images/medicines/$productimage2");
	

	$sql=mysqli_query($con,"update medicine set image2='$productimage2' where id='$pid' ");
	$msg="Product Image Updated Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('include/links.php')?>
	<title>Admin| Update Product Image</title>	
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
								<h3>Update Product Image 1</h3>
							</div>
							<div class="module-body">						



								<br />

								<form class="form-horizontal row-fluid" name="insertproduct" method="post"
									enctype="multipart/form-data">

									<?php 

										$query=mysqli_query($con,"select name,image2 from medicine where id='$pid'");
										
										while($row=mysqli_fetch_array($query))
										{
										

										?>


									<div class="control-group">
										<label class="control-label" for="basicinput">Product Name</label>
										<div class="controls">
											<input type="text" name="productName" readonly
												value="<?php echo htmlentities($row['name']);?>"
												class="span8 tip" required>
										</div>
									</div>


									<div class="control-group">
										<label class="control-label" for="basicinput">Current Product Image 1</label>
										<div class="controls">
										<img src="images/medicines/<?php echo htmlentities($row['image2']);?>"
												width="200" height="100">
										</div>
									</div>



									<div class="control-group">
										<label class="control-label" for="basicinput">New Product Image2</label>
										<div class="controls">
											<input type="file" name="image2" id="image2" value="" 											class="span8 tip" >
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