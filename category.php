<?php include "includes/header.php";?>

    <!-- Navigation -->
    <?php  include "includes/nevigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
                <!-- Blog Post -->                 
                <div class="col-md-8"> 
             <?php 
             if (isset($_GET['category'])) {
                 $post_category_id = $_GET['category'];
                 
                 $conn = getConnection();
                 $queryPost = "SELECT * FROM posts WHERE post_category_id = $post_category_id ";
                 $queryPostResults = mysqli_query($conn, $queryPost);
               
                 while ($row =mysqli_fetch_assoc($queryPostResults)) {
                     $post_id= $row["post_id"];
                     $post_title= $row["post_title"];
                     $post_author= $row["post_author"];
                     $post_date= $row["post_date"];
                     $post_status = $row["post_status"];
                     $post_content= substr($row["post_content"], 0, 100);
                     $post_image= $row["post_image"];
                     ?>
                 <h1 class="page-header">
                 <!-- You are My Life,My World,My Destiny
                 <small>Secondary Text</small>-->  
             </h1>      
             <h2>
                  <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>
             </h2>
             <p class="lead">
                  All Posts by <?php //echo $post_author ?>
                  <a href="author_post.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ;?>"> <?php echo $post_author ?> </a>
             
             </p>
             <td><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </td>

               <td>  <?php echo $post_status ?> </td>

             <hr>
                  <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
             <hr>
                   <p>  <?php echo $post_content ?> </p>
                   <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More  <span class="glyphicon glyphicon-chevron-right"></span></a> 
             <hr>

           <?php
                 }
             }
              ?>

        
        </div>
           <!-- Blog Sidebar Widgets Column -->
           <?php  include "includes/sidebar.php";?>
        <!-- /.row -->
        <hr>
                
        <!-- Footer -->
        <?php include "includes/footer/footer.php"; ?> 