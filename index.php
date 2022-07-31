<?php include "includes/header.php";?>

 <!-- Navigation -->
 <?php  include "includes/nevigation.php"; ?>

 <?php  include "includes/person_info_first.php"; ?>

 <?php  include "includes/person_info_second.php"; ?>


    <!-- Third Container (Grid) -->
    <div class="container-fluid bg-3 text-center">    
        <h3 class="margin">Where To Find Me?</h3><br>

            <?php 
              $per_page = 6;//每页展示数量

              if(isset($_GET['page'])){
                $page = escape($_GET['page']);
              }else{
                  $page = "";
              }
              if($page == "" || $page == 1){
                $page_1 = 0; //从第几位开始展示

              }else{
                $page_1 = ($page * $per_page) - $per_page;//页数显示计算公式， 得出从第几位开始展示

              }

              //login 权限页数
              if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){                      
                $queryPost = "SELECT * FROM posts ORDER BY post_id DESC "; 
                $find_count = mysqli_query($conn, $queryPost);
                }else{
                 $queryPost = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC "; 
                 }

                 $find_count = mysqli_query($conn, $queryPost);
                 $counts = mysqli_num_rows($find_count); 
                 $count = ceil($counts/$per_page);//总数除每页显示数量 = 一共有几页  
                 
              if($count < 1){
                  echo "<h3 class='text-center'> No Posts Available</h3>";
                      }else{
                        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                          $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1, $per_page ";//从$page_1 开始展示，$per_page = 展示的数量
                        }else{
                          $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_1, $per_page ";//从$page_1 开始展示，$per_page = 展示的数量
                        }?>

       <div class="row">
                <?php
                $select_all_posts_query = mysqli_query($conn,$query);
                while ($row =mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_category_id = $row["post_category_id"];
                    $post_id= $row["post_id"];
                    $post_title= $row["post_title"];
                    $post_author= $row["post_author"];
                    $post_user= $row["post_user"];
                    $post_date= $row["post_date"];
                    $post_content= substr($row["post_content"], 0, 200);
                    $post_image= $row["post_image"];
                    $post_video= $row["post_video"];
                    $post_status = $row["post_status"]; ?> 
                    <div class="col-sm-4">
                      <h4>
                      <a href="post.php?p_id=<?php echo $post_id; ?>"><h3><?php echo $post_title; ?></h3> </a>
                      </h4>
                      <P class="w3-left"> <?php echo $post_content; ?> </P>
                          <?php
                          if($post_image){
                            echo "<P> <img class='img-responsive' width='200' src='images/$post_image' alt=''></P>";
                          }elseif ($post_video) {
                              echo "<iframe width='200' height='200' src='videos/$post_video?autoplay=1&mute=1&controls=0'></iframe> <br>";
                          } ?>
                    </div>
                      <?php
              }
          }
             ?>
      </div>
    </div>






            <div class="center">
            <div class="pagination">
              <?php
              for($i=1;$i <= $count;$i++){
                if($i == $page){
                  echo "<a class='active' href='index.php?page={$i}'>{$i}</a>";
                }else{ 
                  echo "<a href='index.php?page={$i}'>{$i}</a>";               
                } 
              }
              ?>  
            </div>
            </div>
             
     
 
  
        <!-- Footer -->
        <div class="footer">
        <?php include "includes/footer/footer.php"; ?> 
        </div>
  
        