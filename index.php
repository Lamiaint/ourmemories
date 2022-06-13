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


             $post_query_count = "SELECT * FROM posts";
             $find_count = mysqli_query($conn, $post_query_count);
             $count = mysqli_num_rows($find_count);//counts
             $count = ceil($count/$per_page);//总数除每页显示数量 = 一共有几页

            
             $queryPost = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1, $per_page";//从page_1开始展示，显示$per_page条

             $queryPostResults = mysqli_query($conn, $queryPost);
             
                 while ($row =mysqli_fetch_assoc($queryPostResults)) {
                     $post_category_id = $row["post_category_id"];
                     $post_id= $row["post_id"];
                     $post_title= $row["post_title"];
                     $post_author= $row["post_author"];
                     $post_user= $row["post_user"];
                     $post_date= $row["post_date"];
                     $post_content= substr($row["post_content"], 0, 600);
                     $post_image= $row["post_image"];
                     $post_video= $row["post_video"];
                     $post_status = $row["post_status"]; ?> 
             <h4>
                  <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>
             </h4>
           

             <p class="lead">
             <h5>by <a href='author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id ; ?>'> <?php echo $post_author=$post_user?$post_user:$post_author?> </a> </h5>
             </p>


             <td><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </td>

             <td>  <?php echo $post_status ?> </td>
             <P>  </P>

                  <P>  <?php 
                     if($post_category_id == 48){
                        echo " 暂不可见 ";
                       }else{
                        echo $post_content;
                        }
                     ?> </P>


             <P> <img class="img-responsive" width="200" src="images/<?php echo $post_image; ?>" alt=""></P>


            <?php
            if($post_video){ echo "<iframe width='200' height='200' src='videos/$post_video?autoplay=1&mute=1&controls=0'></iframe> <br>";}
            ?>

             <!-- <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More  <span class="glyphicon glyphicon-chevron-right"></span></a> -->
             <hr>

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
              for($i=1;$i <= $count;$i++){
                if($i == $page){
                  echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                }else{
                  echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";               
                } 
              }
              ?>
          </ul>   
        
        
        
        <!-- Footer -->
        <div class="footer">
        <?php include "includes/footer/footer.php"; ?> 
        </div>
  
        