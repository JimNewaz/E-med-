<?php 
    session_start();
    error_reporting(0);
	include('includes/config.php');

    //Sign Up 
    if(isset($_POST['submit']))
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $password=md5($_POST['password']);
        $token=bin2hex(random_bytes(15));

        $query=mysqli_query($con,"insert into doctors(name,email,contact_no,pass,token) values('$name','$email','$contact','$password','$token')");
        
        if($query)
        {               
            echo "<script>alert('You are successfully registered, please login to continue');</script>";        
            // echo "<script>window.open(login.php)</script>";

            header("location:login.php");
        }
        else{
            $_SESSION['errmsg']="Invalid email id or password";
            header("location:signup.php");
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>E Med - Doctors Sign Up</title>
    <?php include('includes/links.php')?>

    <!-- Checking password and confirm password -->
    <script type="text/javascript">
        function valid() {
            if (document.register.password.value != document.register.con_password.value) {
                alert("Password and Confirm Password Field are not same !!");
                document.register.con_password.focus();
                return false;
            }
            return true;
        }
    </script>

    <!-- Checking User Availability -->
    <script>
        function userAvailability() {
            $("").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function (data) {
                    $("#user-availability-status1").html(data);
                    $("").hide();
                },
                error: function () {}
            });
        }
    </script>

</head>

<body>
    <!-- Header Start-->
    <?php include('includes/header.php')?>
    <!-- Header End -->

    <!-- Login Form -->

    <div class="global-container">
        <div class="card login-form" style="width:600px; padding:20px; margin-top:50px; margin-bottom:50px">
            <div class="card-body">
                <h3 class="card-title text-center">Sign Up To E Med </h3>
                <div class="card-text">
                    <form role="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post"
                        name="register" onSubmit="return valid();">
                        <?php if($_SESSION['errmsg']){?>
                        <div class="" role="alert" style="background-color: #F8D7DA; color:black; padding:5px 5px 5px 5px;">
                            <?php
                                echo htmlentities($_SESSION['errmsg']);
                            ?>
                            <?php
                                echo htmlentities($_SESSION['errmsg']="");
                            ?>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email"
                                onBlur="userAvailability()" required>
                            <span id="user-availability-status1" style="font-size:12px;"></span>
                        </div>

                        <div class="form-group">
                            <label for="contact">Contact No</label>
                            <input type="text" class="form-control form-control-sm" id="contact" name="contact"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="con_password">Confirm Password</label>
                            <input type="password" name="con_password" class="form-control form-control-sm"
                                id="con_password" required>
                        </div>
                        <button type="submit" name="submit" style="background-color: #223A66; color: aliceblue;"
                            class="btn btn-block">Sign up</button>

                        <div class="sign-up">
                            Already Have an account? <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <!-- Login Form End -->

    <!-- Footer Start -->
    <?php include('includes/footer.php')?>
    <!-- Footer End -->

    <!-- Scripts -->
    <?php include('includes/scripts.php')?>
</body>

</html>