<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');	

    $pid=intval($_GET['pid']);
    // echo $pid;

    // Add to CART
    if(isset($_GET['action']) && $_GET['action']=='add')
    {
        $id=intval($_GET['pid']);
        if(isset($_SESSION['cart'][$id]))
        {
            $_SESSION['cart'][$id]['quantity']++;
        }else{
            $sql_p="SELECT * FROM medicine WHERE id={$id}";
            $query_p=mysqli_query($con,$sql_p);

            if(mysqli_num_rows($query_p)!=0)
            {
                $row=mysqli_fetch_array($query_p);
                $_SESSION['cart'][$row['id']]=array("quantity" => 1, "price" => $row_p['medicinePrice']);
            }else{
                $message="Product ID is invalid";
            }
        }
        echo "<script>alert('Product has been added to the cart')</script>";
        echo "<script type='text/javascript'> document.location ='mycart.php'; </script>";
    }

    //wishlist
    if(isset($_GET['pid']) && $_GET['action']=="wishlist"){
        if(strlen($_SESSION['login'])==0)
        {   
        header('location:login.php');
        }
        else
        {
        mysqli_query($con,"insert into wishlist (user_id,medicine_id) values('".$_SESSION['id']."','$pid')");
        echo "<script>alert('Product added in wishlist');</script>";
        // header('location:wishlist.php');        
        }

    }
?>
<style>
    h5 {
        font-family: Helvetica, sans-serif !important;
    }
