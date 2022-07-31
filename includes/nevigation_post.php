<?php  include "db.php";  ?>
<?php  ob_start();  ?>
<?php  session_start();  ?>

<div class="topnav">
    <div class='nav-m'>
        <!-- <ul class='nav navbar-nav'>  -->
          <a href="index.php" class='w3-margin-right' >  首页 </a>  
  
                    <?php
                         $conn = getConnection();
                         $qeury = "select * from categories";
                         $qeuryResults = mysqli_query($conn,$qeury); 
  
                    while($qeuryResultsRow = mysqli_fetch_assoc($qeuryResults)){
                       
                    $cat_title = $qeuryResultsRow["title"];
                    $cat_id = $qeuryResultsRow["id"];

                    if(!empty($cat_title) && !empty($cat_id ) ){
                        echo "<a class='w3-margin-right' href='category.php?category=$cat_id'>{$cat_title }</a>";
                    }                                     
                    }
                    ?>     
                    
                    <?php  if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'):   ?>
                    <!-- 首页添加POST 128522 "--> 
                      <a class='w3-margin-right' target='_blank' href='posts_index.php?source=add_post_index'> Add Post&#128522 </a>  
                      <a class='w3-margin-right' href='./admin'> Admin </a>  
                      <a class='w3-margin-right' href="./includes/logout.php"> Log Out </a>  
                    <?php  endif;   ?>

                  <!-- login   -->
                  <div class="login-container w3-right">
                     <?php  if(isset($_SESSION['user_role'])):   ?>
                      <h5> <?php echo $_SESSION['username'] ?></h5>
                    <?php  endif;   ?>
                  </div>
 
    </div>                      

    
</div>



 