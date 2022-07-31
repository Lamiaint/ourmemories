<?php include "includes/header.php";?>
 

 <!-- Navigation -->
 <?php include "includes/nevigation_post.php"; ?>

<div class="row">
  
        <?php  include "includes/sidebar_left.php"; ?>

    <div class="column middle">

                <?php 
                if (isset($_GET['p_id'])) {
                    $conn = getConnection();
                        $the_post_id = escape($_GET["p_id"]);
                            if($_SERVER['REQUEST_METHOD'] !=='POST'){
                           
                            $view_query = "UPDATE posts SET post_views_count = post_views_count +1 WHERE post_id = $the_post_id";
                            $send_query = mysqli_query($conn,$view_query);
                                if(!$send_query){
                                    die("send_query failed");
                                }
                                
                                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                                    
                                    $queryPost = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' ";

                                    }else{
                                     $queryPost = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' AND post_status = 'published' ";

                                     }

                                $queryPost = mysqli_query($conn, $queryPost);
                               if (mysqli_num_rows($queryPost)<1) {
                                    echo "<h3 class='text-center'> No Posts Available</h3>";
                                } else {

                            while ($row =mysqli_fetch_assoc($queryPost)) {
                            $post_category_id = $row["post_category_id"];
                            $post_title= $row["post_title"];
                            $post_author= $row["post_author"];
                            $post_date= $row["post_date"];
                            $post_edite_date= $row["post_edite_date"];

                            $post_content= $row["post_content"];
                            $post_image= $row["post_image"];
                            $post_video= $row["post_video"];

                            $post_status = $row["post_status"];
                            $post_views_count = $row["post_views_count"]; ?>
                        

                            <h3>
                                <a href="post.php?p_id=<?php echo $the_post_id; ?>"><?php echo $post_title; ?> </a>   
                                
                            </h3>

                            <p >
                            All Posts by <a href="author_post.php?author=<?php echo $post_author; ?>"> <?php echo $post_author ?> </a>
                            </p>

                            <td><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </td>
                            <td>  <?php echo $post_status ?> </td>

                            <P> </P>

                            <P> <?php  echo $post_content;?> </P>
                     
                            <?php
                            if($post_image){ 
                                echo "<img class='img-responsive' id='img-responsive' width='500' src='images/$post_image'>";
                            }
                            if($post_video){
                                echo "<iframe width='420' height='345' src='videos/$post_video'></iframe>";
                            }
                            ?>
                     
                    <?php
                    }
                }

                }
            }else{
                        header("Loction:index.php");
            }
            ?>

    </div>
              

       <hr>
         
        <?php include "includes/sidebar.php";?>
         

</div>
        <!-- Footer -->
        <div class="footer">
        <?php include "includes/footer/footer.php"; ?> 
        </div>