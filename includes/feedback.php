
<?php
session_start();
include("config.php");
if(isset($_POST['savert'])){

	$name=$_POST['name'];
	$ratting=$_POST['rating'];
	$rv=$_POST['rv'];
	$pid=$_POST['pid'];

	$ins="INSERT INTO ratting SET name='$name',ratting='$ratting',review='$rv',pid='$pid'";
	$con->query($ins);

	?>
	<script >
		alert("Your review is in under modaration");
		window.location='../product_details.php?pid=<?php echo $pid ?>';
	</script>
		
	<?php
header('../product-details.php?id=<?php echo $pid ?>');
}
?>