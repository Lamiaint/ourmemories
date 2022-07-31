<!-- Second Container -->
<div class="container-fluid bg-2 text-center">

  <h3 class="payImg">What Am I?</h3>
  <!-- <p> 一段在地球的旅程</p> -->

  <!-- <a href="#" class="btn btn-default btn-lg">
    <span class="glyphicon glyphicon-search"></span> Search
  </a> -->



  <?php 
            if(isset($_POST['search'])){
            $seachInfo =  $_POST['search'];
            $results = "SELECT * FROM posts where post_tag like '%$seachInfo%' "; 
            $queryResults = mysqli_query($conn,$results); 
                if(!$queryResults){
                    die("failed to queryDatas".mysqli_error($conn));
                }else{
                    $rowNumber = mysqli_num_rows($queryResults);
                    if ( $rowNumber !==0 ) {
                        $queryPostTitle = "SELECT * FROM posts WHERE post_title like '%$seachInfo%' LIMIT 6 ";//按题目查找
                        $queryPostResults = mysqli_query($conn, $queryPostTitle);
                        while ($row =mysqli_fetch_array($queryPostResults)) { 
                        $post_title = $row["post_title"];
                        $post_id    = $row["post_id"];
                        $post_author= $row["post_author"];
                        $post_date  = $row["post_date"];  
                            ?>
                        <li> 
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?> </a>
                        <span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> 
                        </li>
                    <?php
                        }
                    }
                } 
            }
            ?>

</div>