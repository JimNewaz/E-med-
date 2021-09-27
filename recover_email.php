<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $email_query="select * from user where email='$email'";
    $query=mysqli_query($con,$email_query);
    $email_count=mysqli_num_rows($query);

    if($email_count)
    {
        $userdata=mysqli_fetch_array($query);
        $username=$userdata['name'];
        $token=$userdata['token'];

        // Email 
        $subject="Password Reset";
        $body="Hi $username, click here to recover your password http://localhost/jim/emed/recover_password.php?token=$token";
        $sender_email="From: forallpurposes3@gmail.com";

        if(mail($email,$subject,$body,$sender_email)){
            echo "<script>alert('Check Your Mail To reset Your Password');</script>";
                    
        }else{
            echo "<script>alert('Invalid Email');</script>";
        }
    }else{
         echo "<script>alert('No Email Found');</script>";
    }
        // header("location: login.php");   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recover Password</title>
    <?php include('includes/links.php')?>  

    <!-- Checking User Availability -->
    <script>
        function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check_availability.php",
        data:'email='+$("#email").val(),
        type: "POST",
        success:function(data){
        $("#user-availability-status1").html(data);
        $("#loaderIcon").hide();
        },
        error:function (){}
        });
        }
    </script>
</head>
<body>
    <!-- Header Start-->
    <?php include('includes/header.php')?> 
    <!-- Header End -->

    <!-- Email -->
    <div class="global-container">
        <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-center">Enter Your Email</h3>
            <div class="card-text">                
              
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                    
                    <div class="form-group">
                        <label for="">Email address</label>
                        <input type="email" class="form-control form-control-sm" id="email" name="email" onBlur="userAvailability()">
                    </div>
                    
                    <button type="submit" style="background-color: #223A66; color: aliceblue;" class="btn btn-block" name="submit">Recover Password</button>
                    
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