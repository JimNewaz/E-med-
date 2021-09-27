<?php
    session_start();
    error_reporting(0);
    include("include/config.php");


    if(isset($_POST['submit']))
    {
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        $ret=mysqli_query($con,"SELECT * FROM admin WHERE username='$username' and password='$password'");
        $num=mysqli_fetch_array($ret);

        if($num>0)
        {
            $extra="change-password.php";
            $_SESSION['alogin']=$_POST['username'];
            $_SESSION['id']=$num['id'];

			header("location:change-password.php");
            exit();
        }
        else
        {
            $_SESSION['errmsg']="Invalid username or password";
            $extra="index.php";
			header("location:change-password.php");
            exit();
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
	<title>E MED | Admin login</title>
	
</head>
<body>

    <!-- /navbar -->
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
			  	<a class="brand" href="index.php">
			  		E MED | Admin
			  	</a>				
			</div>
		</div>
	</div>
    <!-- /navbar -->

	<div class="wrapper" id="de">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" method="post" action="">
						<div class="module-head">
							<h3>Sign In</h3>
						</div>
						<span style="color:red;" >
                            <?php echo htmlentities($_SESSION['errmsg']); ?>                           
                        </span>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="inputEmail" name="username" placeholder="Username">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
						            <input class="span12" type="password" id="inputPassword" name="password" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right" name="submit">Login</button>
									
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	
	<?php include('include/scripts.php')?>
</body>