<?php include "includes/admin_header.php"; ?>


<div class="container main-container" role="main">
<div class="well">
	<div class="page-area">



    
<table class="=table table-bordered table-hover">
        <thead>
            <tr>
                <th> Id </th>
                <th> Author </th>
                <th> Comment </th>
                <th> Email </th>
                <th> Status </th>
                <th> In Response to </th>
                <th> Date </th>
                <th> Approve </th>
                <th> Unapprove </th>
                <th> Delete </th>
               <!-- <th> Edit </th>-->
            </tr>
        </thead> 
        <tbody>
    <?php

       $conn = getConnection();
       global $conn;

        if(isset($_GET['id'])){
           $post_id = escape($_GET['id']);

        
        $postResults = "SELECT * FROM comments WHERE comment_post_id =".mysqli_real_escape_string($conn,$post_id)."";
        $select_comments = mysqli_query($conn,$postResults); 
            
        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_date = $row['comment_date'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            
            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>"; 
            
           
            /*
            $qeury = "SELECT * FROM categories WHERE id = {$post_category_id} ";
            $select_categories = mysqli_query($conn,$qeury); 
            while ($categoriesRow = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $categoriesRow["id"];
                $cat_title = $categoriesRow["title"];
                echo "<td>{$cat_title}</td>";
            }
             */
           
            echo "<td>{$comment_email}</td>"; 
            echo "<td>{$comment_status}</td>"; 

            $query = "SELECT * FROM posts WHERE post_id = '{$comment_post_id}' ";
            $select_post_id_query = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($select_post_id_query)){
                $post_id = $row["post_id"];
                $post_title = $row["post_title"];
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>"; 

            }
  
            echo "<td>{$comment_date}</td>"; 
            echo "<td><a href='comments.php?approve=$comment_id '>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove=$comment_id '>Unapprove</a></td>";
            echo "<td><a href='post_comments.php?delete=$comment_id&comment_id&id=".$_GET['id']." '>Delete</a></td>";
            echo "</tr>";
            
        }
    }
        ?>
    </tbody>
</table>    

<?php

if(isset($_GET["approve"])){
    global $conn;
    $the_comment_id = escape($_GET["approve"]);
    $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = '{$the_comment_id}' ";
    $approve_comment_query = mysqli_query($conn,$query);
    header("Location:comments.php");
}

if(isset($_GET["unapprove"])){
    global $conn;
    $the_comment_id = escape($_GET["unapprove"]);
    $query = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id = '{$the_comment_id}' ";
    $approve_comment_query = mysqli_query($conn,$query);
    header("Location:comments.php");
}

if(isset($_GET["delete"])){
    global $conn;
    $the_comment_id = escape($_GET["delete"]);
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_query = mysqli_query($conn,$query);
    header("Location:post_comments.php?id=".$_GET['id']."");

}
?>



</div>
</div>
</div>




<?php include "includes/admin_footer.php"; ?>



