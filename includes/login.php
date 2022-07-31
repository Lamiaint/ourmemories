<?php  session_start();  ?>
<?php include "db.php";  ?>
<?php  include "../admin/functions.php"; ?>

                    <!-- login  form -->
                    <div class="login-container">

                    <?php  if(isset($_SESSION['user_role'])):   ?>
                    <h5> Logged in as <?php echo $_SESSION['username'] ?></h5>
                    <?php  else:   ?>

                    <form class="login-form" method="POST" action="login.php">
                     
                    <input type="text" class="text"  name="username" placeholder="Enter Username" required>
                    <br> 
                    <br>

                    <input type="password" class="text"  name="password" placeholder="Enter Password" required>
                    <br> 
                    <br> 
     
                    <button type="submit" name="Login">Login</button>
                    </form>

                    <?php  endif;   ?>

                    </div>

<!-- .. -->


 






<!-- .. -->











 
  
    



<?php 
 $conn = getConnection();
    if(isset($_POST['Login'])){
             
        $Name = trim($_POST['username']);
        $Password = trim($_POST['password']);
        login_user( $Name ,$Password);
}
       
    ?>


  
<?php // ob_end_flush(); //this should be last line of your page ?>
 


 







 