<?php
session_start();
error_reporting(0);
include('includes/config.php');	

// $_SESSION['tp'] total price


if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

    // echo $_SESSION['tp'];

    $total_pri=$_SESSION['tp'];
    $user_id=$_SESSION['id'];

	if (isset($_POST['submit'])) {

        $a=mysqli_query($con,"SELECT p.point c, p.shipping_address d FROM user p where p.id=$user_id");
            $row=mysqli_fetch_array($a);

            
            $current_price=intval($row['c']);
            $address=$row['d'];
      
        if($_POST['paymethod']=='Your Point')
        {              
            
            if($current_price >= $total_pri)
            {
                // echo "Test";
                $update_price= $current_price - $total_pri;
                mysqli_query($con,"update user set point='$update_price' where id='".$_SESSION['id']."'");

                $rr=$_SESSION['order_id'];
                for($i=0; $i<count($rr); $i++)
                {
                    $id=$rr[$i];
                    $rrr="update medicine_orders set payment='".$_POST['paymethod']."', amount='$total_pri', address='$address' where id=$id";
                    
                    mysqli_query($con,$rrr);
                    // echo $rrr;
                    
                }
                
               

                echo '<script type="text/javascript">'; 
                echo'<script>alert("Order Successfull")</script>';
                echo 'window.location.href = "index.php";';
                echo '</script>';
                

            }else{                
                echo'<script>alert("Order Unsuccessfull! Insufficient Balance")</script>'; 
                
            } 
        }else{
            $rr=$_SESSION['order_id'];

            for($i=0; $i<count($rr); $i++)
            {
                $id=$rr[$i];
                $rrr="update medicine_orders set payment='".$_POST['paymethod']."', amount='$total_pri', address='$address' where id=$id";
                
                mysqli_query($con,$rrr);
                // echo $rrr;
                
            }
                        
            
        }
        unset($_SESSION['cart']);

		
        

	}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>E Med</title>
    <?php include('includes/links.php')?>
</head>

<body>
    <?php include('includes/header.php')?>

    <?php echo $totalprice;?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mt-100" style="text-align:center; padding:50px;">
                    <h1>Payment <span style="color:#E12454">Method</span></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        Select Your Payment Method
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <img src="https://www.logo.wine/a/logo/BKash/BKash-Icon2-Logo.wine.svg"
                                class="rounded float-left" alt="..." height="200px" width="200px" ;>
                            <input type="radio" name="paymethod" value="bkash" checked="checked"> Bkash

                            <img src="https://www.logo.wine/a/logo/Nagad/Nagad-Vertical-Logo.wine.svg" class="rounded"
                                alt="..." height="200px" width="200px">
                            <input type="radio" name="paymethod" value="Nagad"> Nagad


                            <hr>

                            <img src="https://5.imimg.com/data5/NX/QH/SF/SELLER-78615388/cash-on-delivery-jpg-500x500.jpg"
                                class="rounded" alt="..." height="200px" width="200px">
                            <input type="radio" name="paymethod" value="Cash on Delivery"> COD

                            <img src="https://cdn4.iconfinder.com/data/icons/money-filled-outline/64/money-colored-15-512.png"
                                class="rounded" alt="..." height="200px" width="200px">
                            <input type="radio" name="paymethod" value="Your Point"> Your Point
                            <br>
                            <input type="submit" name="submit" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="card-footer text-muted">

                    </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>







    <?php include('includes/footer.php')?>
    <!--Scripts -->
    <?php include('includes/scripts.php')?>
</body>

</html>

<?php } ?>