<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">
        <?php     
        $conn = getConnection();
 
        if(!$conn){
            die("failed to connect DB");
        }       
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
                            case"add_post";
                            include "includes/add_post.php"; 
                            break;

                            case"edit_post";
                            include "includes/edit_post.php"; 
                            break;

                            // case"delete_post";
                            // include "includes/delete_post.php"; 
                            // break;

                            default:
                            include "includes/view_all_posts.php";
                            break;

                        }
                        
                       ?> 
                     </div>

                </div><!-- /.row -->
    </div><!-- /.container-fluid -->
            
</div><!-- /#page-wrapper -->

     
<?php include "includes/admin_footer.php";  ?>
