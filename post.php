<?php //include "includes/data/dbManipulation.php";?>
<?php include "includes/header.php";?>
    
<!-- Navigation -->
    <?php  include "includes/nevigation.php"; ?>

 
    <body>
    <!-- Page Content -->
    <div class="page-area">
    <div class="container main-container" role="main">             
                <div class="col-md-8">                   
             <?php 
             if (isset($_GET['p_id'])) {
                    $the_post_id = escape($_GET["p_id"]);
                        if($_SERVER['REQUEST_METHOD'] !=='POST'){
                        $conn = getConnection();
                        $view_query = "UPDATE posts SET post_views_count = post_views_count +1 WHERE post_id = $the_post_id";
                        $send_query = mysqli_query($conn,$view_query);
                            if(!$send_query){
                                die("send_query failed");
                            }
                    }
                 
                 $queryPost = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' ";
                 $queryPostResults = mysqli_query($conn, $queryPost);
                    while ($row =mysqli_fetch_assoc($queryPostResults)) {
                        $post_title= $row["post_title"];
                        $post_author= $row["post_author"];
                        $post_date= $row["post_date"];
                        $post_content= $row["post_content"];
                        $post_image= $row["post_image"];
                        $post_status = $row["post_status"];
                        $post_views_count = $row["post_views_count"]; ?>
                        
                    <h1 class="page-header">
                    <!-- You are My Life,My World,My Destiny
                        <small> Secondary Text </small>
                    -->
                    </h1> 
                     

                <h2>
                    <a href="post.php?p_id=<?php echo $the_post_id; ?>"><?php echo $post_title; ?> </a>   
                    
                </h2>

                <p class="lead">
                   All Posts by <a href="author_post.php?author=<?php echo $post_author; ?>"> <?php echo $post_author ?> </a>
                </p>

                <td><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </td>
                
                <td>  <?php echo $post_status ?> </td>

                     <!-- //登陆后首页编辑  test-->
         <?php //echo "<td><a href='posts_index.php?source=edite_post_index&p_id=$the_post_id'> Edite </a></td>";  ?>  

        <?php
        //登陆后首页编辑/删除 
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            if(isset($_GET['p_id'])){
                $the_post_id = escape($_GET['p_id']);
                    echo "<td><a href='posts_index.php?source=edite_post_index&p_id=$the_post_id'> Edite </a></td>";
                        echo "<td><a  onClick=\" javascript: return confirm('Are you sure you want to delete it?');\" href='post.php?delete={$the_post_id}'> Delete </a></td>"; 
            }
        }
        ?> 

        
                <p>  <?php echo $post_content ?> </p>

                <hr>
                    <img class="img-responsive" width="500" src="images/<?php echo $post_image; ?>" alt="">
                <hr>

                
                <!-- <a class="btn btn-primary" href="#">Read More  <span class="glyphicon glyphicon-chevron-right"></span></a> -->
                <hr>

            <?php
                    }
                }else{
                 header("Loction:index.php");


             }?>


               <!-- Add Blog Comments -->
             <?php  
        if ($_SERVER['REQUEST_METHOD'] ==='POST') {
            if (isset($_POST["create_comment"])) {
            $the_post_id = escape($_GET["p_id"]);
            $comment_author= escape($_POST["comment_author"]);
            if(empty($comment_author)){
                $comment_author ="guest";
            }
            $comment_content= escape($_POST["comment_content"]);
                    if (!empty($comment_author) && !empty($comment_content)) {
                    $query = "INSERT INTO comments (                   
                    comment_post_id,comment_author,comment_content,comment_date,comment_status ) ";
                    $query .= "VALUE('{$the_post_id}','{$comment_author}','{$comment_content}',now(),'unproved')";
                    $create_comments_query = mysqli_query($conn, $query);
                        if (!$create_comments_query) {
                        die("query failed to insert ".mysqli_error($conn));
                        } 
                    } 
            }
       }  
              
?>


<!-- Posted Comments -->
<?php

if (isset($_GET['p_id'])) {
    $the_post_id = escape($_GET["p_id"]);

        $query = "SELECT * FROM comments c WHERE c.comment_post_id = $the_post_id ORDER BY c.comment_id DESC ";
        $select_comment_query = mysqli_query($conn,$query);
        if(!$select_comment_query){
            die("Query Failed".mysqli_error($conn));              
        }
        while ($row = mysqli_fetch_array($select_comment_query)) {
            $comment_author = $row["comment_author"];
            $comment_date = $row["comment_date"];
            $comment_content = $row["comment_content"];
            ?>
            
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                <h4 class="media-heading" ><?php echo $comment_content; ?></h4>
                </div>
                <?php 
                    echo $comment_author; 
                ?>                       
                <small> <?php echo $comment_date; ?> </small> 
            </div>        
        <?php 
        }}?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <input type="hidden" value="<?=isset($the_post_id)?? null ?>">

                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input id="comment_author" type="text" class="form-control" name="comment_author">
                        </div>

                        <!-- <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div> -->

                        <div class="form-group">
                            <label for="Comment">Comment</label>
                            <textarea  id="p_comments" name="comment_content" class="form-control" rows="3"></textarea>
                        </div>   
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>
       
     
     <?php
                        
            if (isset($_GET["delete"])) {
                $post_id = escape($_GET["delete"]);  
               $query_delete = "DELETE p.*,c.* FROM posts p,comments c WHERE p.post_id = c.comment_post_id AND p.post_id = '{$post_id}' ";
               // $query_delete = "DELETE FROM posts p WHERE p.post_id = '{$post_id}' ";
                $delete_query = mysqli_query($conn, $query_delete);
                header("Location:index.php");
            }

    ?>
        

        
        </div>
           <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php";?>
        <!-- /.row -->
        <hr>
                
        <!-- Footer -->
        <?php include "includes/footer/footer.php"; ?> 