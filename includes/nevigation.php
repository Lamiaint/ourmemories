<?php include "db.php" ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
              <!-- template framwork-->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"> 首页导航 </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>     
                    <?php
                         $conn = getConnection();
                         $qeury = "select * from categories";
                         $qeuryResults = mysqli_query($conn,$qeury); 

                    while($qeuryResultsRow = mysqli_fetch_assoc($qeuryResults)){
                    $cat_title = $qeuryResultsRow["title"];
                    $cat_id = $qeuryResultsRow["id"];
                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title }</a></li>";                   
                    }
                    ?>                    
                    </li>

                    <li> <a href="admin"> Admin </a> </li>
                    <li> <a href="registration.php"> Registration </a> </li>

                   






                </ul>
            </div>
            <!-- /.navbar-collapse -->
             
        </div>
        
        <!-- /.container -->
    </nav>

    
 