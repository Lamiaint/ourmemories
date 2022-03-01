                <!-- First Blog Post -->                 
                <div class="col-md-8"> 
             <?php 
             $conn = getConnection();
             $queryPost = "SELECT * FROM posts";
             $queryPostResults = mysqli_query($conn,$queryPost);
             while($row =mysqli_fetch_assoc($queryPostResults)){
                 $post_title= $row["post_title"];
                 $post_author= $row["post_author"];
                 $post_date= $row["post_date"];
                 $post_content= $row["post_content"];
                 ?>
                 <h1 class="page-header">
                 Page Heading
                 <small>Secondary Text</small>
             </h1>      
             <h2>
                  <a href="#"><?php echo $post_title ?> </a>
             </h2>
             <p class="lead">
                  by <a href="index.php"> <?php echo $post_author ?> </a>
             </p>
             <p><span class="glyphicon glyphicon-time"></span> <?php $post_date ?> </p>
             <hr>
                  <img class="img-responsive" src="http://placehold.it/900x300"  alt="">
             <hr>
                   <p>  <?php $post_content ?> </p>
             <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
             <hr>

           <?php  } ?>