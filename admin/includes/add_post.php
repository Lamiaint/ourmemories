
<?php
if(isset($_POST["create_post"])){
    $post_category_id = escape($_POST["Post_Category"]);
    $post_title = escape($_POST["Post_Title"]);
    $post_user = escape($_POST["Post_User"]);
    $post_author = escape($_POST["post_author"]);
    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES["image"]["tmp_name"]);
    
    $post_content = escape($_POST["Post_Content"]);
    $post_tag = escape($_POST["Post_Tag"]);

    $post_date = escape(date('d-m-y'));
    $post_status = escape($_POST["Post_Status"]);
    move_uploaded_file($post_image_temp,"../images/$post_image");

    $query = "INSERT INTO posts(post_category_id,post_title,post_user,post_author,post_image,post_content,post_tag,post_date,post_status)";
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}','{$post_author}','{$post_image}',
   '{$post_content}','{$post_tag}',now(),'{$post_status}')";

   global $conn;
   $create_post_query = mysqli_query($conn,$query); 
   confirmQuery($create_post_query);  
   $the_post_id = mysqli_insert_id($conn);
  // echo $the_post_id;
   echo "<p class='bg-success'> Post Created :<a href='../post.php?p_id={$the_post_id}'> View The Post </a> </p>";
    
}

?>


<form action="" method="post" enctype="multipart/form-data">
     <div class="form-group">
         <label for="post_title">Post Title</label>
         <input type="text" class="form-control" name="Post_Title"> 
     </div>
 
     <div class="form-group">
     <label for="post_category">Post Category</label>
        <select name="Post_Category" id="post_category">
        <?php
        $qeury = "SELECT * FROM categories";
        $select_categories = mysqli_query($conn, $qeury);
        confirmQuery($select_categories);
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

    <div class="form-group">
         <label for="post author">Post Author</label>
         <input type='text' name='post_author' class='form-control' placeholder='Enter Your Username'>
     </div>

  
    

    <div class="form-group">
     <label for="post_user">Users</label>
        <select name="Post_User" id="post_user">
        <?php
        $qeury_users = "SELECT * FROM users";
        $select_users = mysqli_query($conn, $qeury_users);
        confirmQuery($select_users);
        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row["user_id"];
            $username = $row["username"];
            echo "<option value='{$username}'>{$username}</option>";
        }
        ?>                          
        </select>
    </div>



     <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image"> 
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
         <textarea class="form-control" name="Post_Content" id="summernote" cols="10" rows="10"></textarea>
     </div>


     <div class="form-group">
         <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post"> 
     </div>

</form>
     