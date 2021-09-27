<?php
	//  session_start();
	// include("includes/config.php");
?>

<header>
	<div class="header-top-bar">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-8">
					<ul class="top-bar-info list-inline-item pl-0 mb-0">

						<?php if(strlen($_SESSION['login']))
							{
						?>
						<li class="list-inline-item">
							<!-- User Name Will be shown here -->
							| Welcome - <?php echo $_SESSION['name']?>
						</li>
						<?php } ?>
						<!-- <li class="list-inline-item">
							| <a href="../mycart.php"><i class="icofont-cart"></i> My cart</a>
						</li>
						<li class="list-inline-item">
							| <a href="../wishlist.php"> <i class="icofont-heart"></i> Wishlist</a>
						</li> -->
						<?php if(strlen($_SESSION['login'])==0) 
							{   ?>
						<li class="list-inline-item">
							| <a href="login.php"><i class="icofont-login"></i> Login</a>
						</li>
						<li class="list-inline-item">
							| <a href="signup.php"><i class="icofont-sign-in"></i> Sign Up </a>
						</li>
						<?php }
							else{ ?>
						<li class="list-inline-item">
							| <a href="my-account.php"><i class="icofont-user"></i> My Account
							</a>
						</li>
						<li class="list-inline-item">
							| <a href="logout.php"><i class="icofont-logout"></i> Logout </a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg" id="navbar">
		<div class="container">
			<a class="navbar-brand" href="../index.php">
				<h1><span style="color:#E12454">E</span> MED | Doctors</h1>
			</a>
			
			

			<div class="navbar">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Home</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
					<!-- <li class="nav-item"><a class="nav-link" href="prescription.php">Upload Prescription</a></li> -->
					<!-- <li class="nav-item"><a class="nav-link" href="#">Buy Prescription</a></li> -->
					<!-- <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>		  -->
					<li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
				</ul>
			</div>

			<!-- <form class="form-inline" name="search" method="post" action="product_search.php">
					<input class="form-control mr-sm-2" type="search" name="medicine" placeholder="Search"
						aria-label="Search">
					<button class="btn btn-outline-primary my-2 my-sm-0 sr" type="submit">
						<i class="icofont icofont-search"></i>
					</button>
			</form>	 -->
		</div>
	</nav>
</header>