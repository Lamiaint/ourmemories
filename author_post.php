
<?php include "includes/header.php";?>
    
<!-- Navigation -->
    <?php  include "includes/nevigation.php"; ?>

    <div class="row">
        <?php  include "includes/sidebar_left.php"; ?>
    <div class="column middle">                 
             <?php 
             $conn = getConnection();

                $per_page = 3;//每页展示数量

                if(isset($_GET['page'])){
                $page = escape($_GET['page']);
                }else{
                    $page = "";
                }
                if($page == "" || $page == 1){
                $page_1 = 0;
                }else{
                $page_1 = ($page * $per_page) - $per_page;//页数显示计算公式，计算得出从第几位开始展示
                }


             if (isset($_GET['author'])) {
                 //$the_post_id = $_GET["p_id"];
                 $the_post_author= escape($_GET["author"]);

                $post_query_count = "SELECT * FROM posts WHERE  post_user = '{$the_post_author}' OR post_author = '{$the_post_author}'";
                $find_count = mysqli_query($conn, $post_query_count);
                $count = mysqli_num_rows($find_count);//counts
                $count = ceil($count/$per_page);//总数除每页显示数量 = 一共有几页

                 // $queryPost = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' OR post_user = '{$the_post_author}'LIMIT $page_1, $per_page";
                 $queryPost = "SELECT * FROM posts WHERE post_user = '{$the_post_author}' OR post_author = '{$the_post_author}' ";
                 $queryPostResults = mysqli_query($conn, $queryPost);

                 while ($row =mysqli_fetch_assoc($queryPostResults)) {
                     $post_id=$row["post_id"];
                     $post_title= $row["post_title"];
                     $post_author= $row["post_author"];
                     $post_user= $row["post_user"];
                     $post_date= $row["post_date"];
                     $post_content= substr($row["post_content"], 0, 600);
                     $post_image= $row["post_image"];
                     $post_status = $row["post_status"]; 
                     
                     
                     ?>
                 <h1 class="page-header">

                 </h1> 

             <h3>
                  <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>
             </h3>

             <p class="lead">
                All Posts by <a href="author_post.php?author=<?php echo $post_author; ?>"> <?php echo $post_author ?> </a>
             </p>

             <td><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </td>
             
             <td>  <?php echo $post_status ?> </td>

                <?php
               // 登陆后首页编辑/删除
                if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                    $username = $_SESSION['username'];
                    if (isset($_GET['author'])) {
                        $the_post_author= escape($_GET["author"]);
                        if ($username === $the_post_author) {
                            echo "<td><a href='admin/posts.php?source=edit_post&p_id=$post_id'> Edit </a></td>";
                            echo "<td><a  onClick=\" javascript: return confirm('Are you sure you want to delete it?');\" href='admin/posts.php?delete={$post_id}'> Delete </a></td>";
                        }
                    }
                } ?> 

                <p>  <?php echo $post_content ?> </p>

             <hr>
                  <img class="img-responsive" width="500" src="images/<?php echo $post_image; ?>" alt="">
             <hr>

             
             <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More  <span class="glyphicon glyphicon-chevron-right"></span></a>
            
             <hr>


           <?php
                     } 
                 }?>

               <!-- Blog Comments -->
             <?php
             if (isset($_POST["create_comment"])) {
                 $the_post_id = escape($_GET["p_id"]);
                 $comment_author= escape($_POST["comment_author"]);
                 $comment_email= escape($_POST["comment_email"]);
                 $comment_content= escape($_POST["comment_content"]);

                 if (!empty($comment_autho) && !empty($comment_email) && !empty($comment_content)) {
                     $query = "INSERT INTO comments (                   
                        comment_post_id,
                        comment_author,                   
                        comment_email,
                        comment_content,
                        comment_date,                 
                        comment_status ) ";
                     $query .= "VALUE(
                         '{$the_post_id}',
                         '{$comment_author}',
                         '{$comment_email}',
                         '{$comment_content}',
                          now(),
                         'unproved')";
                     $create_comments_query = mysqli_query($conn, $query);
                     if (!$create_comments_query) {
                         die("query failed to insert ".mysqli_error($conn));
                     }
                 } else {
                     echo "<script> alert('Fields cant not be empty!') </script>";
                 }
             } ?>


                <!-- Comments Form -->
                <!-- <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>

                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>

                        <div class="form-group">
                            <label for="Comment">Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div> -->
                <!-- <hr> -->

                <!-- Posted Comments -->
                <?php

                
                 $queryPost = "SELECT p.post_id,p.post_title,p.post_author,p.post_user,";
                 $queryPost .= "c.comment_post_id,c.comment_author,c.comment_date,c.comment_content FROM posts p,comments c ";
                 $queryPost .= "WHERE c.comment_post_id = p.post_id AND p.post_author = '{$the_post_author}' ";
                 $queryPost .= "ORDER BY p.post_id DESC";
                 $queryPostResults = mysqli_query($conn, $queryPost);
                 while ($row =mysqli_fetch_assoc($queryPostResults)) {
                     $comment_author = $row["comment_author"];
                     $comment_date = $row["comment_date"];
                     $comment_content = $row["comment_content"]; 
                     ?>             
                <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                 <h4 class="media-heading" > <?php echo $comment_author; ?>                       
                                    <small> <?php echo $comment_date; ?> </small>
                                 </h4>
                                 <P>  <?php echo $comment_content; ?></P> 
                            </div>
                        </div> 
              <?php
             }
           ?> 
     </div>
          
          
          <!-- <div class="column right-side"> -->
          <?php include "includes/sidebar.php";?>
          <!-- </div> -->

</div>

        <ul class="pager">
            <?php
        for ($i=1;$i <= $count;$i++) {
            if ($i == $page) {
                echo "<li '><a class='active_link' href='author_post.php?author={$the_post_author}page={$i}'>{$i}</a></li>";
            } else {
                echo "<li '><a href='author_post.php?author={$the_post_author}&page={$i}'>{$i}</a></li>";
            }
        }
            ?>
        </ul>    
          
    
            <!-- Footer -->
            <div class="footer">
        <?php include "includes/footer/footer.php"; ?> 
        </div>