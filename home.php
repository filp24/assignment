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
		<div class="col-md-12 p-0 ">

	<?php 
		include "connectdb.php";
		$display="SELECT * FROM shoes";
		$checktable = mysqli_query($conn,$display);
		$flag = false;
		if($checktable->num_rows > 0){
			$flag = true;
		}
?>
		<?php if ($flag = true): ?>
					<?php while($row = $checktable->fetch_assoc()): ?>
						<?php 
							$price = $row['price'];
							$name = $row['model'];
							$id = $row['shoeId'];
							$brand = $row['brand'];
						 ?>
					<!--	<div class="card m-5 text-center" style="width: 18rem ">
			            	<img class="card-img-top" src="images/zoom.jpg" alt="Card image cap"/>
			                	<div class="card-body" style="display: inline-block;">
			                		
			                    	<h5 class="card-title"><?php echo $name; ?></h5>
			                        	<p class="card-text"><strong style="color: green;">₱ <?php echo $price; ?></strong></p>
			                        	<form action="" method="post">
				                        	<input type="hidden" name="info" value="<?php echo $id; ?>">
				                        	<input type="hidden" name="brand" value="<?php echo $brand; ?>">
				                        	<input type="hidden" name="model" value="<?php echo $name; ?>">
				                        	<input type="hidden" name="price" value="<?php echo $price; ?>">
				                    			<button 
				                    				class="btn btn-primary btn-block" 
				                    				type="submit"
				                    				name="add"
				                    				>Add to Cart</button>
			                    		</form>
			                    		</div>
			                	</div> -->

			     <div class="card m-5 bg-light" style="width: 20rem; text-align:center;display:inline-block;">
				  	<img class="card-img-top" src="images/zoom.jpg" alt="Card image cap" height="200" width="200">
				  		<div class="card-block">
				    	<h4 class="card-title"><?php echo $name; ?></h4>
				    	<p class="card-text"><strong style="color: green;">₱ <?php echo $price; ?></strong></p>
				    	<form action="" method="post">
				            <input type="hidden" name="info" value="<?php echo $id; ?>">
				            <input type="hidden" name="brand" value="<?php echo $brand; ?>">
				            <input type="hidden" name="model" value="<?php echo $name; ?>">
				            <input type="hidden" name="price" value="<?php echo $price; ?>">
				            <button class="btn btn-primary btn-block" type="submit" name="add">Add to Cart</button>
			            </form>
				  </div>
				</div>
        	
		<?php endwhile; ?>
	<?php endif; ?>
  			

	<?php 
		if(isset($_POST["add"])){
			$info = $_POST['info'];
			$brand = $_POST['brand'];
			$model = $_POST['model'];
			$price = $_POST['price'];
			$quantity = "1";
			$total = $quantity * $price;

			include "connectdb.php";
			$cart = "INSERT INTO cart(session,brand,model,price,quantity,total) VALUES ('".$_SESSION['session']."','".$brand."','".$model."','".$price."',$quantity,$total)";
			//$checkCart = mysqli_query($conn,$cart);
			if (mysqli_query($conn,$cart)) {
            header("Location: cart.php");


            
         } else {
               echo "Error: " . $cart . "" . mysqli_error($conn);
            }

			
		}

	 ?>
			



        </div>
    </div>
</div>

<?php include "footer.php"; ?>