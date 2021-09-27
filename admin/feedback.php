<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{





?>


<?php 
	if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from ratting where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Product deleted !!";
		  }			 
?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php include('include/links.php')?>
	<title>Admin| Feedback</title>

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
								<h3>Product Reviews</h3>
							</div>
							<div class="module-body table">
							    
							    
							    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Product ID</th>											
											<th> Name</th>
											<th>Ratting </th>
											<th>Review</th>
											<th>Time</th>
											<th>Status</th>
											<th>Remove</th>
											<!-- <th>Action</th> -->
										</tr>
									</thead>
									<tbody>

									<?php
										$sel="SELECT * FROM ratting";
										$rs=$con->query($sel);
										$cnt=1;
										
										while($row=$rs->fetch_assoc()){
										    $pid=$row['pid'];
										    $queryy=mysqli_query($con,"select p.name from medicine p join medicine_orders o on p.id=o.product_id where p.id=$pid ORDER BY o.id DESC");
		                    	        $roww=mysqli_fetch_array($queryy);


										// if (!$queryy) {
										// 	printf("Error: %s\n", mysqli_error($con));
										// 	exit();
										// }

										?>	
										
										<tr>
										    <td><?php echo htmlentities($cnt);?></td>
											<td><?php echo $row['pid'];?></td>											
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['ratting']; ?></td>
											<td> <?php echo $row['review']; ?></td>
											<td><?php echo $row['time'];?></td>
											<td><?php if($row['isapproved']=='1'){?>
											<a href="notap.php?id=<?php  echo $row['id'];?>" class="btn btn-primary">Approved</a>
											<?php  } else{ ?>
											<a href="ap.php?id=<?php  echo $row['id'];?>" class="btn btn-danger">Not Approved</a>
											<?php } ?></td>
											<td>
											    <a href="feedback.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
											</td>
										</tr>
										<?php $cnt=$cnt+1;  ?>
										<?php } ?>
								</table>
							    
							   
						
						</div>
                    </div>
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->



	<?php include('include/scripts.php')?>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } ?>