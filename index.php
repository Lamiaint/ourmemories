<?php include "includes/header/header.php";?>
 
    <!-- Navigation -->
    <?php  include "includes/nevigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
                <!-- Blog Post -->                 
                <div class="col-md-8"> 
             <?php 
             $conn = getConnection();
             $queryPost = "SELECT * FROM posts";
             $queryPostResults = mysqli_query($conn,$queryPost);
             while ($row =mysqli_fetch_assoc($queryPostResults)) {
                 $post_id= $row["post_id"];
                 $post_title= $row["post_title"];
                 $post_author= $row["post_author"];
                 $post_date= $row["post_date"];
                 $post_content= substr($row["post_content"], 0, 200);
                 $post_image= $row["post_image"];
                 $post_status = $row["post_status"];
                 
                 if ($post_id !== null) {
                     ?>
             <h1 class="page-header">
                 You are My Life,My World,My Destiny                
             </h1>  

             <h2>
                  <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>
             </h2>

             <p class="lead">
                  by <a href="index.php"> <?php echo $post_author ?> </a>
             </p>

             <td><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </td>

             <td>  <?php echo $post_status ?> </td>
             
              <!-- <a href="post.php?p_id=<?php // echo $post_id; ?>">  -->

             <hr>
                  <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
             <hr>
             </a>

                   <p>  <?php echo $post_content ?> </p>

             <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More  <span class="glyphicon glyphicon-chevron-right"></span></a>
             <hr>

            <?php
                 }
             }
             ?>
        
        </div>
         
        <hr>
           <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php";?>
        <!-- /.row -->
        <hr>
       
                
        <!-- Footer -->
        <?php include "includes/footer/footer.php"; ?> 