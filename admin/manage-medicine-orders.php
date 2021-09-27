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
		    mysqli_query($con,"delete from prescriptions where id = '".$_GET['id']."'");
                // $_SESSION['delmsg']="Prescription deleted !!";
		  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('include/links.php')?>
	<title>Admin| Manage Medicine Orders</title>
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
								<h3>Manage Medicine Orders</h3>
							</div>
							<div class="module-body table">
								<!-- <?php if(isset($_GET['del']))
									{?>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
								</div>
								<?php } ?> -->

								<br />


								<table cellpadding="0" cellspacing="0" border="0"
									class="datatable-1 table table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Order ID</th>
											<th>User ID</th>
                                            
											<th>Medicine ID</th>
                                            
											<th>Quantity</th>
											<th>Amount</th>
											<th>Payment</th>
											<th>Address</th>
											
                                            <th>Order Date</th>
                                            <th>Order Status</th>
											<th>Change Order Status</th>
										</tr>
									</thead>
									<tbody>

										<?php 
										$query=mysqli_query($con,"select * from medicine_orders order by id Desc");
                                        
										$cnt=1;
										while($row=mysqli_fetch_array($query))
										{
										?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['id']);?></td>
											<td><?php echo htmlentities($row['user_id']);?></td>
                                            
											<td><?php echo htmlentities($row['product_id']);?></td>
                                            
											<td><?php echo htmlentities($row['quantity']);?></td>
											<td><?php echo htmlentities($row['amount']);?></td>
                                            <td><?php echo htmlentities($row['payment']);?></td>
                                            <td><?php echo htmlentities($row['address']);?></td>
                                            <td><?php echo htmlentities($row['orderdate']);?></td>
                                            <td><?php echo htmlentities($row['order_status']);?></td>
											<td> <a href="update-order.php?oid=<?php echo htmlentities($row['id']);?>" title="Update order" target="_blank">Edit</a>
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
	
	</script>
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