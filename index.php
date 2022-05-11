<?php include "includes/header.php";?>
 <!-- Navigation -->
<?php  include "includes/nevigation.php"; ?>


<div class="site-header container-fluid" style="background-image: url()">
	<div class="custom-header container" >
			<div class="site-heading text-center">
        				<div class="site-branding-logo">
				     <div class="site-branding-text">
											<h1 class="site-title"><a href="#" rel="home">You are My Life,My World,My Destiny</a></h1>
									</div>
        			</div>
    	</div>
</div>


<div class="main-menu">
	<nav id="site-navigation" class="navbar navbar-default navbar-center">     
		<div class="container">   
			<div class="navbar-header">
							</div>
					</div>
			</nav> 
</div>


    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
                <!-- Blog Post -->                 
                <div class="col-md-8"> 
             <?php 
              $conn = getConnection();

              $per_page = 3;//每页展示数量

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
             $count = ceil($count/$per_page);//总数除每页显示数量 = 一共有几页

            
             $queryPost = "SELECT * FROM posts LIMIT $page_1, $per_page";//从page_1开始展示，显示$per_page条

             $queryPostResults = mysqli_query($conn, $queryPost);
             
                 while ($row =mysqli_fetch_assoc($queryPostResults)) {
                     $post_id= $row["post_id"];
                     $post_title= $row["post_title"];
                     $post_author= $row["post_author"];
                     $post_user= $row["post_user"];
                     $post_date= $row["post_date"];
                     $post_content= substr($row["post_content"], 0, 200);
                     $post_image= $row["post_image"];
                     $post_status = $row["post_status"]; ?> 
             <h2>
                  <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>
             </h2>
           

             <p class="lead">
         by <a href='author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id ; ?>'> <?php echo $post_author=$post_user?$post_user:$post_author?> </a> 
             </p>


             <td><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </td>

             <td>  <?php echo $post_status ?> </td>
             
              <!-- <a href="post.php?p_id=<?php // echo $post_id;?>">  -->

             <hr>
                  <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
             <hr>
             </a>

                   <p>  <?php echo $post_content; ?> </p>

             <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More  <span class="glyphicon glyphicon-chevron-right"></span></a>
             <hr>

            <?php
                 }
             
              // echo "<h2>No Post </h2>";
              // if(!$queryPostResults){
              //   echo "<h2>No Post </h2>";
              //   }
            
                 
            

             ?>
        
           </div>

           
           <hr>
           <!-- Blog Sidebar Widgets Column  --> 
           <?php include "includes/sidebar.php";?>
           <hr>
            <!-- /.row -->
        </div>



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