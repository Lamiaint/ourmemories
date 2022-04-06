<?php

if(isset($_POST['chekBoxArray'])){
    $chekBoxArrays  = $_POST['chekBoxArray'];
    foreach($chekBoxArrays as $postValueId ){
       $bulk_Oprions = $_POST['bulk_Oprions'];
       switch($bulk_Oprions){
           case 'published';
           $query = "UPDATE posts SET post_status = '$bulk_Oprions' WHERE post_id= {$postValueId}";
           $update_to_published_status = mysqli_query($conn,$query);
           confirmQuery($update_to_published_status );
           break;
                case 'draft';
                $query = "UPDATE posts SET post_status = '$bulk_Oprions' WHERE post_id= {$postValueId}";
                $update_to_draft_status = mysqli_query($conn,$query);
                confirmQuery($update_to_draft_status );
                break;
                    case 'delete';
                    $query = "UPDATE posts SET post_status = '$bulk_Oprions' WHERE post_id= {$postValueId}";
                    $update_to_delete_status = mysqli_query($conn,$query);
                    confirmQuery($update_to_delete_status );
                    break;      
       }
    }
}
?>

<form action="" method="POST">
<table class="=table table-bordered table-hover">
<div id="bulkOptionContainer" class="col-xs-4">
    <select class="form-control" name="bulk_Oprions" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
    </select>
</div>
<div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
</div>

        <thead>
            <tr>
             <th> <input id="selectAllBoxes" type="checkbox"></th>
                <th>Post Id</th>
                <th>Post Author</th>
                <th>Post Title</th>
                <th>Post Category</th>
                <th>Post Status</th>
                <th>Post Image</th>
                <th>Post Tags</th>
                <th>Post Comment Count</th>
                <th>Post Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead> 
        <tbody>
    <?php

       // global $conn;
        $postResults = "SELECT * FROM posts";
        $select_posts = mysqli_query($conn,$postResults); 
            
        while ($post_row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $post_row["post_id"];
            $post_author = $post_row["post_author"];
            $post_title = $post_row["post_title"];
            $post_category_id = $post_row["post_category_id"];
            $post_status = $post_row["post_status"];
            $post_image = $post_row["post_image"];
            $post_tag = $post_row["post_tag"];
            $post_comment_count = $post_row["post_comment_count"];
            $post_date = $post_row["post_date"];
            
            echo "<tr>";
            ?>

            <td> <input class='checkBoxes' type='checkbox' name='chekBoxArray[]' value='<?php echo $post_id; ?>'></td>
            
            <?php
            echo "<td>{$post_id}</td>"; 
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";


           // global $conn;
            //view_all_posts中的seasons
            $qeury = "SELECT * FROM categories WHERE id = {$post_category_id} ";
            $select_categories = mysqli_query($conn,$qeury); 
            while ($categoriesRow = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $categoriesRow["id"];
                $cat_title = $categoriesRow["title"];
                echo "<td>{$cat_title}</td>";
            }
            
           
            echo "<td>{$post_status}</td>";
            echo "<td><img width='80' src='../images/$post_image' alt='image'></td>";
            
            echo "<td>{$post_tag}</td>"; 
            echo "<td>{$post_comment_count}</td>";
           
            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
            
        }
        ?>
    </tbody>
</table>  
</form>  

<?php
//delete posts from Admin_view_all_posts
if(isset($_GET["delete"])){
    
  //  global $conn;
    $the_post_id = $_GET["delete"];
    $query = "DELETE FROM posts WHERE post_id = '{$the_post_id}' ";
    $delete_query = mysqli_query($conn,$query);
    header("Location:posts.php");
}
?>












