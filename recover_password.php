<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');

    // $test=$_GET['token'];
    // echo $test;

    if(isset($_POST['change']))
    {
        if(isset($_GET['token'])){
                // echo $token;
                $token=$_GET['token'];
                $password=md5($_POST['new_pass']);

                $extra="recover_password.php";
                $query="UPDATE user SET password='$password' WHERE token='$token'";
                $run_query=mysqli_query($con,$query);

               
                header("location:recover_password.php");
                $_SESSION['errmsg']="Password Changed Successfully";
                exit();
            }else{
                // echo $token;
                $extra="recover_password.php";
                
                header("location:recover_password.php");
                $_SESSION['errmsg']="An error has occurred, please try again";
                exit();
            }
        
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include('includes/links.php')?>
    <title>Recover Password</title>

    <script type="text/javascript">
		function valid()
		{
		if(document.register.new_pass.value!= document.register.con_pass.value)
		{
            alert("Password and Confirm Password Field do not match  !!");
            document.register.con_pass.focus();
            return false;
            }
		return true;
		}
	</script>

</head>
<body>
    <!-- Header Start-->
    <?php include('includes/header.php')?> 
    <!-- Header End -->


    <div class="global-container">
        <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-center">Enter Your New Password</h3>
            <div class="card-text">   
                <span style="color:Green; text-align:center;" >
                    <?php
                    echo htmlentities($_SESSION['errmsg']);
                    ?>
                    <?php
                    echo htmlentities($_SESSION['errmsg']="");
                    ?>
                </span>            
              
                <form action="" method="post" onSubmit="return valid();">                    
                    <!-- to error: add class "has-danger" -->
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" class="form-control form-control-sm" id="new_pass" name="new_pass" required>
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>                        
                        <input type="password" name="con_pass" class="form-control form-control-sm" id="con_pass" required>
                    </div>
                    <button type="submit" style="background-color: #223A66; color: aliceblue;" class="btn btn-block" name="change">Recover Password</button>
                    
                    <div class="sign-up">
                        Don't have an account? <a href="signup.php">Create One</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
    















    <!-- Footer  -->
    <?php include('includes/footer.php')?> 
    <!-- Footer End -->
    <?php include('includes/scripts.php')?>
</body>
</html>