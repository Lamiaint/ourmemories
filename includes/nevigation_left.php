<?php  include "db.php";  ?>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>

        <?php

if (isset($_GET['category'])) {

    $conn = getConnection();
    
    $category_id = escape($_GET['category']);
    
    $userResults = "SELECT c.id,c.title,ui.user_name,ui.user_info_content,ui.info_image FROM categories c,user_info ui WHERE c.id = ui.category_id AND c.id = {$category_id} ";
 
    $select_users = mysqli_query($conn, $userResults);
    if ($user_row = mysqli_fetch_assoc($select_users)) {
        $user_image = $user_row["info_image"];
        $category_title = $user_row["title"];
        $user_info = $user_row["user_info_content"];
               

        echo "<img class='image' src='images/$user_image' style='width:45%;' class='w3-round'>";
        echo "<h4 class='card-text'>{$category_title}</h4>";
        echo "<p class='w3-text-grey'>{$user_info}</p>";
    } ?>
        </div>

  


          <!-- Add sidebar-left Category Comments -->
          <?php

            if ($_SERVER['REQUEST_METHOD'] ==='POST') {
                if (isset($_POST["add_category_comment"])) {
                    $comment_user= escape($_POST["comment_username"]);
                    if (empty($comment_user)) {
                        $comment_user ="guest";
                    }
                        $comment_content= escape($_POST["comment_content"]);
                        if (!empty($comment_content)) {
                            $query = "INSERT INTO category_comments (                   
                                    comment_username,category_id,comment_content,comment_date ) ";
                            $query .= "VALUE('{$comment_user}','{$category_id}','{$comment_content}',now() )";
                            $create_comments_query = mysqli_query($conn, $query);
                            if (!$create_comments_query) {
                                die("query failed to insert ".mysqli_error($conn));
                            }
                        }
                }
            }
   
        
   
?>  




<div class="w3-bar-block">
    <a href="#portfolio" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>PORTFOLIO</a> 
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>ABOUT</a> 
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CONTACT</a>
  </div>



          <!--form Category comments-->  
          <div class="w3-padding">
            <h4>请留言:</h4> 
            <form action="" method="post" role="form">
                <div class="form-group">
                    <label for="comment_username">用户名</label>
                    <input name="comment_username" type="text" class="form-control" placeholder='Enter Your Username' >
                </div>
            <div class="form-group">
                <label for="Comment">内容</label>
                <textarea id="e_comments" name="comment_content" class="form-control" rows="5" placeholder='Say Something'></textarea>
            </div>
                <button type="submit" name="add_category_comment" class="btn btn-primary">提交留言</button>
            </form>
        </div>

    <?php
        // display category comment
    $query = "SELECT c.*,cc.* FROM categories c,category_comments cc WHERE c.id = cc.category_id AND c.id = $category_id ";
    $query .= "ORDER BY c.id DESC";
    $select_comment_query = mysqli_query($conn, $query);
    if (!$select_comment_query) {
        die("Query Failed".mysqli_error($conn));
    }
        while ($row = mysqli_fetch_array($select_comment_query)) {
            $category_title = $row["title"];
            $comment_date = $row["comment_date"];
            $comment_content = $row["comment_content"]; 
            ?>
                <div class="media-content">     
                    <h4> <?php echo $comment_content; ?>  </h4>
                </div>
                <td><span class="glyphicon glyphicon-time"></span> <?php echo $comment_date; ?> </td>
            <?php
        }



} ?>

</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

          
 