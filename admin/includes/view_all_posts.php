<?php
include("delete_modal.php");

//POSTS多选项删除或添加
if(isset($_POST['chekBoxArray'])){
    $chekBoxArrays  = $_POST['chekBoxArray'];
    foreach ($chekBoxArrays as $postValueId) {
        $bulk_Oprions = $_POST['bulk_Oprions'];
        switch ($bulk_Oprions) {
           case 'published':
           $query = "UPDATE posts SET post_status = '{$bulk_Oprions}' WHERE post_id= {$postValueId}";
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
                            // $post_id = $post_row["post_id"];
                            $post_user = $post_row["post_user"];
                            $post_author = $post_row["post_author"];
                            $post_title = $post_row["post_title"];
                            $post_category_id = $post_row["post_category_id"];
                            $post_status = $post_row["post_status"];
                            $post_content = substr($post_row["post_content"],0,200);//substr($row["post_content"], 0, 600);
                            $post_image = $post_row["post_image"];
                            $post_video = $post_row["post_video"];
                            $post_tag = $post_row["post_tag"];
                            $post_comment_count = $post_row["post_comment_count"];
                            $post_date = $post_row["post_date"];
                            if(empty($post_tag)){
                                $post_tag ='no  post_tag';

                            }
                        }

                    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_user,post_image,post_video,post_content,post_tag,post_date,post_status) ";
                    $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}','{$post_user}','{$post_image}','{$post_video}','{$post_content}','{$post_tag}',now(),'{$post_status}')";
                    
                
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
  //view all posts SQL
        $postResults = "SELECT p.*,c.* FROM posts p ";
        $postResults .= "LEFT JOIN categories c  ON p.post_category_id = c.id ORDER BY post_id DESC ";
      
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

            $cat_id = $post_row["id"];
            $cat_title = $post_row["title"];
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
            echo "<td class='text-center'>{$cat_title}</td>";
            
            echo "<td>{$post_status}</td>";
            echo "<td><img width='80' src='../images/$post_image' alt='image'></td>";
            echo "<td>{$post_tag}</td>"; 
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $send_comment_query = mysqli_query($conn,$query);
            $rows = mysqli_fetch_array($send_comment_query);
            $count_comments = mysqli_num_rows($send_comment_query);
            echo "<td><a href='post_comments.php?id={$post_id}'>{$count_comments}</a></td>";
        
            echo "<td>{$post_date}</td>";
            echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            ?>

            <form method="post">
            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
            <?php echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>'; ?>
            </form>


           <?php
            
            // echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
            
            //echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete it?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
            
            echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>"; 
            echo "</tr>";
            
        }
        ?>
    </tbody>
</table>  
</form>  

            <?php
            //delete posts from Admin_view_all_posts
            if(isset($_POST["delete"])){
                
                $the_post_id = escape($_POST["post_id"]);
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

<script>


$(document).ready(function() {
    $(".delete_link").on('click',function(){

        var id = $(this).attr("rel");

        var delete_url = "posts.php?delete="+ id +" ";

        $(".modal_delete_link").attr("href",delete_url);

        $("#myModal").modal('show');


 
    });

 
});


</Script>








