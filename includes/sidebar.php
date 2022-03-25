<div class="col-md-4">
    
    <?php 
    if(isset($_POST['submit'])){
    //sibar search 
     $conn = getConnection();
     $seachInfo = $_POST['search'];
     $results = "SELECT * FROM posts where post_tag like '%$seachInfo%'"; 
     $queryResults = mysqli_query($conn,$results);
     if(!$queryResults){
         die("failed to queryDatas".mysqli_error($conn));
        }else{
         $rowNumber = mysqli_num_rows($queryResults);
         if($rowNumber==0){
        //blog title search result from sidbar
        //$conn = getConnection();
        $queryPostTitle = "SELECT * FROM posts WHERE post_title like '%$seachInfo%' ";//按题目查找 
        $queryPostResults = mysqli_query($conn,$queryPostTitle);
        while ($row =mysqli_fetch_assoc($queryPostResults)) {
            $post_title= $row["post_title"];
            $post_author= $row["post_author"];
            $post_date= $row["post_date"];
            $post_content= $row["post_content"];
            $post_image= $row["post_image"]; 

             ?>
        <h1 class="page-header">
            You are My Life,My World,My Destiny
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
             <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
        <hr>
              <p>  <?php echo $post_content ?> </p>
        <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->
        <hr>
         <?php  } 
        //blog title end  index.php
                 }
            } 
    }?>
    

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Info Search</h4>
        <form action="" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
       </form>          
    </div>



    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="username" type="text" placeholder="enter username" class="form-control">      
        </div>
        <div class="input-group">
        <input name="password" type="password" placeholder="enter password" class="form-control">          
        <span>
            <button class="btn btn-primary" name="login" type="submit">submit</button>
        </span>
        </div>
       </form> 

    </div>


    
    
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Info Categories</h4>
           <?php
                $conn = getConnection();
                $qeury = "select * from categories";
                $qeuryResults = mysqli_query($conn,$qeury); 
           ?>

        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    while($qeuryResultsRow = mysqli_fetch_assoc($qeuryResults)){
                    $cat_title = $qeuryResultsRow["title"];
                    $cat_id = $qeuryResultsRow["id"];
                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title }</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
    
    <!-- Side Widget Well -->
    <?php  include "widget.php";?>
</div>