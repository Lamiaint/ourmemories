<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">
        <?php     
        $conn = getConnection();
        if($conn){echo "conn";}       
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

                        <?php
                        //添加转移到functions.php
                        insert_categories();
                        ?>

                        <!--add category form-->
                        <form action=""  method="POST">
                             <div class="form-group">
                                <label for="cat-title"> Add Category </label>
                                 <input  type="text" class="form-controll" name="cat_title">
                              </div>
                              <div class="form-group">
                                 <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                              </div>
                        </form>

                        <?php
                        //表单移到includes/update_categories.php  
                        if(isset($_GET["edit"])){
                            $cat_id = $_GET["edit"];
                            include "includes/update_categories.php";
                        }
                        ?>
                </div> <!-- add / edit /update category -->


                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //find categories
                                //查询转移到functions.php
                                findAllCategories();
                                ?>

                                <?php
                                //delete 
                                //删除转移到functions.php
                                deleteCategories();
                                ?>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
                <!-- /.row -->

        </div>
            <!-- /.container-fluid -->

    </div>

        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php";  ?>
