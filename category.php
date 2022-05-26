<?php include "includes/header.php";?>
    <!-- Navigation -->
    <?php  include "includes/nevigation.php"; ?>

<div class="row">
        <?php  include "includes/sidebar_left.php"; ?>
  <div class="column middle">

             <?php 
             $per_page = 5;//每页展示数量

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
            
        if (isset($_GET['category'])) {
            $post_category_id = escape($_GET['category']);

            $post_query_count = "SELECT c.*,p.* FROM categories c,posts p  WHERE c.id = p.post_category_id AND c.id = $post_category_id ORDER BY p.post_date DESC";
            $find_count = mysqli_query($conn, $post_query_count);
            $counts = mysqli_num_rows($find_count);//counts
            $count = ceil($counts/$per_page);//总数除每页显示数量 = 一共有几页

            $queryPost = "SELECT c.*,p.* FROM categories c,posts p  WHERE c.id = p.post_category_id AND post_category_id = $post_category_id ORDER BY p.post_date DESC LIMIT $page_1, $per_page";
            $queryPostResults = mysqli_query($conn, $queryPost);

         
     
                while ($row =mysqli_fetch_assoc($queryPostResults)) {
                    $post_id= $row["post_id"];
                    $post_title= $row["post_title"];
                    $post_author= $row["post_author"];
                    $post_user= $row["post_user"];
                    $post_date= $row["post_date"];
                    $post_status = $row["post_status"];
                    $post_content= substr($row["post_content"], 0, 600);
                    $post_image= $row["post_image"]; 
                    $post_video= $row["post_video"];
                    
                    ?>     
             <h3>
                  <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>
             </h3>
         
             <p class="lead">
         by <a href='post.php?p_id=<?php echo $post_id; ?>'> <?php echo $post_author?> </a> 
             </p>

             <td><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </td>

               <td>  <?php echo $post_status ?> </td>

               <p>  <?php echo $post_content ?> </p>
             <hr>
                  <img class="img-responsive" width="500" src="images/<?php echo $post_image; ?>" alt="">
             <hr>

    
                    <div class="video">
                    <video class="" >
                    <source src="videos/<?php echo $post_video;  ?>" type="" alt="">
                    </video>
                    </div>




                   
                   <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More  <span class="glyphicon glyphicon-chevron-right"></span></a> 
             <hr>
           <?php
                }

                if(empty($queryPostResults)){
                  echo " <p> No Post </p>";
                }
              
        }
        
              ?>

  </div>
          
          
          <!-- <div class="column right-side"> -->
          <?php include "includes/sidebar.php";?>
          <!-- </div> -->

</div>


        <ul class="pager">
          <?php
          for($i=1;$i <= $count;$i++){
            if($i == $page){
              echo "<li><a class='active_link' href='category.php?category={$post_category_id}&page={$i}'>{$i}</a></li>";
            }else{
                echo "<li '><a href='category.php?category={$post_category_id}&page={$i}'>{$i}</a></li>";             
            } 
          }
          ?>
      </ul>


               <!-- Footer -->
               <div class="footer">
        <?php include "includes/footer/footer.php"; ?> 
        </div>