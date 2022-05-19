<?php
if (isset($_GET["edit_user"])) {
    $edit_user_id = escape($_GET["edit_user"]);

    $query = "SELECT * FROM users WHERE user_id = '{$edit_user_id}' ";
    $select_user_id_query = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_user_id_query)) {
        $user_first_name = $row["user_firstname"];
        $user_last_name = $row["user_lastname"];
        $username = $row["username"];
        $user_email = $row["user_email"];
        $user_role = $row["user_role"];
        $db_user_image = $row["user_image"];
        $password = $row["user_password"];
    }

if(isset($_POST["edit_user"])){
    $user_first_name = escape($_POST["user_first_name"]);
    $user_last_name = escape($_POST["user_last_name"]);
    $username = escape($_POST["user_name"]);
    $user_email = escape($_POST["user_email"]);
   
        $user_image = escape($_FILES["image"]["name"]);
        $user_image_temp = escape($_FILES["image"]["tmp_name"]);
        move_uploaded_file($user_image_temp,"../images/$user_image");

    $user_role = escape($_POST["user_role"]);
    $user_password = escape($_POST["user_password"]);
    
    if(!empty($user_password)){
        $query_password = "SELECT user_password FROM users WHERE user_id = $edit_user_id ";
        $get_user_query = mysqli_query($conn,$query_password);
        confirmQuery($get_user_query );
        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row['user_password'];
        if($db_user_password !== $user_password){
           $hash_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>10));
        }
    }else{
        $hash_password = $password;
    }


    $qeury = "UPDATE users SET ";
    $qeury .= "user_firstname = '{$user_first_name}', ";
    $qeury .= "user_lastname ='{$user_last_name}', ";
    $qeury .= "username ='{$username}', ";
    $qeury .= "user_email ='{$user_email}', ";
    $qeury .= "user_role ='{$user_role}', ";
    $qeury .="user_password = '{$hash_password}', ";
    //$qeury .= "post_date = now(), ";
    $qeury .= "user_image ='{$user_image}'  ";
    $qeury .= "WHERE user_id = {$edit_user_id} ";

    $edit_user = mysqli_query($conn,$qeury);
    confirmQuery($edit_user);
    echo "User Edeted:"."<a href='users.php'> View Users </a>";
   
}
}else{
    header("location:index.php");

}
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
 
     <div class="form-group">
        <label for="user_image">Userimage</label>
        <input type='file'  name='image'> ;  
        <img width="50" src="../images/<?php  echo $db_user_image; ?>" alt="">
     </div>

     <div class="form-group">             
        <select name="user_role" id="">            
        <option value="subscriber">	Userrole Options</option>  
        <option value="admin">Admin</option>
        <option value="guest">Guest</option>
        <option value="subscriber">Subscriber</option>
        </select>
    </div>
 

     <!-- <div class="form-group">             
        <select name="user_role" id="">            
        <option value="<?php //echo $user_role;  ?>"><?php //echo $user_role;  ?></option>  
        <?php 
        // if($user_role == 'admin'){
        //     echo "<option value='subscriber'>subscriber</option>";
        // }else{
        //     echo "<option value='admin'>admin</option>";
        // } 
        ?>
        <option value="guest">guest</option>     
        </select>
    </div> -->

     <div class="form-group">
         <label for="user_email">Email</label>
         <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email"> 
     </div>

     <div class="form-group">
         <label for="user_password">Password</label>
         <input type="password" autocomplete="off" class="form-control" placeholder="请输入登陆密码" name="user_password"> 
     </div>

     <div class="form-group">
         <input class="btn btn-primary" type="submit" name="edit_user" value="Update User"> 
     </div>

</form>
 
     