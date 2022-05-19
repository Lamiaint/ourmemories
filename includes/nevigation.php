<?php  include "db.php";  ?>
<?php  session_start();  ?>


<div class="topnav">
  
  <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
    <div class="nav-m">
                <ul class="nav navbar-nav">
                <a class="navbar-brand" href="index.php"> 首页 </a> 
                     <li> 
                    <?php
                         $conn = getConnection();
                         $qeury = "select * from categories";
                         $qeuryResults = mysqli_query($conn,$qeury); 

                    while($qeuryResultsRow = mysqli_fetch_assoc($qeuryResults)){
                       
                    $cat_title = $qeuryResultsRow["title"];
                    $cat_id = $qeuryResultsRow["id"];
                    if(!empty($cat_title) && !empty($cat_id ) ){
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title }</a></li>"; 
                    }
                                      
                    }
                    ?>                    
                     </li> 

                    <!-- 用户角色登陆后权限 -->
                    <?PHP
                //     if (isset($_SESSION['username'])) {
                //         $login_username = $_SESSION['username'];
                //         $user_role = $_SESSION['user_role'];
                        
                //         $password = $_SESSION['password'];
                //             $login_userResults = "SELECT * FROM users Where username= '{$login_username}' AND user_password = '{$password}' ";
                //             $select_login_user = mysqli_query($conn, $login_userResults);
                //             while ($login_user_row = mysqli_fetch_assoc($select_login_user)) {
                //                 $user_role = $login_user_row['user_role'];
                //                 if( $user_role =="admin"){
                //                     echo"<li> <a href='admin'> Admin </a> </li>";  
                //                 }else{
                //                     // echo"<li> <a onClick=\" javascript: return confirm('非管理员权限');\" href='index.php'> Admin </a> </li>";                
                //                     echo"<li> <a href='admin'> Admin </a> </li>";  
                //                 }  
                //         }
                //    }
                    ?>
                                
                    <li> <a href="registration.php"> Registration </a> </li>
                    <li> <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>

                    
            <!-- 首页添加POST 128522--> 
            <button type="button" class="ad-post"> <a href="posts_index.php?source=add_post_index"> Add Post&#128522 </a></button>
                </ul>

    </div>

            
                <div class="login-container">
                <form action="./includes/login.php" method="POST">
                <input type="text" placeholder="Username" name="username">
                <input type="text" placeholder="Password" name="password">
                <button type="submit" name="login" >Login</button>
                </form>
                </div>
 
 


</div>


  

    
 