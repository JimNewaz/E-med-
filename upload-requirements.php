<style>
    @import url("https://fonts.googleapis.com/css?family=Roboto+Condensed:300,700&display=swap");
@import url("https://fonts.googleapis.com/css?family=Josefin+Slab&display=swap");

.process {
  width: 100%;
  padding: 0 15px;
  text-align: center;
}
.process__item {
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  text-align: center;
  position: relative;
  padding: 15px 35px;
  transition: 0.4s ease-in-out;
}
.process__item:hover {
  background: #f2f2f2;
}
.process__item:hover .process__number {
  transform: translateY(5px);
  color: #003c71;
}
.process__number {
  font-size: 90px;
  -webkit-text-stroke: 1px #003c71;
  display: block;
  color: transparent;
  font-family: "Roboto Condensed";
  font-weight: 700;
  transition: 0.4s ease-in-out;
}
.process__title {
  display: block;
  font-family: "Roboto Condensed";
  font-weight: 700;
  letter-spacing: 1.5px;
  font-size: 35px;
  color: #003c71;
  text-transform: uppercase;
  margin-top: 30px;
}


@media (min-width: 768px) {
  .process {
    display: inline-block;
  }
  .process__item {
    width: 49%;
    display: inline-block;
  }
}
@media (min-width: 1200px) {
  .process {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }
  .process__item {
    width: 100%;
  }
  .process__item:not(:last-of-type)::after {
    content: "";
    width: 1px;
    height: 75%;
    background: #8c8c8c;
    position: absolute;
    right: 0;
    top: 50%;
    opacity: 0.2;
    transform: translateY(-50%);
  }
}
</style>    

<?php 
    session_start();
    error_reporting(0);
	include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>E Med - Upload Requirements</title>
    <?php include('includes/links.php')?>
</head>

<body>
    <!-- Header Start-->
    <?php include('includes/header.php')?>
    <!-- Header End -->
    <hr>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="process">
                    <li class="process__item">
                        <span class="process__number">1</span>
                        <span class="process__title">Complete Registration</span>                        
                    </li>

                    <li class="process__item">
                        <span class="process__number">2</span>
                        <span class="process__title">Sign In / Login</span>                        
                    </li>

                    <li class="process__item">
                        <span class="process__number">3</span>
                        <span class="process__title">Upload Prescription</span>                        
                    </li>

                    <li class="process__item">
                        <span class="process__number">4</span>
                        <span class="process__title">Earn Money</span>                        
                    </li>
                </ul>
            </div>
        </div>
    </div>

<div class="conatiner" style="margin-top:80px;">
    <div class="row">
        <div class="col-md-12" style="text-align:center;">
            <span class="process__title" style="color:#E12454;">All Set! Let's <span><a href="prescription.php">Upload</a></span> </span>   
        </div>
    </div>
</div>


    <!-- Footer  -->
    <?php include('includes/footer.php')?>
    <!-- Footer End -->
    <?php include('includes/scripts.php')?>
</body>

</html>