<?php include "includes/admin_header.php"; ?>


<?php 

$conn = getConnection();
if(!is_admin($_SESSION['username'])){
    header("Lacotion:index.php");
} 


?>






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
                        <small>
                        <?PHP 
                        if(isset($_SESSION['user_role'])){
                        $username = $_SESSION['username'];
                        echo $username;
                        }?>
                        </small>
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                            $source = escape($_GET['source']);
                        }else{
                            $source = "";
                        }

                        switch($source){
                            case"add_user";
                            include "includes/add_user.php"; 
                            break;

                            case"edit_user";
                            include "includes/edit_user.php"; 
                            break;

                            default:
                            include "includes/view_all_users.php";
                            break;

                        }
                        
                       ?> 
                     </div>

                </div><!-- /.row -->
    </div><!-- /.container-fluid -->
            
</div><!-- /#page-wrapper -->

     
<?php include "includes/admin_footer.php";  ?>
