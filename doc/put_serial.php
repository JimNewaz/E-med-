<?php 
    session_start();
    error_reporting(0);
	include('includes/config.php');

    if(!isset($_SESSION['id'])){
        header("location:login.php");
    }
    $appointment_id = $_GET['id'];
    $doc = $_SESSION['name'];
    $id = $_SESSION['id'];
    $date = date('Y-m-d');
    $query = "SELECT max(serial) as serial FROM appointment WHERE doctor_id = '$doc_id' AND date(date_time) = '$date' GROUP BY date(date_time)";
    // print($query.'\n');
    $result = mysqli_query($con,$query);
    // print_r($result);
    $serial = '';
    while($row = mysqli_fetch_array($result)){
        // print_r($row);
        $serial = $row['serial'];
    }
    if($serial == ''){
        $serial = 1;
    }else{
        // echo"come here";
        $serial = $serial + 1;
    }

    $query = "UPDATE appointment SET serial = '$serial' WHERE id = '$appointment_id'";
    $result = mysqli_query($con,$query);
    if($result){
        header("location:index.php");
    }
?>
