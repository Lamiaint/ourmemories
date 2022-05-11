<div class="col-md-4">
<!-- 首页添加POST --> 
<button type="button" class="btn btn-outline-primary"> <a href="add_posts_index.php?source=add_post_index">Add Post</a></button>   
 
    <?php 
    if(isset($_POST['submit'])){
    //sibar search 
     $conn = getConnection();
     $seachInfo = $_POST['search'];
     $results = "SELECT * FROM posts where post_tag like '%$seachInfo%'"; 
     $queryResults = mysqli_query($conn,$results);
     if(!$queryResults){
         die("failed to queryDatas".mysqli_error($conn));
        }else{
         $rowNumber = mysqli_num_rows($queryResults);
         if($rowNumber==0){

        $queryPostTitle = "SELECT * FROM posts WHERE post_title like '%$seachInfo%' ";//按题目查找 
        $queryPostResults = mysqli_query($conn,$queryPostTitle);
        while ($row =mysqli_fetch_assoc($queryPostResults)) {
            $post_title= $row["post_title"];
            $post_author= $row["post_author"];
            $post_date= $row["post_date"];
            $post_content= $row["post_content"];
            $post_image= $row["post_image"]; 

             ?>
     
        <h2>
             <a href="#"><?php echo $post_title ?> </a>
        </h2>
        <p class="lead">
             by <a href="index.php"> <?php echo $post_author ?> </a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> <?php $post_date ?> </p>
        <hr>
             <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
        <hr>
              <p>  <?php echo $post_content ?> </p>
        <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->
        <hr>
         <?php  } 
        //blog title end  index.php
                 }
            } 
    }?>

        
<!--Sidebar User Info -->
<div class="card">    
        <form action="" method="post"> 
        <?php
        if(isset($_SESSION['username'])){   
            $name = $_SESSION['username'];
                $userResults = "SELECT * FROM users u Where u.username= '{$name}'";
                $select_users = mysqli_query($conn, $userResults);
                if ($user_row = mysqli_fetch_assoc($select_users)) {
                    $username = $user_row["username"];
                    $user_image = $user_row["user_image"];
                    echo "<div class='card-header'><h4 class='card-text'>{$username}</h4></div>";
                    // echo "<td><img class='card-img-top' width='50' src='images/$user_image' alt='Card image'></td>"; 
                    echo "<p class='card-text'> <something class=''></something></p>";           
                }                                   
            }else{  
                $userResults = "SELECT ui.user_name,u.user_image,ui.user_info FROM user_information ui,users u Where ui.user_name=u.username AND ui.user_name= 'Lamiaint' ";
                $select_users = mysqli_query($conn, $userResults);
                if ($user_row = mysqli_fetch_assoc($select_users)) {
                    $user_name = $user_row["user_name"];
                    $user_info = $user_row["user_info"];
                    $user_image = $user_row["user_image"];
                    //rounded-circle 类将图像塑造为圆形：
                    echo "<div class='card-header'><h4 class='card-text'>{$user_name}</h4></div>";
                    echo "<p><img class='rounded-circle' width='80' src='images/$user_image' alt='Cinque Terre'></p>"; 
                    echo "<div class='card-body'><h4 class='text-danger'>{$user_info}</h4></div>";
                
                }
            }
        ?>
        <!-- /.row -->
         
        </form> 
    </div>


    <div class="well">
        <h4>Login</h4>
        <!-- <td><a onClick=\" javascript: return confirm('用户名或密码错误');\" href='posts.php?delete={$post_id}'>Login</a></td>"; -->
          
        <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="username" type="text" placeholder="enter username" class="form-control">      
        </div>
        <div class="input-group">
        <input name="password" type="password" placeholder="enter password" class="form-control">          
        <span>
            <button class="btn btn-primary" name="login" type="submit">登陆</button>
        </span>
        
        </div>
       </form> 

    </div>

               <!-- Add sidebar Comments -->
               <?php  
        if ($_SERVER['REQUEST_METHOD'] ==='POST') {
            if (isset($_POST["add_comment"])) {
            $comment_user= $_POST["comment_username"];
            $comment_content= $_POST["comment_content"];

                    if (!empty($comment_user) && !empty($comment_content)) {
                    $query = "INSERT INTO sidebar_comments (                   
                    comment_username,comment_content,comment_date ) ";
                    $query .= "VALUE('{$comment_user}','{$comment_content}',now() )";
                    $create_comments_query = mysqli_query($conn, $query);
                        if (!$create_comments_query) {
                        die("query failed to insert ".mysqli_error($conn));
                        } 
                    } else {
                    // echo "<script> alert('Fields cant not be empty!') </script>";
                    }
            }
           
             //redirect(location:"/ourmemories/post.php?p_id=$the_post_id");
       }  
              
?>


<div class="well">
        <h4>Info Search</h4>
        <form action="" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
       </form>          
    </div>
    
        <!-- sidebar comments-->  
        <div class="well">
            <h4>Leave a Comment:</h4> 
            <form action="" method="post" role="form">
                <div class="form-group">
                    <label for="comment_username">Author</label>
                    <input name="comment_username" type="text" class="form-control" placeholder='Enter Your Username' >
                </div>

                <div class="form-group">
                    <label for="Comment">Comment</label>
                    <textarea name="comment_content" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" name="add_comment" class="btn btn-primary">提交留言</button>
            </form>
        </div>
        <!-- sidebar comments -->



        <!-- display sidebar Comments -->
        <span>留言区:</span> 
        <?php
                   $query = "SELECT * FROM sidebar_comments ";
                   $query .= "ORDER BY comment_id DESC";

                    $select_comment_query = mysqli_query($conn,$query);
                    if(!$select_comment_query){
                        die("Query Failed".mysqli_error($conn));              
                    }

                    while ($row = mysqli_fetch_array($select_comment_query)) {
                        $comment_username = $row["comment_username"];
                        $comment_date = $row["comment_date"];
                        $comment_content = $row["comment_content"];

                        ?>
                        
                        <!-- siebar Comment  class="media" -->
                        <div div id="block-6" class="widget widget_block">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">  
                                
                                 <h4 class="media-heading" > <?php echo $comment_username; ?> </h4>
                                 <div>
                                 <?php echo $comment_content; ?> 
                                 </div>
                                  <td><span class="glyphicon glyphicon-time"></span> <?php echo $comment_date; ?> </td>
                            </div>
                        </div>        
              <?php  }?>
    
     
    <?php   include "widget.php";?>

    <!-- <div id="block-6" class="widget widget_block">
    <figure class="wp-block-embed is-type-rich is-provider-twitter wp-block-embed-twitter">
            <div class="wp-block-embed__wrapper">
          <a class="twitter-timeline" data-width="1140" data-height="1000" 
        data-dnt="true" href="https://twitter.com/DavidHuSG1?ref_src=twsrc%5Etfw">Tweets by  name </a>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> -->
        </div>
    </figure>
</div>

</div>
	</aside>

</div> 

<!-- 
</div>
</div> -->
