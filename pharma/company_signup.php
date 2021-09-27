<?php 
    session_start();
    error_reporting(0);
	include('includes/config.php');
    //Sign Up 
    if(isset($_POST['submit']))
    {
        $username=$_POST['name'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $password=md5($_POST['password']);
        $address=$_POST['address'];

        $query=mysqli_query($con,"insert into company(name,email,contact_no,password,address) values('$username','$email','$contact','$password','$address')");
        
        if($query)
        {               
            echo "<script>alert('You are successfully registered, please login to continue');</script>";        
            echo '<script>window.location.href = "company_login.php";</script>';
            

            //header("location:company_login.php");
        }
        else{
            echo "<script>alert('Something went worng, try again');</script>";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>E Med - Sign Up</title>
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

</head>

<body>
    <!-- Header Start-->
    <?php include('includes/header.php')?>
    <!-- Header End -->

    <!-- Login Form -->
    <hr>
    <div class="global-container">
        <div class="card login-form" style="width:600px; margin-top:100px; padding:20px; margin-bottom:100px"> 
            <div class="card-body">
                <h3 class="card-title text-center">Sign Up To E Med & Buy Prescriptions</h3>
                <div class="card-text">
                    <form role="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post"
                        name="register" onSubmit="return valid();">
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email" required>
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
                        <div class="form-group">
                            <label for="con_password">Address</label>
                            <textarea name="address" class="form-control form-control-sm" id="address"
                                required></textarea>
                        </div>
                        <button type="submit" name="submit" id="btnSubmit"
                            style="background-color: #223A66; color: aliceblue;" class="btn btn-block">Sign up</button>


                        <div class="sign-up">
                            Already Have an account? <a href="company_login.php">Login</a>
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
    <?php include('includes/scripts.php'); ?>
    <!-- Checking User Availability -->
    <script>
        $(document).ready(function () {
            $('#email').blur(function () {
                $('#btnSubmit').prop('disabled', false);
                $("#user-availability-status1").html("");
                $.ajax({
                    url: 'company_check_availability.php',
                    type: 'POST',
                    data: 'email=' + $("#email").val()
                }).done(function (data) {
                    //some code going here if success 
                    if (data == 'exist') {
                        $("#user-availability-status1").html(
                            '<span style="color:red;">Email Address already exist!</span>');
                        $('#btnSubmit').prop('disabled', true);
                    }

                }).fail(function () {
                    // alert
                });
            });
        });
    </script>
</body>

</html>