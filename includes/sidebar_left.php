
<div class="column left-side"> 
    <div class="person-info">
        <form action="" method="post"> 
        <?php
        if(isset($_SESSION['username'])){   
            $name = $_SESSION['username'];
                $userResults = "SELECT u.username,u.user_image,ui.user_info FROM user_information ui,users u Where u.username= '{$name}' ";
                $select_users = mysqli_query($conn, $userResults);
                if($user_row = mysqli_fetch_assoc($select_users)){
                    $username = $user_row["username"];
                    $user_image = $user_row["user_image"];
                    $user_info = $user_row["user_info"];
                    echo "<div class='card-header'><h4 class='card-text'> Welcome: {$username}</h4></div>";
                    // echo "<td><img class='card-img-top' width='50' src='images/$user_image' alt='Card image'></td>"; 
                    // echo "<div class='image'> <img class='image' weidth='50' src='images/$user_image' alt='im'></div>";    
                    // echo "<div class='card-body'><h4 class='text-danger'>{$user_info}</h4></div>";       
                }                                   
            }else{  
                $userResults = "SELECT ui.user_name,u.user_image,ui.user_info FROM user_information ui,users u Where ui.user_name=u.username AND ui.user_name= 'Lamiaint' ";
                $select_users = mysqli_query($conn, $userResults);
                if($user_row = mysqli_fetch_assoc($select_users)){
                    $user_name = $user_row["user_name"];
                    $user_info = $user_row["user_info"];
                    $user_image = $user_row["user_image"];

                    echo "<div class='image'> <img class='image' src='images/$user_image' alt='im'></div>"; 
                    echo "<div class='card-header'><h3 class='card-text'>{$user_name}</h3></div>";
                   // echo "<div class='card-body'><h4 class='text-danger'>{$user_info}</h4></div>";
                }
            }
        ?>
        <!-- /.row --> 
        </form> 
    </div> 


  
    
    <div class="sidebar-links">
        <h4 class="mt-4">Some Links</h4>
        <!-- <p>Lorem ipsum dolor sit ame.</p> -->
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
            <a class="nav-link" href="https://www.w3schools.com/">w3c</a>
            <a class="nav-link" href="https://codepen.io/">codepen</a>
          
            </li>
        </ul>
      </div> 



 </div>   
 


