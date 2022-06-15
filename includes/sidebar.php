<div class="column right-side">
      

            <!-- <div class="well">
                <h4>Login</h4> 
                <form action="./includes/login.php" method="POST">
                    <div class="form-group">
                        <input name="username" type="text" placeholder="enter username" class="form-control">      
                    </div>

                    <div class="input-group">
                    <input name="password" type="password" placeholder="enter password" class="form-control">          
                    <span><button class="btn btn-primary" name="login" type="submit">登陆</button></span>
                    </div>
                </form>  
            </div> -->

               <!-- Add sidebar Comments -->
               <?php  
        if ($_SERVER['REQUEST_METHOD'] ==='POST') {
            if (isset($_POST["add_comment"])) {
            $comment_user= escape($_POST["comment_username"]);
                if(empty($comment_user)){
                    $comment_user ="guest";
                }
            $comment_content= escape($_POST["comment_content"]);
                    if (!empty($comment_content)) {
                    $query = "INSERT INTO sidebar_comments (                   
                    comment_username,comment_content,comment_date ) ";
                    $query .= "VALUE('{$comment_user}','{$comment_content}',now() )";
                    $create_comments_query = mysqli_query($conn, $query);
                        if (!$create_comments_query) {
                        die("query failed to insert ".mysqli_error($conn));
                        } 
                      }
                  //  redirect("Location:../index.php");
            }          
             //redirect(location:"/ourmemories/post.php?p_id=$the_post_id");
       }  
              ?>

 
        <div class="well" >
            <form action="" method="post">
                <div class="input-group">
                    <input name="search" type="text" class="form-control" placeholder='查找...'>
                    <span class="input-group-btn">
                        <button name="search" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search">Search</span>
                        </button>
                    </span>
                </div>
            </form>          
        </div>


        <div class="info-d">  
            <?php 
            //sibar search <h5>Search Results</h5>
            if(isset($_POST['search'])){
                $seachInfo =  $_POST['search'];
            $results = "SELECT * FROM posts where post_tag like '%$seachInfo%' "; 
            $queryResults = mysqli_query($conn,$results);
                
                if(!$queryResults){
                    die("failed to queryDatas".mysqli_error($conn));
                }else{
                    $rowNumber = mysqli_num_rows($queryResults);
                    
                    if ( $rowNumber !==0 ) {
                        //ORDER BY post_title DESC LIMIT 5 
                        $queryPostTitle = "SELECT * FROM posts WHERE post_title like '%$seachInfo%' LIMIT 6 ";//按题目查找
                        $queryPostResults = mysqli_query($conn, $queryPostTitle);
                        while ($row =mysqli_fetch_array($queryPostResults)) { 

                        $post_title = $row["post_title"];
                        $post_id    = $row["post_id"];
                        $post_author= $row["post_author"];
                        $post_date  = $row["post_date"];  
                            ?>
                        <li> 
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?> </a>
                        <!-- by <a href="post.php?p_id=<?php //echo $post_id; ?>"> <?php //echo $post_author ?> </a> -->
                        <span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> 
                        </li>
                    <?php
                        }
                    }
                } 
            }
            ?>
        </div>

         
        <p> </p>
        <!-- sidebar comments-->  
        <div class="well">
            Leave a Comment:
            <form action="" method="post" role="form">
                <div class="form-group">
                    <label for="comment_username">Author</label>
                    <input name="comment_username" type="text" class="form-control" placeholder='Enter Your Username' >
                </div>
            <div class="form-group">
                <label for="Comment">Comment</label>
                <textarea id="e_comments" name="comment_content" class="form-control" rows="5"></textarea>
            </div>
                <button type="submit" name="add_comment" class="btn btn-primary">提交留言</button>
            </form>
        </div>
        <!-- sidebar comments -->

            <!-- display sidebar Comments -->
            <div class="sidebar-color" id="block-6" >
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
                            <!-- <div id="block-6" class="widget widget_block"> -->
                                <!-- <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a> -->
                                <div class="media-content">     
                                     <?php echo $comment_content; ?>  
                                </div>
                                <?php echo $comment_username; ?>
                                <td><span class="glyphicon glyphicon-time"></span> <?php echo $comment_date; ?> </td>
                            <!-- </div>         -->
                <?php  }?>
            </div>
  
</div>
<!-- </aside> -->
 
