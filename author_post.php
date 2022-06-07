<?php include "includes/header.php";?>

<!-- Navigation -->
    <?php  include "includes/nevigation.php"; ?>

    <div class="row">
        <?php  include "includes/sidebar_left.php"; ?>
        <div class="column middle">                 
             <?php 
             $conn = getConnection();

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


             if (isset($_GET['author'])) {
                 //$the_post_id = $_GET["p_id"];
                 $the_post_author= escape($_GET["author"]);

                $post_query_count = "SELECT p.*,u.* FROM posts p,users u WHERE p.post_author = u.username and p.post_author = '{$the_post_author}' ORDER BY post_date DESC";
                $find_count = mysqli_query($conn, $post_query_count);
                $count = mysqli_num_rows($find_count);//counts
                $count = ceil($count/$per_page);//总数除每页显示数量 = 一共有几页

                 $queryPost = "SELECT p.*,u.* FROM posts p,users u WHERE p.post_author = u.username and p.post_author = '{$the_post_author}' ORDER BY p.post_date DESC LIMIT $page_1, $per_page "; 
                 $queryPostResults = mysqli_query($conn, $queryPost);

                 while ($row =mysqli_fetch_assoc($queryPostResults)) {
                     $post_id=$row["post_id"];
                     $post_title= $row["post_title"];
                     $post_author= $row["post_author"];
                     $post_user= $row["post_user"];
                     $post_date= $row["post_date"];
                     $post_content= substr($row["post_content"], 0, 1500);
                     $post_image= $row["post_image"];
                     $post_video= $row["post_video"];
                     $post_status = $row["post_status"]; 
                     
                     
                     ?>

             <h3>
                  <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>
             </h3>

             <p class="lead">
                All Posts by <a href="author_post.php?author=<?php echo $post_author; ?>"> <?php echo $post_author ?> </a>
             </p>

             <td><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </td>
             
             <td>  <?php echo $post_status ?> </td>

                <?php
               // 登陆后首页编辑/删除
                // if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                //     $username = $_SESSION['username'];
                //     if (isset($_GET['author'])) {
                //         $the_post_author= escape($_GET["author"]);
                //         if ($username === $the_post_author) {
                //             echo "<td><a href='admin/posts.php?source=edit_post&p_id=$post_id'> Edit </a></td>";
                //             echo "<td><a  onClick=\" javascript: return confirm('Are you sure you want to delete it?');\" href='admin/posts.php?delete={$post_id}'> Delete </a></td>";
                //         }
                //     }
                // } ?> 
                <P>  </P>
                <p>  <?php echo $post_content ?> </p>
                <img class="img-responsive" width="200" src="images/<?php echo $post_image; ?>" alt="">
                <div class=""><?php if($post_video){ echo "<video><source src='videos/$post_video' type='video'></video>";}?></div>             
             <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More  <span class="glyphicon glyphicon-chevron-right"></span></a>
             <hr> 
           <?php
                     } 
                 }?>   
                
    </div>
          
          
          <!-- <div class="column right-side"> -->
          <?php  include "includes/sidebar.php";?>
          <!-- </div> -->

</div>

        <ul class="pager">
            <?php
        for ($i=1;$i <= $count;$i++) {
            if ($i == $page) {
                echo "<li><a class='active_link' href='author_post.php?author={$the_post_author}&page={$i}'>{$i}</a></li>";
            } else {
                echo "<li><a href='author_post.php?author={$the_post_author}&page={$i}'>{$i}</a></li>";
            }
        }
  
           ?>
        </ul>    
          
    
            <!-- Footer -->
            <div class="footer">
        <?php include "includes/footer/footer.php"; ?> 
        </div>