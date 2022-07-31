<div class="column right-side">

               <!-- Add sidebar Comments -->
               <?php  
        if ($_SERVER['REQUEST_METHOD'] ==='POST') {
            if (isset($_POST["add_comment"])) {
                $the_post_id = $_GET["p_id"];
                $comment_content= escape($_POST["comment_content"]);
                if(empty($comment_user)){
                    $comment_user ="guest";
                }
            
                    if (!empty($comment_content)) {
                    $query = "INSERT INTO comments (comment_post_id,comment_author,comment_content,comment_date) ";
                    $query .= "VALUE('{$the_post_id}','guest','{$comment_content}',now() )";
                    $create_comments_query = mysqli_query($conn, $query);
                        if (!$create_comments_query) {
                        die("query failed to insert ".mysqli_error($conn));
                        } 
                      }
                  // redirect("Location:../index.php");
                  header("Location:../index.php");
            }          
             // redirect(location:"/ourmemories/post.php?p_id=$the_post_id");
             header("location:/ourmemories/post.php?p_id=$the_post_id");
       }  
              ?>

 
        <div class="search">
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

    if ($_SERVER['REQUEST_METHOD'] ==='POST') {
            if(isset($_POST['search'])){
                $seachInfo =  $_POST['search'];
                $results = "SELECT * FROM posts where post_tag like '%$seachInfo%' "; 
                $queryResults = mysqli_query($conn,$results);
                
                if(!$queryResults){
                    die("failed to queryDatas".mysqli_error($conn));
                }else{
                    $rowNumber = mysqli_num_rows($queryResults);
                    if ( $rowNumber == 0 ) {
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
                        <span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> 
                        </li>
                    <?php
                        }
                    }
                } 
            }
        }
            ?>
        </div>

         
        <p> </p>
        <!-- add sidebar comments-->  
        <div class="well">
            Leave a Comment:
            <form action="" method="post" role="form">
            <div class="form-group">
                <textarea id="e_comments" name="comment_content" class="form-control" rows="5"></textarea>
            </div>
                <button type="submit" name="add_comment" class="btn btn-primary">提交留言</button>
            </form>
        </div>

            <!-- display sidebar Comments -->
              <span>留言区:</span> 
               <?php
                    $query = "SELECT p.post_id, c.comment_author,c.comment_date,c.comment_content FROM posts p,comments c WHERE p.post_id = c.comment_post_id AND p.post_id = $the_post_id ";
                    $query .= "ORDER BY c.comment_id DESC";

                        $select_comment_query = mysqli_query($conn,$query);
                        if(!$select_comment_query){
                            die("Query Failed".mysqli_error($conn));              
                        }

                        while ($row = mysqli_fetch_array($select_comment_query)) {
                            $comment_username = $row["comment_author"];
                            $comment_date = $row["comment_date"];
                            $comment_content = $row["comment_content"];
                            ?>
                                <div class="media-content">     
                                <?php echo $comment_content; ?>  
                                </div>
                                <td><span class="glyphicon glyphicon-time"></span> <?php echo $comment_date; ?> </td>
                <?php  }?>
            <!-- </div> -->
  
</div>
<!-- </aside> -->
 
