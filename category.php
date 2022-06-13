<?php include "includes/header_category.php";?>
    <!-- Navigation -->
    <?php  include "includes/nevigation_left.php"; ?>


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">
<?php  include "includes/post_content_header.php"; ?>

  

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
        $post_query_count = "SELECT c.*,p.* FROM categories c,posts p  WHERE c.id = p.post_category_id AND c.id = $post_category_id ORDER BY p.post_id DESC ";

        $find_count = mysqli_query($conn, $post_query_count);
        $counts = mysqli_num_rows($find_count);//counts
        $count = ceil($counts/$per_page);//总数除每页显示数量 = 一共有几页

        $queryPost = "SELECT c.*,p.* FROM categories c,posts p  WHERE c.id = p.post_category_id AND post_category_id = $post_category_id ORDER BY p.post_date DESC LIMIT $page_1, $per_page";
        $queryPostResults = mysqli_query($conn, $queryPost);

                    $queryPostResults = mysqli_query($conn, $queryPost);
                    while ($row =mysqli_fetch_assoc($queryPostResults)) {
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

                        
                <!-- <div class="w3-cell-row"> -->
                  

               <?php
                if ($post_category_id == 48) {
                    echo " <div class='w3-container w3-cell w3-mobile'> ";
                    echo "<a target='_blank' href='post.php?p_id=$post_id'> $post_title </a>";
                    echo "<p> </p>";
                    echo "<p> invisable </p> </div>";
                } else if($post_category_id == 47){
                    echo "<div class='w3-third w3-container w3-margin-bottom'>";
                    echo "<div class='w3-container w3-white'>";
                    echo "<a href='post.php?p_id=$post_id'> $post_title </a>";
                    echo "<a target='_blank' href='post.php?p_id=$post_id'><img src='images/$post_image' alt='Norway' height='200px' width='200px' class='w3-hover-opacity' ></p> </a>";
                    echo "<p> $post_content</p>";
                    echo "</div></div>";
             
                }else{
                    echo "<div class='w3-third w3-container w3-margin-bottom'>";
                    echo "<div class='w3-container'>";
                    echo "<a target='_blank' href='post.php?p_id=$post_id'> $post_title </a>";
                    echo "<p> $post_content</p></div></div>";
                }
                 ?>          
                   
                <!-- </div> -->
                
                    <?php
                    } }
                   ?>
     </div>

       <!-- category page -->
     <ul class="pager">
          <?php
          for($i=1;$i <= $count;$i++){
            if($i == $page){
              echo "<li><a class='active_link' href='category.php?category={$post_category_id}&page={$i}'>{$i}</a></li>";
            }else{
                echo "<li><a href='category.php?category={$post_category_id}&page={$i}'>{$i}</a></li>";             
            } 
          }
          ?>
      </ul>





  <?php include "includes/footer_category.php";  ?>

  <div class="w3-black w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></div>

<!-- End page content -->
</div>


</body>
</html>

