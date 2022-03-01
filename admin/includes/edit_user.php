<?php
if (isset($_GET["source"])) {
    $edit_user_id = $_GET["edit_user"];
}

global $conn;
$query = "SELECT * FROM users WHERE user_id = '{$edit_user_id}' ";
$select_user_id_query = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($select_user_id_query)) {
    $user_first_name = $row["user_firstname"];
    $user_last_name = $row["user_lastname"];
    $username = $row["username"];
    $user_email = $row["user_email"];
    $user_role = $row["user_role"];
    $user_password = $row["user_password"];
 }

if(isset($_POST["edit_user"])){
    global $conn;
    $user_first_name = $_POST["user_first_name"];//
    $user_last_name = $_POST["user_last_name"];//
    $username = $_POST["user_name"];//
    $user_email = $_POST["user_email"];//
    //$post_image = $_FILES["image"]["name"];//
   // $post_image_temp = $_FILES["image"]["tmp_name"];//
    $user_role = $_POST["user_role"];//
    $user_password = $_POST["user_password"];//
   // move_uploaded_file($post_image_temp,"../images/$post_image");
    // if(empty($post_image)){
    //     $qeury = "SELECT * FROM posts WHERE post_id = {$p_id} ";
    //     $select_image = mysqli_query($conn,$qeury);
    //     while($row = mysqli_fetch_array($select_image)){
    //         $post_image = $row['post_image'];
    //     }
    // }

    $qeury = "UPDATE users SET ";
    $qeury .= "user_firstname = '{$user_first_name}', ";
    $qeury .= "user_lastname ='{$user_last_name}', ";
    $qeury .= "username ='{$username}', ";
    $qeury .= "user_email ='{$user_email}', ";
    $qeury .= "user_role ='{$user_role}', ";
    $qeury .="user_password = '{$user_password}' ";
    //$qeury .= "post_date = now(), ";
    //$qeury .= "post_image ='{$post_image}'  ";
    $qeury .= "WHERE user_id = {$edit_user_id} ";

    $edit_user = mysqli_query($conn,$qeury);
    confirmQuery($edit_user);
   
}
    // $user_image = $_FILES['image']['name'];
    // $user_image_temp = $_FILES["image"]["tmp_name"];
    
   // $user_date = date('d-m-y');
   // move_uploaded_file($post_image_temp,"../images/$user_image");

?>

<form action="" method="post" enctype="multipart/form-data">
     <div class="form-group">
         <label for="User_First_Name">Firstname</label>
         <input type="text" value="<?php echo $user_first_name ?>"class="form-control" name="user_first_name"> 
     </div>

     <div class="form-group">
         <label for="User_Last_Name">Lastname</label>
         <input type="text" value="<?php echo $user_last_name; ?>"  class="form-control" name="user_last_name">
     </div>

     <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="user_name">
     </div>
<!--
     <div class="form-group">
        <label for="user_image">Userimage</label>
        <input type="file"  name="image"> 
     </div>
-->

     <div class="form-group">             
        <select name="user_role" id="">            
        <option value="subscriber"><?php echo $user_role;  ?></option>  
        <?php 
        if($user_role == 'admin'){
            echo "<option value='subscriber'>subscriber</option>";
        }else{
            echo "<option value='admin'>admin</option>";
        } 
        ?>
        <option value="guest">guest</option>     
        </select>
    </div>


     <div class="form-group">
         <label for="user_email">Useremail</label>
         <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email"> 
     </div>


     <div class="form-group">
         <label for="user_password">Password</label>
         <input type="text" value="<?php echo $user_password; ?>" class="form-control" name="user_password"> 
     </div>

     <div class="form-group">
         <input class="btn btn-primary" type="submit" name="edit_user" value="Update User"> 
     </div>

</form>
 
     