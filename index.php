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
              $conn = getConnection();

              $per_page = 6;//每页展示数量

              if(isset($_GET['page'])){
                $page = $_GET['page'];
              }else{
                  $page = "";
              }
              if($page == "" || $page == 1){
                $page_1 = 0;

              }else{
                $page_1 = ($page * $per_page) - $per_page;//页数显示计算公式，计算得出从第几位开始展示

              }


             $post_query_count = "SELECT * FROM posts";
             $find_count = mysqli_query($conn, $post_query_count);
             $count = mysqli_num_rows($find_count);//counts
             $count = ceil($count/5);

            
             $queryPost = "SELECT * FROM posts LIMIT $page_1, $per_page";//从page_1开始展示，显示$per_page条
             $queryPostResults = mysqli_query($conn,$queryPost);
             while ($row =mysqli_fetch_assoc($queryPostResults)) {
                 $post_id= $row["post_id"];
                 $post_title= $row["post_title"];
                 $post_author= $row["post_author"];
                 $post_date= $row["post_date"];
                 $post_content= substr($row["post_content"], 0, 200);
                 $post_image= $row["post_image"];
                 $post_status = $row["post_status"];
                  if ($post_status) {
                     ?>

             <h1 class="page-header">
                 You are My Life,My World,My Destiny                
             </h1>  

             <h2>
                  <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>
             </h2>

             <p class="lead">
                  by <a href="author_post.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ;?>"> <?php echo $post_author ?> </a>
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
                 }else{
                    ?>
                    <h1 class="page-header">
                    <?php echo " No Post";    ?>          
                  </h1>  
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

        <ul class="pager">
            <?php
            for($i=1;$i <= $count;$i++){
              if($i == $page){
                echo "<li '><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
              }else{
                echo "<li '><a href='index.php?page={$i}'>{$i}</a></li>";
                
              } 
            }

            ?>



        </ul>
       
                
        <!-- Footer -->
        <?php include "includes/footer/footer.php"; ?> 