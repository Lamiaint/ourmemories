<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">
        <?php     
        $conn = getConnection(); 
        ?>

        <!-- Navigation -->
        <?php include "includes/admin_nevigation.php";?>
 
    <div id="page-wrapper">

<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Wellcome to Admin
                            <small> <?php  echo $_SESSION['username']  ?> </small>
                        </h1>

                     </div> 
                </div> 

             <!--widges-->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                     <!--SELECT * FROM posts-->
                    <?php
                    $query = "SELECT * FROM posts";
                    $select_all_post = mysqli_query($conn,$query);
                    $post_counts = mysqli_num_rows($select_all_post );

                    ?>
                        <div class='huge'><?php  echo $post_counts; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <!--SELECT * FROM comments-->
                    <?php
                    $query = "SELECT * FROM  comments";
                    $select_all_post = mysqli_query($conn,$query);
                    $comment_counts = mysqli_num_rows($select_all_post );

                    ?>
                        <div class='huge'><?php echo $comment_counts; ?> </div>
                        <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="./comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <!--SELECT * FROM users-->
                    <?php
                    $query = "SELECT * FROM  users";
                    $select_all_post = mysqli_query($conn,$query);
                    $user_counts = mysqli_num_rows($select_all_post );
                    ?>
                        <div class='huge'><?php  echo $user_counts;  ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                 
                    <!--SELECT * FROM categories-->
                    <?php
                    $query = "SELECT * FROM  categories";
                    $select_all_post = mysqli_query($conn,$query);
                    $category_counts = mysqli_num_rows($select_all_post );
                    ?>

                        <div class='huge'><?php  echo $category_counts;  ?></div>
                        <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- 2022 widges-->

<!-- 添加到 Bubble Chart-->
<?php
 $query = "SELECT * FROM  categories WHERE title = 'JAVA' ";
 $select_title = mysqli_query($conn,$query);
 $category_title = mysqli_num_rows($select_title );

?>


<!-- Bubble Chart-->
<div>  

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
   
          ['Data', 'Counts'],
            <?php
            $element_text = ['Comments','Posts','Categories','Users','Title'];
            $element_count = [$comment_counts,$post_counts,$user_counts,$category_counts,$category_title];
            for($i = 0;$i <= 4 ;$i++){
            echo "['{$element_text[$i]}'".","."{$element_count[$i]}],";
            }
            ?>
        ]);

        var options = {
          chart: {
            title: ' ',
            subtitle: ' ',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  
    <div id="columnchart_material" style="width: 1000px; height: 500px;"></div>






</div>



       <div class="col-xs-6"> 
            <form action=""  method="POST">

            </form>
        </div> <!-- add category form -->
         <div class="col-xs-6">                   
          </div>
   </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    </div>

    <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php";  ?>
