<?php //include "includes/data/dbManipulation.php";?>
<?php include "includes/header.php";?>
    
<!-- Navigation -->
    <?php  include "includes/nevigation.php"; ?>
   
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Entries Column -->                
                <div class="col-md-8">                   
             <?php 
             if(isset($_GET['p_id'])){
                 $the_post_id = $_GET["p_id"];
                 $the_post_author= $_GET["author"];
                 $conn = getConnection();
                 $queryPost = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
                 $queryPostResults = mysqli_query($conn,$queryPost);
                 while($row =mysqli_fetch_assoc($queryPostResults)){
                     $post_title= $row["post_title"];
                     $post_author= $row["post_author"];
                     $post_date= $row["post_date"];
                     $post_content= $row["post_content"];
                     $post_image= $row["post_image"];
                     $post_status = $row["post_status"];
                 ?>
                 <h1 class="page-header">
                <!-- You are My Life,My World,My Destiny
                     <small> Secondary Text </small>
                -->
                 </h1> 
<!-- 
             <h2>
                  <a href="#"><?php // echo $post_title ?> </a>
             </h2> -->

             <h2>
                  <a href="post.php?p_id=<?php echo $the_post_id ?>"><?php echo $post_title; ?> </a>
             </h2>

             <p class="lead">
                  All Posts by
                  <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $the_post_id;?>"> <?php echo $post_author ?> </a>
             </p>

             <td><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </td>
             
             <td>  <?php echo $post_status ?> </td>

                <?php
                //登陆后首页编辑/删除
                if(isset( $_SESSION['username']) && isset($_SESSION['password'])){
                    $username = $_SESSION['username'];
                    if(isset($_GET['p_id'])){
                        $the_post_id = $_GET['p_id'];
                        $the_post_author= $_GET["author"];
                        if($username === $the_post_author ){
                            echo "<td><a href='admin/posts.php?source=edit_post&p_id=$the_post_id'> Edit </a></td>"; 
                            echo "<td><a  onClick=\" javascript: return confirm('Are you sure you want to delete it?');\" href='admin/posts.php?delete={$the_post_id}'> Delete </a></td>"; 
                        }

                    }
                }
                ?> 


             <hr>
                  <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
             <hr>

             <p>  <?php echo $post_content ?> </p>
              <!-- <a class="btn btn-primary" href="#">Read More  <span class="glyphicon glyphicon-chevron-right"></span></a> -->
             <hr>

           <?php  } ?>


               <!-- Blog Comments -->
             <?php  
             if(isset($_POST["create_comment"])){               
                 $the_post_id = $_GET["p_id"];
                 $comment_author= $_POST["comment_author"];               
                 $comment_email= $_POST["comment_email"];
                 $comment_content= $_POST["comment_content"];

                 if(!empty($comment_autho) && !empty($comment_email) && !empty($comment_content)){
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
                $create_comments_query = mysqli_query($conn,$query);
                if(!$create_comments_query){
                    die("query failed to insert ".mysqli_error($conn));
                } }else{

                    echo "<script> alert('Fields cant not be empty!') </script>";

                 }

             }           
               ?>


                <!-- Comments Form -->
                <div class="well">
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
                </div>
                <hr>

                <!-- Posted Comments -->
                 <?php

                   $query = "SELECT * FROM comments WHERE comment_post_id = '{$the_post_id}' ";
                   //$query .= "AND comment_status = 'approved' ";
                   $query .= "ORDER BY comment_id DESC";

                   // $conn = getConnection();
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
                                   
                                 <h4 class="media-heading" > <?php echo $comment_author; ?>                       
                                    <small> <?php echo $comment_date; ?> </small>
                                 </h4>
                                  <?php echo $comment_content; ?>
                            </div>
                        </div>        
              <?php } }?>
     
            
         
        
        </div>
           <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php";?>
        <!-- /.row -->
        <hr>
                
        <!-- Footer -->
        <?php include "includes/footer/footer.php"; ?> 