<?php 
  session_start();
  error_reporting(0);
	include('includes/config.php');

  if(strlen($_SESSION['login'])==0)
    {
      header('location:login.php');
    }else{
      $user_id=$_SESSION['id'];

      // echo $user_id;
      if(isset($_POST['submit']))
      {
          $disease_type=$_POST['disease_type'];
          $doc_name=$_POST['doc_name'];
          $hospital=$_POST['hospital_name'];

          $image=$_FILES['image']['name'];
          
          $temp_name1=$_FILES['image']['tmp_name'];
          move_uploaded_file($temp_name1,"admin/images/prescriptions/$image");

          $query="insert into prescriptions(user_id,hospital,doctor,disease_type,prescription_image) values('".$_SESSION['id']."', '$hospital', '$doc_name', '$disease_type','$image')";

          $run_query=mysqli_query($con,$query);

          if($run_query)
            {               
              echo "<script>alert('Your prescription is under review.');</script>";     
            }
          else{
                // echo $user_id;
                echo "<script>alert('Something went worng, try again');</script>";
            }
                    
      }
?>



<!DOCTYPE html>
<html lang="en">

<head>

  <title>E Med - Upload Prescription</title>
  <?php include('includes/links.php')?>

</head>

<body>

  <header>
    <?php include('includes/header.php')?>
  </header>

  <section class="page-title">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <h1>UPLOAD YOUR PRESCRIPTIONS HERE</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="appoinment section">
    <div class="container">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-12">
          <!-- <h2 class="title-color" style="text-align: center;">Please Fill All The Require Information</h2> -->
          <br>
          <br>
          <form method="post" action="#" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <p>Select A Disease Sector</p>
                  <select class="form-control" id="exampleFormControlSelect1" name="disease_type" required>
                    <option>Normal Disease</option>
                    <option>Medium Disease</option>
                    <option>Deadly Disease</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <p>Enter Doctor Name</p>
                  <input name="doc_name" id="" type="text" class="form-control" placeholder="Doctor's Name" required>

                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <p>Enter Medical College/Hospital Name</p>
                  <input name="hospital_name" id="" type="text" class="form-control" placeholder="Hospital Name"
                    required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <p>Upload Prescription</p>
                  <div class="input-group">
                    <input type="file" class="form-control" id="" name="image">
                  </div>
                </div>
              </div>

            </div>

            <div class="col-md-12" style="text-align:center;">
              <button type="submit" name="submit" style="background-color: #223A66; color: aliceblue; margin-top: 20px;"
                class="btn btn-main">Upload Prescription</button>
            </div>


          </form>
        </div>
      </div>
    </div>
  </section>





  <!-- Footer Start -->

  <?php include('includes/footer.php')?>

  <!-- Footer End -->

  <!--     Essential Scripts    -->
  <?php include('includes/scripts.php')?>




</body>

</html>

<?php } ?>