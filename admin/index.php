<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">
        <?php     
        $conn = getConnection();
        if($conn){echo "connected";} 
        
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