</style>

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
            <br>
            <div class="col-md-12 mt-100" style="text-align:center; padding:20px; margin-bottom:20px;">
                <h1>Product <span style="color:#E12454">Details</span></h1>
            </div>
            <hr>
            <div class="clear"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php 
                $get_product="select * from medicine where id='$pid'";
                $run_products=mysqli_query($con,$get_product);
                
                while($row_product=mysqli_fetch_array($run_products)){
                    
                    $pro_id=$row_product['id'];
                    $pro_title=$row_product['name'];
                    $pro_price=$row_product['price'];
                    $pro_company=$row_product['company'];
                    $pro_desc=$row_product['description'];
                    $charge=$row_product['shipping_charge'];                
                    $pro_img1=$row_product['image1'];
                    $pro_img2=$row_product['image2'];
                    $pro_img3=$row_product['image3'];
                    $pro_avail=$row_product['product_availability'];        
                ?>

            <div class="col-md-5" style="border: 1px solid #E5E5E5">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?php echo "<img class='d-block w-100' src='admin/images/medicines/$pro_img1'  alt='First slide'>"?>
                        </div>
                        <div class="carousel-item">
                            <?php echo "<img class='d-block w-100' src='admin/images/medicines/$pro_img2'  alt='Second slide'>"?>
                        </div>
                        <div class="carousel-item">
                            <?php echo "<img class='d-block w-100' src='admin/images/medicines/$pro_img3'  alt='Third slide'>"?>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>


            <div class="col-md-6" style="border: 1px solid #E5E5E5; margin-left:10px;  padding:20px;">
                <h2 style="text-align:center; color: #223A66;"><?php echo $pro_title?></h2>

                <div class="row">
                    <div class="col-md-5">
                        <h5 style="color:#666666">AVAILABILITY:</h5>
                    </div>
                    <div class="col-md-7">
                        <?php 
                            if($pro_avail=='In Stock')
                            {
                                echo'<span style="color:green">In Stock</span>';
                            }else{
                                echo'<span style="color:red">Out of Stock</span>';
                            }        
                        ?>
                    </div>
                    <div class="col-md-5">
                        <h5 style="color:#666666">BRAND:</h5>
                    </div>
                    <div class="col-md-7">
                        <?php 
                            echo "$pro_company";
                        ?>
                    </div>

                    <div class="col-md-5">
                        <h5 style="color:#666666">SHIPPING CHARGE:</h5>
                    </div>
                    <div class="col-md-7">
                        <?php 
                            echo "$charge BDT";
                        ?>

                    </div>

                    <div class="col-md-12">

                        <?php $rt=mysqli_query($con,"select * from ratting where pid='$pid'");
                        $num=mysqli_num_rows($rt);
                        {
                        ?>
                        <div class="rating-reviews m-t-20">
                            <div class="row">
                                <div class="col-sm-3">
                                    <!--<div class="rating rateit-small"></div>-->
                                    <?php 
											$pid=$_GET['pid'];
											$sel="SELECT ROUND(AVG(ratting),1) as r FROM ratting WHERE pid='$pid' AND isapproved='1'";
											$rs=mysqli_query($con,$sel);
								 			$rss=mysqli_fetch_array($rs);
										?>

                                    <?php 
								
								    
								    $i = 1;
                                    while ($i <= 5) {
                                        
                                        if ($i <= $rss['r']) {
                                            
                                            echo '<span class="icofont-star checked"></span>';
                                        }else {
                                           
                                        echo '<span class="icofont-star"></span>';
                                        }
                                        $i++;
                                    }
								    
																			    ?>





                                </div>
                                <div class="col-sm-8">

                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.rating-reviews -->

                        <?php } ?>
                    </div>


                    <div class="col-md-12">
                        <hr style="color:#666666">
                    </div>

                    <div class="col-md-5">
                        <h5 style="color:#666666">DESCRIPTION:</h5>
                    </div>
                    <div class="col-md-7">
                        <?php 
                            echo "$pro_desc";
                        ?>
                    </div>

                    <div class="col-md-5">
                        <h2 style="color:#E12454; margin-top:30px;">
                            <?php 
                                echo "$pro_price BDT";
                            ?>
                        </h2>
                    </div>

                    <div class="col-md-12">

                        <?php
							if($pro_avail == 'In Stock'){
								echo"<a href='product_details.php?page=product&action=add&pid= $pro_id' class='btn btn-primary' style='background-color:#222222'>Add To Cart</a>";
							}else{
								echo"<a href='#' class='btn btn-primary' style='background-color:white; color:red;'>Out of Stock</a>";
							}
						?>
                        <a href='product_details.php?pid=<?php echo $pro_id;?>&&action=wishlist' tittle='wishlist'
                            class='btn btn-primary' style='background-color:#E12454'> <i
                                class="icofont-heart icofont-lg"></i></a>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="product_feedback.php?pid=<?php echo $pid?>" type="button" class="btn btn-primary" style="padding:5px; margin-left:5px"> Leave A Feedback</a>                          
                        </div>
                    </div>

                </div>
            </div>

            <?php } ?>
        </div>
    </div>

    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3 style="Text-align:center">Product Reviews</h3>
                <br>
                <div class="box" style="border:1px solid grey; padding:20px">
                    <?php
						$pid=$_GET['pid'];
						$sel="SELECT * FROM ratting where pid='$pid' AND isapproved='1'";
						$rs=$con->query($sel);
						while($row=$rs->fetch_assoc()){
					?>

                    <h4><?php echo $row['name']; ?></h4>
                    <p>
                        <?php for($i=1;$i<=$row['ratting'];$i++){ ?>
                        <span class="icofont-star checked"></span>
                        <?php  }?>

                        <?php for($j=1;$j<=5-$row['ratting'];$j++) {?>
                        <span class="icofont-star "></span>
                        <?php  } ?>
                    </p>

                    <p><?php echo $row['review'] ?></p>
                    <br>
                    <h6><?php echo $row['reviewdate'];      ?></h6>
                    <hr />
                    <?php  } ?>

                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>





    <div class="col-md-12 mt-100" style="text-align:center; padding:50px;">
        <h1>More <span style="color:#E12454">Products</span> </h1>
    </div>




    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <?php
						$get_product="select * from medicine order by 1 LIMIT 0,3 ";
						$run_products=mysqli_query($con,$get_product);
						
						while($row_product=mysqli_fetch_array($run_products)){
							
							$pro_id=$row_product['id'];
							$pro_title=$row_product['name'];
							$pro_price=$row_product['price'];
							$pro_company=$row_product['company'];
							$pro_img1=$row_product['image1'];
							$pro_avail=$row_product['product_availability'];
						?>

                <div class='col-md-4' style='margin-bottom:30px;'>
                    <div class='card' style='width: 18rem; text-align:center;'>
                        <?php echo "<img class='card-img-top' src='admin/images/medicines/$pro_img1'  alt='Card image cap' style='width:250px; height:220px'>"
									 ?>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $pro_title?></h5>
                            <p> BDT <?php echo $pro_price?> </p>

                            <!-- Review -->
                            <div class="">
                                <?php 
										$pid=$row['id'];
										$sel="select round(AVG(r.ratting),1) as rr from ratting r
											join products p ON r.pid = p.id WHERE r.pid='$pid' AND r.isapproved='1'";
											
										$rs=mysqli_query($con,$sel);
										$rss=mysqli_fetch_array($rs);
									?>

                                <?php 
										$i = 1;
											while ($i <= 5) {
															
											if ($i <= $rss['rr']) {
																
											echo '<span class="icofont-star checked"></span>';
											}else {
															
											echo '<span class="icofont-star"></span>';
												}
											$i++;
											}
														
									?>
                            </div>

                            <a href='product_details.php?pid=<?php echo $pro_id;?>' class='btn btn-primary'>More
                                Details</a>

                            <?php
								if($pro_avail == 'In Stock'){
									echo"<a href='product_details.php?&action=add&pid= $pro_id' class='btn btn-primary' style='background-color:#222222'>Add To Cart</a>";
								}else{
									echo"<a href='#' class='btn btn-primary' style='background-color:white; color:red;'>Out of Stock</a>";
											
                                }
										
                            ?>


                        </div>
                    </div>
                </div>

                <?php	
						}							
					?>

            </div>
        </div>
    </div>



    <?php include('includes/footer.php')?>

    <!--Scripts -->
    <?php include('includes/scripts.php')?>


</body>

</html>