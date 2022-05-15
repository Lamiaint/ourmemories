<?php  include "./admin/functions.php"; ?>

<?php
if(isset($_GET["p_id"])){
    $p_id = escape($_GET["p_id"]);
    $postResults = "SELECT * FROM posts WHERE post_id = $p_id";
    $select_posts = mysqli_query($conn,$postResults); 

    if($post_row = mysqli_fetch_assoc($select_posts)) {
    $post_id = $post_row["post_id"];
    $post_author = $post_row["post_author"];
    $post_user = $post_row["post_user"];
    $post_title = $post_row["post_title"];
    $post_category_id = $post_row["post_category_id"];
    $post_status = $post_row["post_status"];
    $post_image = $post_row["post_image"];
    $post_tag = $post_row["post_tag"];
    $post_content = $post_row["post_content"];
    $post_comment_count = $post_row["post_comment_count"];
    $post_date = $post_row["post_date"];
   }
}

if(isset($_POST["edite_post"])){
    $post_author = escape($_POST["post_author"]);
    $post_user = escape($_POST["post_user"]);
    $post_title = escape($_POST["Post_Title"]);
    $post_category_id = escape($_POST["Post_Category"]);
    $post_status = escape($_POST["Post_Status"]);
    $post_image = escape($_FILES["image"]["name"]);
    $post_image_temp = escape($_FILES["image"]["tmp_name"]);
    $post_content = escape($_POST["Post_Content"]);
    $post_tag = escape($_POST["Post_Tag"]);
    move_uploaded_file($post_image_temp,"../images/$post_image");
    if(empty($post_image)){
        $qeury = "SELECT * FROM posts WHERE post_id = {$p_id} ";
        $select_image = mysqli_query($conn,$qeury);
        while($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
        }
    }

    $qeury = "UPDATE posts SET ";
    $qeury .= "post_title = '{$post_title}', ";
    $qeury .= "post_author = '{$post_author}', ";
    $qeury .= "post_user = '{$post_user}', ";
    $qeury .= "post_category_id ='{$post_category_id}', ";
    $qeury .= "post_status ='{$post_status}', ";
    $qeury .= "post_tag ='{$post_tag}', ";
    $qeury .= "post_content ='{$post_content}', ";
    $qeury .= "post_date = now(), ";
    $qeury .= "post_image ='{$post_image}'  ";
    $qeury .= "WHERE post_id ={$p_id} ";
    $update_post = mysqli_query($conn,$qeury);
    confirmQuery($update_post);
    // echo "<p class='bg-success'> Post Updated :<a href='../post.php?p_id={$p_id}'> View The Post </a> </p>";
    // echo "<p class='bg-green'> Post Created. <a href='posts.php'> Edit More Posts </a> </p>";

    echo "<p class='bg-success'> Post Updated :<a href='post.php?p_id={$p_id}'> View The Post </a> </p>";
}

?>

<div class="container main-container" role="main">
<div class="well">
	<div class="page-area">
    <form action="" method="post" enctype="multipart/form-data">

     <div class="form-group">
         <label for="post_title">Post Title</label>
         <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="Post_Title">     
     </div>
    
 
     <div class="form-group">
     <label for="post_category">Post Category</label>
        <select name="Post_Category" id="post_category">
        <?php
        $qeury = "SELECT * FROM categories";
        $select_categories = mysqli_query($conn, $qeury);
        while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row["id"];
            $cat_title = $row["title"];
            echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
         ?>
         
                       
        </select>
    </div>

    <div class="form-group">
     <label for="post_status">Post Status</label> 
        <select name="Post_Status" id="published"> 
         <option value='draft'> Draft</option> ;
         <option value='published'> Published</option> ;
        </select>
    </div>

     <div class="form-group"><!--//用户名不登陆可以发POST -->
         <label for="post_author">Post Author</label>
         <input type='text' name='post_author' class='form-control' placeholder='输入你喜欢的名字...'>
         <?php
            // if(isset($_SESSION['username'])){
            //     echo "<input type='text' name='post_author' value='{$username}' class='form-control'>";          
            //   }else{
                // echo "<input type='text' name='post_author' class='form-control' placeholder='输入你喜欢的名字...'>";  
                             
            //   } ?>        
     </div>


     <div class="form-group">
         <label for="post_user">Post User</label>
         <input type='text' name='post_user' placeholder='Enter Your Username' class='form-control'>
     </div>

     <div class="form-group">
         <label for="post_image">Post Image</label>
         <input type="file"  name="image"> 
         <img class="img-responsive" width="100" src="images/<?php echo $post_image; ?>" alt="">
          
     </div>

     <div class="form-group">
         <label for="post_tag">Post Tag</label>
         <input type="text" class="form-control" name="Post_Tag"> 
     </div>

     <div class="form-group">
         <label for="post_comment_count">Post Comment Count</label>
         <input type="text" class="form-control" name="Post_Comment_Count"> 
     </div>

     <div class="form-group">
         <label for="summernote">Post Content</label>
         <textarea class="form-control"  name="Post_Content" id="summernote" cols="10" rows="10"><?php echo $post_content ?></textarea>
     </div>


     <div class="form-group">
         <input class="btn btn-primary" type="submit" name="edite_post" value="Edite Post"> 
     </div>

</form>
</div>
</div>
</div>
     