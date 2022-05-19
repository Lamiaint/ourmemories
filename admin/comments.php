<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">
        <?php     
        $conn = getConnection();
        
        //global $conn;
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
                            <small>Author Name</small>
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                            $source = escape($_GET['source']);
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

                            case"3";
                            echo"c";
                            break;

                            default:
                            include "includes/view_all_comments.php";
                            break;

                        }
                        
                       ?> 
                     </div>

                </div><!-- /.row -->
    </div><!-- /.container-fluid -->
            
</div><!-- /#page-wrapper -->

     
<?php include "includes/admin_footer.php";  ?>
