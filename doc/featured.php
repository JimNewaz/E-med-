<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');

    if(strlen($_SESSION['login'])==0)
    {
        header('location:login.php');
    }

    $date = date('Y-m-d');
    $invoice = $_SESSION['id'].$date.'emed';

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>E Med | My accout</title>
 	<?php include('includes/links.php')?>
    

</head>

<body id="top">	

    <?php include('includes/links-sp.php')?>
    <table class="body-wrap">
    <tbody><tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td class="content-wrap aligncenter">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody><tr>
                                    <td class="content-block">
                                        <h2>Thanks for buying subscription from E-MED</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <table class="invoice">
                                            <tbody><tr>
                                                <td><?php echo $_SESSION['name']; ?><br>Invoice #<?php echo $invoice ?><br><?php echo $date; ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                        <tbody><tr>
                                                            <td>1 month subscription</td>
                                                            <td class="alignright">25000.00</td>
                                                        </tr>
                                                        <tr class="total">
                                                            <td class="alignright" width="80%">Total</td>
                                                            <td class="alignright">25000.00</td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="content-block">
                                                    <a href="payment.php?amount=25000&ref_id=<?php echo $_SESSION['id'];?>&ref_type='doctor'&remark=<?php echo $invoice; ?>" style="width:40%" class="btn btn-success">Make Payment</a>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        E-med . All rights reserved.
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <div class="footer">
                    <table width="100%">
                        <tbody><tr>
                            <td class="aligncenter content-block">Questions? Email <a href="mailto:">support@company.inc</a></td>
                        </tr>
                    </tbody></table>
                </div></div>
        </td>
        <td></td>
    </tr>
</tbody></table>

<!-- Footer Start -->
<?php include('includes/footer.php')?>   
<!-- Footer End -->

 <!--     Essential Scripts    -->
 <?php include('includes/scripts.php')?> 
    

</body>
</html>