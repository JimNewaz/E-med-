<?php
session_start();
error_reporting(0);
include('includes/config.php');	

$pid=intval($_GET['pid']);

if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{


?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>E Med</title>
	<?php include('includes/links.php')?>
</head>

<body>
	<?php include('includes/header.php')?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mt-100" style="text-align:center; padding:50px;">
                    <h1>My <span style="color:#E12454">Wishlist</span></h1>
                </div>               
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" style="text-align:center;">
                        <thead>
                            <tr>
								<th colspan="1">Image</th>
                                <th colspan="1">Name</th>
                                <th colspan="1">Price</th>
                                <th colspan="1">Add To Cart</th>
                                <th colspan="1">Remove</th>
							</tr>
                        </thead>
                        <tbody>
                            <?php
                                $run=mysqli_query($con,"select medicine.name as mname, medicine.image1 as mimage, medicine.price as mprice, wishlist.medicine_id as pid, wishlist.list_id as id from wishlist join medicine on medicine.id=wishlist.medicine_id where wishlist.user_id='".$_SESSION['id']."'");

                                $num=mysqli_num_rows($run);
                                if($num>0)
                                {
                                while ($row=mysqli_fetch_array($run)) {

                            ?>
                            <tr>
                                <td class="col-md-2">
                                    <img src="admin/images/medicines/<?php echo ($row['mimage']);?>" width="100" height="120">
                                </td>
                            
                                <td class="col-md-6" >
                                     <a href="product_details.php?pid=<?php echo ($row['pid']);?>" ><?php echo ($row['mname']);?> 
                                     </a>
                                </td>
                            
                                <td class="col-md-2">
                                    <h4 style="color:#E12454; margin-top:20px;"> 
                                        <?php 
                                            echo ($row['mprice']);
                                        ?>
                                    </h4>
                                </td>
                            
                                <td class="col-md-2">
                                        <a href="my-wishlist.php?page=product&action=add&id=<?php echo $row['pid']; ?>" class="btn-upper btn btn-primary">Add to cart</a>
                                </td>
                                <td class="col-md-2">
                                    <a href="del_wishlist.php?id=<?php echo $row['pid']?>&del=delete"  		onClick="return confirm('Are you sure you want to delete this product?')" >
                                    <i class="icofont-ui-delete"></i></a>
                                </td>
                            </tr>
                            <?php } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php include('includes/footer.php')?>


    <?php include('includes/scripts.php')?>
</body>   

</html>
<?php }?>