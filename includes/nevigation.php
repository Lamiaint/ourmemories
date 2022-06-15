<?php  include "db.php";  ?>
<?php  session_start();  ?>



<div class="topnav">
  
  <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
    <div class='nav-m'>
                
         <a href="index.php" class="w3-margin-right">  首页 </a> 
                    
                    <?php
                         $conn = getConnection();
                         $qeury = "select * from categories";
                         $qeuryResults = mysqli_query($conn,$qeury); 

                    while($qeuryResultsRow = mysqli_fetch_assoc($qeuryResults)){
                       
                    $cat_title = $qeuryResultsRow["title"];
                    $cat_id = $qeuryResultsRow["id"];
                    if(!empty($cat_title) && !empty($cat_id ) ){
                       
                        // echo "<a href='category.php?category=$cat_id'>{$cat_title }</a>";
                        echo "   <a class='w3-margin-right' href='category.php?category=$cat_id'>{$cat_title } </a>  ";
                        
                    }
                                      
                    }
                    ?>                    
               

                    <!-- 首页添加POST 128522--> 
                     <a class='w3-margin-right' href="posts_index.php?source=add_post_index"> Add Post&#128522 </a>        
                     <a class='w3-margin-right' href="registeration.php">  Registeration </a>   
                     <a class='w3-margin-right' href="./includes/logout.php"> Log Out </a>  


                <div class="login-container" >  
                    <form action="includes/login.php" method="POST" > 
                        <input type="text" placeholder="Username" name="username" id="username">
                        <input type="password" placeholder="Password" name="password" id="password">
                        <button type="submit" name="login" >Login</button>
                    </form>
                </div>
               
    </div>

               

                 <!-- <section class="signup-form" > 
                    <div class="login.inc.php" method="post"> 
                    <form action="./includes/login.php" method="POST" > 
                        <input type="text" placeholder="Username" name="username" id="username">
                        <input type="password" placeholder="Password" name="password" id="password">
                        <button type="submit" name="login" >Log In</button>
                    </form>
                    </div>
                 </section> -->
                



</div>



 