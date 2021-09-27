<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');

    if(isset($_GET['reset'])){
        // echo $_GET['reset'];
        $flag = 1;
        
    }

    if(isset($_SESSION['alert'])){
        // echo $_SESSION['alert'];
        // unset($_GET['reset']);
        // header('location:my-account.php');
    }

    
    if(strlen($_SESSION['login'])==0)
    {
        header('location:login.php');
    }else{
        if(isset($_POST['submit']))
        {
            $id = $_SESSION['id'];
            
            if (isset($_POST['pass'])) {
                $password=$_POST['pass'];
                $repassword=$_POST['repass'];
                if ($password == $repassword) {
                    $password = md5($password);
                    $sql = "UPDATE doctors SET pass='$password' WHERE id='$id'";
                    $query = mysqli_query($con,$sql);
                    if ($query) {
                        $_SESSION['alert'] = "Password Changed Successfully";
                        // echo $_SESSION['alert'];
                        // header('location:my-account.php');
                    }
                }else{
                    $_SESSION['alert'] = "Password Not Matched";
                    // header('location:my-account.php');
                }
            }else{
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $_SESSION['alert'] =  "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $_SESSION['alert'] =  "File is not an image.";
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    $_SESSION['alert'] =  "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    $_SESSION['alert'] =  "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $_SESSION['alert'] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 1) {
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                }

                $name=$_POST['name'];
                $contact=$_POST['contact'];
                $email=$_POST['email'];
                $specialization=$_POST['special'];
                $fee = $_POST['fee'];
                $start = $_POST['start'];
                $end = $_POST['end'];
                $meetlink = $_POST['meetlink'];
                $imgpath = $_FILES["fileToUpload"]["name"];
                if($imgpath == ""){
                    $query=mysqli_query($con,"update doctors set name='$name', email = '$email', contact_no='$contact', speciality='$specialization', visit_fee ='$fee', chamber_time_start = '$start', chamber_time_end = '$end', meet_link = '$meetlink' where id='".$_SESSION['id']."'");
                }else{
                    $query=mysqli_query($con,"update doctors set name='$name', email = '$email', contact_no='$contact', speciality='$specialization', visit_fee ='$fee', chamber_time_start = '$start', chamber_time_end = '$end', imgpath = '$imgpath', meet_link = '$meetlink' where id='".$_SESSION['id']."'");
                }
                if($query)
                {
                    $_SESSION['alert'] = "Profile Updated Successfully";
                    // header('location:my-account.php');
                }
            }   
        }
    }
?>
<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>E Med | My accout</title>
 	<?php include('includes/links.php')?>

</head>

<body id="top">	
	<?php include('includes/header.php')?>
    <?php 
        $query=mysqli_query($con,"select * from doctors where id='".$_SESSION['id']."'");
        while($row=mysqli_fetch_array($query))
        {
    ?>
    <div class="container" >        
        <h1 style="text-align:center; margin-top:20px; color:#223A66;">Welcome To <span style="color:red;">E</span> Med Family!</h1>
        <div class="row" style ="text-align:center">
            <?php if (strlen($row['imgpath'])!=0) { ?>
                <img class='displayed' src="images/<?php echo $row['imgpath'];?>" alt="images/profile.png" style="width:20%; margin-top:20px;">
            <?php }else{ ?>
                <img class='displayed' src="images/profile.png" style="width:20%; margin-top:20px; hotizontal-align:middle;">
            <?php } ?>
            
        </div>
        <?php if($row['featured']=='no'){?>
            <a href="featured.php" class="btn btn-success" style="float:middle;">Get Featured Subscription</a>
            <a href="featured-info.php" class="btn btn-info" style="float:middle; width: 60%">Why You Need Featured Subscription</a>
        <?php } ?>
    </div>
    <br>
    <div class="container">
        <!-- <div class="col-md-1"></div> -->
            <div class="col-md-12">                
                <div class="row justify-content-center">          
                    <span class="anchor"></span>            
                        <!-- form user info -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <?php if($_SESSION['alert']){?>
                                <div class="" role="alert" style="background-color: #F8D7DA; color:black; padding:5px 5px 5px 5px;">
                                    <?php
                                        echo htmlentities($_SESSION['alert']);
                                    ?>
                                    <?php
                                        echo htmlentities($_SESSION['alert']="");
                                    ?>
                                </div>
                            <?php } ?>
                            <h3 class="" style="text-align:center;">My Profile <?php if($row['featured']=='yes') echo "(Featured)";?></h3>
                            
                        </div>
                        <div class="card-body">
                        <?php if($_SESSION['alert']){?>
                            <div class="" role="alert" style="background-color: #F8D7DA; color:black; padding:5px 5px 5px 5px;">
                                <?php
                                    echo htmlentities($_SESSION['alert']);
                                ?>
                                <?php
                                    echo htmlentities($_SESSION['alert']="");
                                ?>
                            </div>
                        <?php } ?>
                            <form action="" method="POST" enctype="multipart/form-data" >
                            <?php if ($flag != 1) { ?> 
                                <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Full Name</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['name']; ?>" name = 'name'>
                                        </div>
                                    </div>                                
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="email" value="<?php echo $row['email']; ?>" name = 'email'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Contact No</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['contact_no']; ?>" name = 'contact'>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Visiting Fee</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['visit_fee']; ?>" name = 'fee'>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Speciality</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['speciality']; ?>" name = 'special'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Chember Time Start</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['chamber_time_start']; ?>" name = 'start'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Chember Time End</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['chamber_time_end']; ?>" name = 'end'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Meet Link For Patient</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['meet_link']; ?>" name = 'meetlink'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Upload profile picture</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="file" name='fileToUpload'>
                                        </div>
                                    </div>
                                                   
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="password" value="<?php echo $row['pass']; ?>" disabled> 
                                            <small class="form-text text-muted" id="passwordHelpBlock">If you want to change your password please click in the link below. Follow the instrustions and change your password.
                                            <a href="?reset=1" style="color:red;">Change Password</a> </small>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if ($flag == 1) { ?>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Full Name</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['name']; ?>" disabled>
                                        </div>
                                    </div>                                
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="email" value="<?php echo $row['email']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Contact No</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['contact_no']; ?>"disabled>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Visiting Fee</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['visit_fee']; ?>"disabled>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Speciality</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['speciality']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Chember Time Start</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['chamber_time_start']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Chember Time End</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['chamber_time_end']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Meet Link For Patient</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo $row['meet_link']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Upload profile picture</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="file" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">New Password</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="password" name='pass'> 
                                            <small class="form-text text-muted" id="passwordHelpBlock">If you want to change your password please enter new password. </small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Re-Enter New Password</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="password" name='repass'> 
                                            <small class="form-text text-muted" id="passwordHelpBlock">If you want to change your password please re enter new password. </small>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-3">                                     
                                        <button type="submit" style="background-color: #223A66; color: aliceblue;" class="btn btn-block" name="submit">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                    </div><!-- /form user info -->
                </div>        
            </div>
        <!-- <div class="col-md-1"></div> -->
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
   