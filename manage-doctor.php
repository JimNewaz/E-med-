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
		mysqli_query($con,"delete from doctors where id = '".$_GET['id']."'");
        
	}

?>




<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin| Manage Users</title>
	<?php include('include/links.php')?>
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
								<h3>Manage Doctors</h3>
							</div>

							<div class="module-body table">

								<!-- Message -->
								<!-- <?php if(isset($_GET['del']))
								{?>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
								</div>
								<?php } ?> -->

								<br>

								<table cellpadding="0" cellspacing="0" border="0"
									class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Email </th>
											<th>Contact no</th>
											<th>Speciality</th>
											<th>Visit Fee</th>
											<th>Reg. Date</th>
											<th>Block/Unblock</th>
											<th>Remove Doctor Permanently</th>
										</tr>
									</thead>

									<tbody>
										<?php $query=mysqli_query($con,"select * from doctors");
											$cnt=1;
											while($row=mysqli_fetch_array($query))
											{
											?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['name']);?></td>
											<td><?php echo htmlentities($row['email']);?></td>
											<td><?php echo htmlentities($row['contact_no']);?></td>
											<td><?php echo htmlentities($row['speciality']);?></td>
											<td>
												<?php echo htmlentities($row['visit_fee']);?>
											</td>
											<td><?php echo htmlentities($row['reg_date']);?></td>
											<td>
												<?php if($row['status']=='0'){?>
												<a href="unblock_doctor.php?id=<?php echo $row['id'];?>"
													class="btn btn-primary">UnBlock</a>
												<?php  } else{ ?>
												<a href="block_doctor.php?id=<?php echo $row['id'];?>"
													class="btn btn-danger">Block</a>
												<?php } ?></td>

											<td>
												<a href="manage-users.php?id=<?php echo $row['id']?>&del=delete"
													onClick="return confirm('Are you sure you want to Detele?')"
													class="btn btn-warning">Delete</a>
											</td>



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



	<?php include('include/scripts.php');?>

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