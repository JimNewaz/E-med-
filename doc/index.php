<?php
    session_start();
    error_reporting(0);
    include("includes/config.php");

    if(!isset($_SESSION['id'])){
        header("location:login.php");
    }
    $user = $_SESSION['name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>E Med</title>
	<?php include('includes/links.php')?>
    
</head>

<body>
	<?php include('includes/header.php')?>
    <div class="wrapper">
		<div class="container">
			<div class="row">
				<!-- <?php include('includes/sidebar.php');?> -->
				<div class="span9">
					<div class="content">
						<div class="module">
							<div class="module-head">
								<h3>Manage Recent Appointments</h3>
							</div>
							<div class="module-body table">

                                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Appointment DateTime</th>
                                            <th>Serial</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $doc_id = $_SESSION['id'];
                                            $date = date('Y-m-d');
                                            // echo $doc_id;
                                            $query = "SELECT * FROM appointment WHERE doctor_id = '$doc_id' AND date(date_time) = '$date' ORDER BY date_time DESC";
                                            // echo $query;
                                            $result = mysqli_query($con, $query);
                                            // print_r($result);
                                            while($row = mysqli_fetch_array($result)){
                                                $id = $row['id'];
                                                $patient_id = $row['user_id'];
                                                $doctor_id = $row['doctor_id'];
                                                // echo $patient_id . " " . $doctor_id . " " . $id;
                                                $appointment_date_time = $row['date_time'];
                                                $serial = $row['serial'];
                                                $query1 = "SELECT * FROM user WHERE id = '$patient_id'";
                                                $result1 = mysqli_query($con, $query1);
                                                $row1 = mysqli_fetch_array($result1);
                                                $patient_name = $row1['name'];
                                                $query2 = "SELECT * FROM doctors WHERE id = '$doctor_id'";
                                                $result2 = mysqli_query($con, $query2);
                                                $row2 = mysqli_fetch_array($result2);
                                                $doctor_name = $row2['name'];
                                                ?>
                                        <tr>
                                            <td><?php echo $patient_name;?></td>
                                            <td><?php echo $doctor_name;?></td>
                                            <td><?php echo $appointment_date_time;?></td>
                                            <td><?php echo $serial;?></td>
                                            <td><?php echo $row['status'];?></td>
                                            <td><a href="put_serial.php?id=<?php echo $id;?>" disabled=<?php if($serial !='') echo "disabled" ?>>Give Serial</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>                           
                            </div>
						</div>
					</div>
					<!--/.content-->
				</div>
				<!--/.span9-->
			</div>
		</div>
		<!--/.container-->
	</div>
	<!--/.wrapper-->



    <!-- Login Form End -->

    <!-- Footer Start -->
    <?php include('includes/footer.php')?>
    <!-- Footer End -->

    <!-- Scripts -->
    <?php include('includes/scripts.php')?>
</body>

</html>