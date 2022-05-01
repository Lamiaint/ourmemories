<?php include "includes/header.php"; ?>


    <div id="wrapper">
  
        <!-- Navigation -->
        <?php include "includes/nevigation.php";?>
        <?php     
        $conn = getConnection();
 
        if(!$conn){
            die("failed to connect DB");
        }       
        ?>
 
    <div id="page-wrapper">

    <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Wellcome
                        <small>    
                                <?PHP 
                        if(isset($_SESSION['user_role'])){
                        $username = $_SESSION['username'];
                        echo $username;
                        }?></small>
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                            $source = "";
                        }

                        switch($source){
                            case"add_post_index";
                            include "includes/add_post_index.php"; 

                           // add_posts_index.php?source=add_post_index
                            break;

                            // case"edit_post";
                            // include "includes/edit_post.php"; 
                            // break;

                            // case"delete_post";
                            // include "includes/delete_post.php"; 
                            // break;

                            // default:
                            // include "includes/view_all_posts.php";
                            // break;

                        }
                        
                       ?> 
                     </div>

                </div><!-- /.row -->
    </div><!-- /.container-fluid -->
            
</div><!-- /#page-wrapper -->

     
<?php include "includes/footer/footer.php";  ?>
