<?php  include "db.php";  ?>
<?php  ob_start();  ?>
<?php  session_start();  ?>


<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
        <div class="navbar-header">
          <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> -->
            <!-- <span class="icon-bar">   </span>   -->
            <!-- </button> -->   
            <!-- 'navbar-brand'                               -->
          <!-- <a class="navbar-brand" href="#">Me</a> -->
          <a class='navbar-brand' href="index.php" >  首页 </a>  
          <?php
          $conn = getConnection();
          $qeury = "select * from categories";
          $qeuryResults = mysqli_query($conn,$qeury); 
          while($qeuryResultsRow = mysqli_fetch_assoc($qeuryResults)){ 
          $cat_title = $qeuryResultsRow["title"];
          $cat_id = $qeuryResultsRow["id"];
          if(!empty($cat_title) && !empty($cat_id ) ){
              echo "<a class='navbar-brand' href='category.php?category=$cat_id'>{$cat_title }</a>";
          }                                     
          }
          
          ?>  
          <a class='navbar-brand' href="includes/login.php"> LogIn </a>   
          <?php  if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'):   ?>
          <a class='navbar-brand' href='./admin'> Admin </a>
           <!-- 首页添加POST 128522 "--> 
           <a class='navbar-brand' target='_blank' href='posts_index.php?source=add_post_index'>Publish&#128522 </a> 
          <?php  endif;   ?> 

           <a class='navbar-brand' href="registeration.php"> SignUp </a>
           <a class='navbar-brand' href="./includes/logout.php"> LogOut </a>
          
                  <!-- login  
                  <div class="login-container w3-right">
                   <?php  //if(isset($_SESSION['user_role'])):   ?>
                    <h5> Logged in as <?php// echo $_SESSION['username'] ?></h5>
                    <?php // else:   ?>
                    <form method="POST" action="./includes/login.php">
                    <input type="text" placeholder="Enter Username" name="uname" required>
                    <input type="password" placeholder="Enter Password" name="psw" required>
                    <button type="submit" name="Login">Login</button>
                    </form>
                    <?php  //endif;   ?>
                    </div> -->
        </div>

               

    <!-- <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">WHO</a></li>
        <li><a href="#">WHAT</a></li>
        <li><a href="#">WHERE</a></li>
      </ul>
    </div> -->
  </div>
</nav>


 


 
 



 