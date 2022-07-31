<?php include "includes/header_category.php";?>
    <!-- Navigation -->
    
    <?php  include "includes/nevigation_left.php"; ?>


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">
<?php  include "includes/post_content_header.php"; ?>

<?php ob_start();?>
<?php session_start();  ?>
  

    <!-- First Photo Grid-->
    <!-- <div class="w3-container"> -->
    <div class="w3-row-padding">
       <?php

            $per_page = 15;//每页展示数量

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

    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){                      
        $queryPost = "SELECT c.*,p.* FROM categories c,posts p  WHERE c.id = p.post_category_id AND p.post_category_id = $post_category_id ORDER BY p.post_id DESC ";
    }else{
            $queryPost = "SELECT c.*,p.* FROM categories c,posts p  WHERE c.id = p.post_category_id AND p.post_category_id = $post_category_id AND p.post_status = 'published' ORDER BY p.post_id DESC ";
    }

    $find_count = mysqli_query($conn, $queryPost);
    $counts = mysqli_num_rows($find_count);//counts
    $count = ceil($counts/$per_page);//总数除每页显示数量 = 一共有几页

            if (mysqli_num_rows($find_count)<1) {
                echo "<h3 class='text-center'> No Posts Available</h3>";
            } else {
                
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                    $query = "SELECT c.*,p.* FROM categories c,posts p  WHERE c.id = p.post_category_id AND p.post_category_id = $post_category_id ORDER BY p.post_id DESC LIMIT $page_1, $per_page";
                }else{
                    $query = "SELECT c.*,p.* FROM categories c,posts p  WHERE c.id = p.post_category_id AND p.post_category_id = $post_category_id AND p.post_status = 'published' ORDER BY p.post_id DESC LIMIT $page_1, $per_page";
                }
        
                $select_all_posts_query = mysqli_query($conn,$query);
                while ($row =mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row["post_id"];
                    $post_category_id = $row["post_category_id"];
                    $post_title= $row["post_title"];
                    $post_author= $row["post_author"];
                    $post_date= $row["post_date"];
                    $post_edite_date= $row["post_edite_date"];

                    $post_content= substr($row["post_content"], 0, 200);
                    $post_image= $row["post_image"];
                    $post_video= $row["post_video"];

                    $post_status = $row["post_status"];
                    $post_views_count = $row["post_views_count"]; ?>
                        
                    <?php                      
                    echo "<div class='w3-third w3-container w3-margin-bottom'>";//
                    echo "<div class='w3-container w3-center'>";//w3-white
                    echo "<a href='post.php?p_id=$post_id'> <h3>$post_title</h3> </a>";
                    //echo "<a href='post.php?p_id=$post_id'><img src='images/$post_image' alt='Norway' height='200px' width='200px' class='w3-hover-opacity'> </a>";
                    if ($post_image) {
                        echo "<P><a href='post.php?p_id=$post_id'><img width='200' height='200' src='images/$post_image' alt='Norway'></a></P>";//
                    }elseif ($post_video) {
                        echo "<iframe width='200' height='200' src='videos/$post_video?autoplay=1&mute=1&controls=0'></iframe> <br>";
                    }   
                    echo "<p> $post_content</p>";
                    echo "</div></div>";
                    ?>          
                    <?php
                }

                


            }
}else{
    header("Location:index.php");
}
                   ?>
     </div>

        <!-- category page -->
        <div class="center">
        <div class="pagination">
          <?php
          for($i=1;$i <= $count;$i++){
            if($i == $page){
              echo "<a class='active' href='category.php?category={$post_category_id}&page={$i}'>{$i}</a>";
            }else{
                echo "<a href='category.php?category={$post_category_id}&page={$i}'>{$i}</a>";             
            } 
          }
          ?>
        </div>
        </div>



  <div class=" w3-bottombar w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></div>

<!-- End page content -->
</div>


</body>
</html>

