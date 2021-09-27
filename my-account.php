<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');

    if(strlen($_SESSION['login'])==0)
    {
        header('location:login.php');
    }else{
        if(isset($_POST['submit']))
        {
            $name=$_POST['name'];
            $contact=$_POST['contact'];
            $shipping=$_POST['shipping'];

            $query=mysqli_query($con,"update user set name='$name', contact_no='$contact', shipping_address='$shipping' where id='".$_SESSION['id']."'");
            if($query)
            {
                echo "<script>alert('Your info has been updated');</script>";
            }
        }
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>E Med | My accout</title>
    <?php include('includes/links.php')?>

</head>

<body id="top">
    <?php include('includes/header.php')?>

    <div class="container">
        <h1 style="text-align:center; margin-top:20px; color:#223A66;">Welcome To <span style="color:red;">E</span> Med
            Family!</h1>
    </div>
    <br>
    <div class="container">

        <div class="col-md-12">
            <div class="row justify-content-center">
                <span class="anchor"></span>

                <div class="card card-outline-secondary">
                    <div class="card-header">
                        <h3 class="" style="text-align:center;">My Profile</h3>
                    </div>
                    <div class="card-body">
                        <?php 
                            $query=mysqli_query($con,"select * from user where id='".$_SESSION['id']."'");
                            while($row=mysqli_fetch_array($query))
                            {
                        ?>
                        <form action="" method="post">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Full Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="<?php echo $row['name']; ?>"
                                        name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="email" value="<?php echo $row['email']; ?>"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Contact No</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="<?php echo $row['contact_no']; ?>"
                                        name="contact">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Shipping Address</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text"
                                        value="<?php echo $row['shipping_address']; ?>" name="shipping">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Current Balance</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="<?php echo $row['point']; ?>"
                                        name="balance" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" value="<?php echo $row['password']; ?>"
                                        disabled>
                                    <small class="form-text text-muted" id="passwordHelpBlock">If you want to change
                                        your password please click in the link below. Follow the instrustions and change
                                        your password.
                                        <a href="recover_email.php" style="color:red;">Change Password</a> </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3">
                                    <button type="submit" style="background-color: #223A66; color: aliceblue;"
                                        class="btn btn-block" name="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <br>
    <br>

    <!-- Footer Start -->
    <?php include('includes/footer.php')?>
    <!-- Footer End -->

    <!--     Essential Scripts    -->
    <?php include('includes/scripts.php')?>


</body>

</html>