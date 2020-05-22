<?php include "header.php"; ?>
<?php 
	session_start();
	if(!isset($_SESSION["success"])){
    header("location: index.php");
}
	$_SESSION["session"] = session_id();
?>
	<div class="container-fluid">
		<div class="row">


	
		
			<div class="col-md-9 mt-3">
				<h2 class="mb-5">My Cart</h2>

				<?php 

			include "connectdb.php";
			$session = $_SESSION["session"];
			$display="SELECT * FROM cart WHERE session = '".$session."'";
			$checktable = mysqli_query($conn,$display);
			$flag = false;
			if($checktable->num_rows > 0){
				$flag = true;
			}
?>

	<?php if ($flag = true): ?>
		<?php while($row = $checktable->fetch_assoc()): ?>
	 		<?php 
	 			$brand = $row['brand'];
	 			$model = $row['model'];
	 			$price = $row['price'];
	 			$quantity = $row['quantity'];
	 		 ?>

<div class="card mb-3 bg-secondary">
  <div class="card-body">
<div class="card-deck">
  	<div class="card">
  <div class="card-body">
  	<?php echo "Brand: ".$brand; ?>
  </div>
</div>

	<div class="card">
  <div class="card-body">
  	 	<?php echo "Model: ".$model; ?>
  </div>
</div>

	<div class="card">
  <div class="card-body">
  	
  	<?php echo "Quantity: "; ?>
  	<form action="" method="post"> 
	  	<input type="number" name="qty" class="w-25" value="<?php echo $quantity ?>">
	  	<input type="hidden" name="mod"	value="<?php echo $model; ?>">
	  	<input type="hidden" name="prc"	value="<?php echo $price; ?>">
	  	<input type="submit" name="update" class="btn btn-primary" value="Update">
	</form>
  	
  </div>
</div>

	<div class="card">
  <div class="card-body">
  	<?php echo "Price: <strong style=\"color: green\">₱".$price."</strong>"; ?>
  </div>
</div>
  	</div>
 
  	
  		
  	</div>
</div>

<?php endwhile; ?>
	<?php endif; ?>


<?php if(isset($_POST["update"])){
	include "connectdb.php";
	$prc = $_POST["prc"];
	$qty = $_POST["qty"];
	$mod = $_POST["mod"];
	
	$sql = "UPDATE cart SET total = $prc*$qty, quantity = $qty WHERE model = '$mod'";

	if (mysqli_query($conn,$sql)) {
            header("Location: cart.php");


            
         } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
} ?>

			</div>


			<div class="col-md-3">
				<div class="card mt-5">
				  <div class="card-header"><strong>Order Total:</strong></div>

				  <?php 
				  	include "connectdb.php";
				  	$tot = "SELECT SUM(total) FROM cart WHERE session = '".$session."'";
				  	$result = mysqli_query($conn,$tot);
				  	if ($result->num_rows > 0) {
                                       $row = $result->fetch_assoc();
                                        $total = $row['SUM(total)'];     
                                    } 

				  ?>
				  <div class="card-body"><h1><strong style="color: green">₱ <?php echo $total; ?></strong></h1></div>
				  
				</div>
			</div>




		</div>
	</div>
<?php include "footer.php"; ?>