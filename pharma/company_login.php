<?php 
    session_start();
    error_reporting(0);
	include('includes/config.php');

    // Login Code
    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $query=mysqli_query($con,"SELECT * FROM company WHERE email='$email' and password='$password' and status='1'");
        $num=mysqli_fetch_array($query);

        if($num>0)
        {
            $_SESSION['login']=$_POST['email'];
            $_SESSION['id']=$num['id'];
            $_SESSION['name']=$num['name'];
            $_SESSION['user_type']='company';
            //$_SESSION['p']=$num['point'];
                      
            header("location:buy_prescription.php");
            exit();
            
        }else{
            $email=$_POST['email'];
            $_SESSION['errmsg']="Invalid email id or password";
            header("location:company_login.php");

            // Email Check
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                $emailErr = "Invalid email format";
                }
                                    
            header("location:company_login.php");
            exit();
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>    
    <title>E Med - Pharmaciutical Company Login</title>
    <?php include('includes/links.php')?>    
</head>
<body>
    <!-- Header Start-->
    <?php include('includes/header.php')?> 
    <!-- Header End -->



    <hr>
    <!-- Login Form -->
    <div class="global-container" >
        <div class="card login-form" style="width:600px; padding:20px; margin-top:100px; margin-bottom:100px">
        <div class="card-body">
            <h3 class="card-title text-center">Login To E Med & Buy Prescriptions</h3>
            <div class="card-text">                
              
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                    <div class="" role="alert" style="background-color: #F8D7DA; color:black; padding:5px 5px 5px 5px;">
                        <?php
                            echo htmlentities($_SESSION['errmsg']);
                        ?>
                        <?php
                            echo htmlentities($_SESSION['errmsg']="");
                        ?>
                    </div>
                    <!-- to error: add class "has-danger" -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <a href="recover_email_company.php" style="float:right;font-size:12px;">Forgot password?</a>
                        <input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1">
                    </div>
                    <button type="submit" style="background-color: #223A66; color: aliceblue;" class="btn btn-block" name="login">Sign in</button>
                    
                    <div class="sign-up">
                        Don't have an account? <a href="company_signup.php">Create One</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    

    <!-- Login Form End -->

    <!-- Footer  -->
    <?php include('includes/footer.php')?> 
    <!-- Footer End -->
    <?php include('includes/scripts.php')?>
</body>
</html>