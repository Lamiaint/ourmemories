
          <!-- edit category form -->
           <form action=""  method="POST">
                 <div class="form-group">
                            <label for="cat_title"> Edit Category </label> </label> 
                           <!-- <input  type="text" class="form-controll" name="cat_title"> -->
                            
                            <?php
                            if (isset($_GET["edit"])) {
                                $cat_id = escape($_GET["edit"]);                                    
                                //$conn = getConnection();
                                $qeury = "SELECT * FROM categories WHERE id = $cat_id";
                                $select_categories_id = mysqli_query($conn, $qeury);
                                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                   $cat_id = escape($row["id"]);
                                    $cat_title = escape($row["title"]);
                                   // if (isset($cat_title)) { echo $cat_title;}
                                    ?>
                                <input value="<?php if (isset($cat_title)) { echo $cat_title;}?>"
                                       type="text" class="form-controll" name="cat_title" > 

                                 
                                <?php  } }?>

                          <?php

                       //update query
                       if(isset($_POST['update_category'])){
                        $the_cat_title = escape($_POST["cat_title"]);
                        $query = "UPDATE categories SET title = '{$the_cat_title}' WHERE id = '$cat_id'";
                        $update_query = mysqli_query($conn,$query); 
                        if(!$update_query){
                            echo "query failed";
                        }
                        }
                           ?>  
               </div>



                            <div class="form-group">
    
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category" >
                            </div>
         </form>