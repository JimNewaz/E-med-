<?php
session_start();

include_once 'include/config.php';
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else{
$oid=intval($_GET['oid']);

if(isset($_POST['submit2'])){
$status=$_POST['status'];


$sql=mysqli_query($con,"update medicine_orders set order_status='$status' where id='$oid'");
echo "<script>alert('Order updated sucessfully...');</script>";

}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order Status</title>
    <?php include('include/links.php')?>
</head>


<body>
    <?php include('include/header.php');?>

    <div style="margin-left:50px;">
        <form name="updateticket" id="updateticket" method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr height="50">
                    <td colspan="2" class="fontkink2" style="padding-left:0px;">
                        <div class="fontpink2"> <b>Update Order !</b></div>
                    </td>

                </tr>
                <tr height="30">
                    <td class="fontkink1"><b>order Id:</b></td>
                    <td class="fontkink"><?php echo $oid;?></td>
                </tr>

                <?php 
                $st='Delivered';
                $rt = mysqli_query($con,"SELECT * FROM medicine_orders WHERE id='$oid'");
                while($num=mysqli_fetch_array($rt))
                {
                $currrentSt=$num['order_status'];
                }
                if($st==$currrentSt)
                { ?>
                <tr>
                    <td colspan="2">
                        <b>
                            Product Delivered
                        </b>
                    </td>
                    <?php }else  {
                ?>

                <tr height="50">
                    <td class="fontkink1">Status: </td>
                    <td class="fontkink"><span class="fontkink1">
                            <select name="status" class="fontkink" required="required">
                                <option value="">Select Status</option>
                                <option value="in Process">In Process</option>
                                <option value="Delivered">Delivered</option>
                            </select>
                        </span></td>
                </tr>



                <tr>

                    <td class="fontkink"> <input type="submit" name="submit2" value="update" size="40"
                            style="cursor: pointer;" /> &nbsp;&nbsp;

                </tr>
                <?php } ?>
            </table>
        </form>
    </div>

</body>

</html>
<?php } ?>