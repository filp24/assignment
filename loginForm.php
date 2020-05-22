<div class="card">
                <h5 class="card-header">Welcome to Shoepy!</h5>
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <form action="" class="text-center" method="post">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="E-mail Address" class="w-100" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="w-100" required/>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary btn-block" name="login">Log in</button>
                        </div>
                            <a href="signup.php">Create an Account</a>
                    </form>
                   
                </div>
            </div>


<?php 
    if(isset($_POST["login"])){
        include "connectdb.php";

        $em = trim($_POST["email"]);
        $pw = trim($_POST["password"]);

        $log = "SELECT * FROM accounts WHERE email = '$em' AND password = '$pw'";
        $res = mysqli_query($conn,$log);
        
        $success = false;
        while($row = mysqli_fetch_array($res)) {
            $success = true;
             }

         if ($success == true) {
            session_start();
           $_SESSION['success'] = true;
           header('location: home.php');
         }
         
         else{
          echo '<div class="alert alert-danger">Oops! It looks like your username and/or password are incorrect. Please try again.</div>';
          
         }
        }
            
 ?>