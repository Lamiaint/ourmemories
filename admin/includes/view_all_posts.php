<?php
//POSTS多选项删除或添加
if(isset($_POST['chekBoxArray'])){
    $chekBoxArrays  = $_POST['chekBoxArray'];
    foreach ($chekBoxArrays as $postValueId) {
        $bulk_Oprions = escape($_POST['bulk_Oprions']);
        switch ($bulk_Oprions) {
           case 'published':
           $query = "UPDATE posts SET post_status = '$bulk_Oprions' WHERE post_id= {$postValueId}";
           $update_to_published_status = mysqli_query($conn, $query);
           confirmQuery($update_to_published_status);
           break;
                case 'draft':
                $query = "UPDATE posts SET post_status = '$bulk_Oprions' WHERE post_id= {$postValueId}";
                $update_to_draft_status = mysqli_query($conn, $query);
                confirmQuery($update_to_draft_status);
                break;
                    case 'delete':
                    $query = "DELETE FROM posts WHERE post_id= {$postValueId}";
                    $update_to_delete_status = mysqli_query($conn, $query);
                    confirmQuery($update_to_delete_status);
                    break;
                        case 'clone':
                        $query = "SELECT * FROM posts WHERE post_id= {$postValueId}";
                        $select_posts = mysqli_query($conn, $query);
                        while ($post_row = mysqli_fetch_assoc($select_posts)) {
                            $post_id = escape($post_row["post_id"]);
                            $post_user = escape($post_row["post_user"]);
                            $post_title = escape($post_row["post_title"]);
                            $post_category_id = escape($post_row["post_category_id"]);
                            $post_status = escape($post_row["post_status"]);
                           // $post_content = $post_content["post_content"];
                            $post_image = escape($post_row["post_image"]);
                            $post_tag = escape($post_row["post_tag"]);
                            $post_comment_count = escape($post_row["post_comment_count"]);
                            $post_date = escape($post_row["post_date"]);
                        }

                            $query = "INSERT INTO posts(post_category_id,post_title,post_author,
                            post_image,post_tag,post_date,post_status)";
                             $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}','{$post_image}',
                            '{$post_tag}',now(),'{$post_status}')";
                            $copy_query = mysqli_query($conn, $query);
                            if (!$copy_query) {
                                die("QUERY FAILED".mysqli_error($conn));
                            }
                            break; }
    }
}
?>

<form action="" class='text-center' method="POST">
<table class="=table table-bordered table-hover">
<div id="bulkOptionContainer" class="col-xs-4">
    <select class="form-control" name="bulk_Oprions" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
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
                <th>Users</th>
                <th>Post Title</th>
                <th>Post Category</th>
                <th>Post Status</th>
                <th>Post Image</th>
                <th>Post Tags</th>
                <th>Comments</th>
                <th>Post Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead> 
        <tbody>
    <?php

       //$conn = getConnection();
        $postResults = "SELECT * FROM posts ORDER BY post_id DESC";
        $select_posts = mysqli_query($conn,$postResults); 
            
        while ($post_row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $post_row["post_id"];
            $post_author = $post_row["post_author"];
            $post_user = $post_row["post_user"];
            $post_title = $post_row["post_title"];
            $post_category_id = $post_row["post_category_id"];
            $post_status = $post_row["post_status"];
            $post_image = $post_row["post_image"];
            $post_tag = $post_row["post_tag"];
            $post_comment_count = $post_row["post_comment_count"];
            $post_date = $post_row["post_date"];
            $post_views_count = $post_row["post_views_count"];
            echo "<tr>";
            ?>

            <td> <input class='checkBoxes' type='checkbox' name='chekBoxArray[]' value='<?php echo $post_id; ?>'></td>
            
            <?php
            echo "<td>{$post_id}</td>";            
            
            if(!empty($post_author)){
                echo "<td>{$post_author}</td>";
            }else{
                echo "<td>{$post_user}</td>";
            }
        
            echo "<td>{$post_title}</td>";
           // global $conn;
            //view_all_posts中的seasons
            $qeury = "SELECT * FROM categories WHERE id = {$post_category_id} ";
            $select_categories = mysqli_query($conn,$qeury); 
            while ($categoriesRow = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $categoriesRow["id"];
                $cat_title = $categoriesRow["title"];
                echo "<td class='text-center'>{$cat_title}</td>";
            }
            echo "<td>{$post_status}</td>";
            echo "<td><img width='80' src='../images/$post_image' alt='image'></td>";
            echo "<td>{$post_tag}</td>"; 
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $send_comment_query = mysqli_query($conn,$query);
            $rows = mysqli_fetch_array($send_comment_query);
            // if(!$rows){
            //    $comment_id="";      
            // }else{
            //     $comment_id = $rows['comment_id'];     
            // }
            $count_comments = mysqli_num_rows($send_comment_query);
            echo "<td><a href='post_comments.php?id={$post_id}'>{$count_comments}</a></td>";
        
            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete it?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>"; 
            echo "</tr>";
            
        }
        ?>
    </tbody>
</table>  
</form>  

<?php
//delete posts from Admin_view_all_posts
if(isset($_GET["delete"])){
    
    $the_post_id = escape($_GET["delete"]);
    $query = "DELETE FROM posts WHERE post_id = '{$the_post_id}' ";
    $delete_query = mysqli_query($conn,$query);
    header("Location:posts.php");
}


if (isset($_GET["reset"])) {

    $the_post_id = escape($_GET["reset"]);
    if ($_SERVER['REQUEST'] !=='POST') {
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =".mysqli_real_escape_string($conn, $_GET["reset"])."";
        $delete_query = mysqli_query($conn, $query);
        header("Location:posts.php");


    }
}
?>


