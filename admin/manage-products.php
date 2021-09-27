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
               $msg="Product deleted !!";
		  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('include/links.php')?>
	<title>Admin| Manage Products</title>
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
								<h3>Manage Products</h3>
							</div>
							<div class="module-body table">
								<!-- <?php if(isset($_GET['del']))
									{?>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<?php echo $msg; ?>
								</div>
								<?php } ?> -->

								<br />


								<table cellpadding="0" cellspacing="0" border="0"
									class="datatable-1 table table-bordered table-striped display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Product ID</th>
											<th>Product Name</th>
											<th>Company Name</th>
											<th>Price</th>
											<th>No Of Stock</th>
											<th>Product Creation Date</th>
											<th>Action</th>
											
										</tr>
									</thead>
									<tbody>

										<?php 
										$query=mysqli_query($con,"select * from medicine");
										$cnt=1;
										while($row=mysqli_fetch_array($query))
										{
										?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['id']);?></td>
											<td><?php echo htmlentities($row['name']);?></td>
											<td><?php echo htmlentities($row['company']);?></td>
											<td><?php echo htmlentities($row['price']);?></td>
											<td><?php echo htmlentities($row['stock']);?></td>
											<td><?php echo htmlentities($row['posting_date']);?></td>
											<td>
												<a href="edit-products.php?id=<?php echo $row['id']?>"><i
														class="icon-edit"></i> Edit Product</a> 
														<br>
												<a href="delete_pro.php?id=<?php echo $row['id']?>&del=delete"  													onClick="return confirm('Are you sure you want to delete this product?')"><i
														class="icon-remove-sign"></i> Delete Product</a>
											</td>
											
										</tr>
										<?php $cnt=$cnt+1; } ?>

								</table>
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



	<?php include('include/scripts.php') ?>
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