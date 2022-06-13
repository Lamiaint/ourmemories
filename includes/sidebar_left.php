
<div class="column left-side"> 
    <div class="person-info">
        <form action="" method="post"> 
        <?php

            $userResults = "SELECT u.username,u.user_image,ui.info_image,ui.user_info_content,u.user_id FROM users u,user_info ui Where ui.user_id = u.user_id and ui.user_name = 'Lamiaint' ";
            $select_users = mysqli_query($conn, $userResults);
            if ($user_row = mysqli_fetch_assoc($select_users)) {
                $username = $user_row["username"];
                $user_image = $user_row["user_image"];
                $user_info = $user_row["user_info_content"];
                echo "<div class='card-header'><h4 class='card-text'>{$username}</h4></div>";
                // echo "<td><img class='card-img-top' width='50' src='images/$user_image' alt='Card image'></td>";
                echo "<div class='image'> <img class='image' weidth='50' src='images/$user_image' alt='im'></div>";
                echo "<div class='card-body'><h4 class='text-danger'>{$user_info}</h4></div>";
            } 
       
        ?>
        <!-- /.row --> 
        </form> 
    </div> 


    <div class="w3-bar-block">
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CONTACT</a>
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
 


