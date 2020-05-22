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
		<div class="col-md-4">
			<div class="card mt-5">
                <h5 class="card-header">Add Product</h5>
                <div class="card-body">
                    <h5 class="card-title text-center">Fill in the Information</h5>
                    	<form action="" class="text-center" method="post">
                        <div class="form-group">
                            <input type="text" name="brand" placeholder="Brand" class="w-100" required autoFocus/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="model" placeholder="Model" class="w-100" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="quantity" placeholder="Quantity" class="w-100" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="price" placeholder="Price" class="w-100" required/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" name="addProduct">Add Product</button>
                            
                        </div>
                        
                    </form>
                    </div>
            </div>
		</div>	


<?php
	
	if(isset($_POST["addProduct"])){ 
	include "connectdb.php";
	$br = $_POST["brand"];
	$md = $_POST["model"];
	$qt = $_POST["quantity"];
	$pr = $_POST["price"];

	$add = "INSERT INTO shoes(session,brand,model,price,quantity) VALUES ('".$_SESSION['session']."','".$br."','".$md."','".$pr."','".$qt."')";
	if (mysqli_query($conn,$add)) {
            header("Location: products.php");


            
         } else {
               echo "Error: " . $add . "" . mysqli_error($conn);
            }


}


 ?>


<div class="col-md-8">
			
	<h2 class="text-center">My Products</h2>		
				 
 <?php 

			include "connectdb.php";
			$session = $_SESSION["session"];
			$display="SELECT * FROM shoes WHERE session = '".$session."'";
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
  	<?php echo "Quantity: ".$quantity; ?>
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
  		</div>
  

		</div>
	</div>
</div>
<?php include "footer.php"; ?>


