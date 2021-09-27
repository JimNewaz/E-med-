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
				$sql=mysqli_query($con,"SELECT password FROM admin where password='".md5($_POST['password'])."' && username='".$_SESSION['alogin']."'");
				$num=mysqli_fetch_array($sql);
				if($num>0)
				{
					$con=mysqli_query($con,"update admin set password='".md5($_POST['newpassword'])."' where username='".$_SESSION['alogin']."'");
					$_SESSION['msg']="Password Changed Successfully !!";
				}
				else
				{
					$_SESSION['msg']="Something Went Wrong!!";
				}
			}
?>

<style>
    #de{
        min-height:80%;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('include/links.php')?>
	<title>Admin| Change Password</title>
	
	<script type="text/javascript">
		function valid()
		{
		if(document.chngpwd.password.value=="")
		{
			alert("Current Password Filed is Empty !!");
			document.chngpwd.password.focus();
			return false;
		}
		else if(document.chngpwd.newpassword.value=="")
		{
			alert("New Password Filed is Empty !!");
			document.chngpwd.newpassword.focus();
			return false;
		}
		else if(document.chngpwd.confirmpassword.value=="")
		{
			alert("Confirm Password Filed is Empty !!");
			document.chngpwd.confirmpassword.focus();
			return false;
		}
		else if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
		{
			alert("Password and Confirm Password Field do not match  !!");
			document.chngpwd.confirmpassword.focus();
			return false;
		}
		return true;
		}
	</script>
</head>
<body>
	<!-- Header -->
<?php include('include/header.php');?>


<div class="wrapper" id="de">
	<div class="container">
		<div class="row">
			<?php include('include/sidebar.php');?>				
			<div class="span9">
				<div class="content">
					<div class="module">
						<div class="module-head">
							<h3>Admin Change Password</h3>
						</div>
							
						<div class="module-body">
							<!-- <?php if(isset($_POST['submit']))
								{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo htmlentities($_SESSION['msg']);?>						
									</div>
								<?php } ?>
								 -->
								<br>

							<form class="form-horizontal row-fluid" name="chngpwd" method="post" onSubmit="return valid();">
													
								<div class="control-group">
									<label class="control-label" for="basicinput">Current Password</label>
									<div class="controls">
										<input type="password" placeholder="Enter your current Password"  name="password" class="span8 tip" required>
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="basicinput">New Password</label>
									<div class="controls">
										<input type="password" placeholder="Enter your new current Password"  name="newpassword" class="span8 tip" required>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="basicinput">Confirm Password</label>
									<div class="controls">
										<input type="password" placeholder="Enter your new Password again"  name="confirmpassword" class="span8 tip" required>
									</div>
								</div>
									
								<div class="control-group">
									<div class="controls">
										<button type="submit" name="submit" class="btn">Submit</button>
									</div>
								</div>
									
							</form>
						</div>
					</div>					
						
				</div><!--/.content-->
			</div><!--/.span9-->
		</div> <!--/.row-->
	</div><!--/.container-->
</div><!--/.wrapper-->



<?php include('include/scripts.php')?>

</body>
<?php } ?>