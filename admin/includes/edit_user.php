<?php
if (isset($_GET["source"])) {
    $edit_user_id = $_GET["edit_user"];
}

$query = "SELECT * FROM users WHERE user_id = '{$edit_user_id}' ";
$select_user_id_query = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($select_user_id_query)) {
    $user_first_name = $row["user_firstname"];
    $user_last_name = $row["user_lastname"];
    $username = $row["username"];
    $user_email = $row["user_email"];
    $user_role = $row["user_role"];
    $user_password = $row["user_password"];
    $db_user_image = $row["user_image"];

 }

if(isset($_POST["edit_user"])){
    $user_first_name = $_POST["user_first_name"];
    $user_last_name = $_POST["user_last_name"];
    $username = $_POST["user_name"];
    $user_email = $_POST["user_email"];

   
        $user_image = $_FILES["image"]["name"];
        $user_image_temp = $_FILES["image"]["tmp_name"];
        move_uploaded_file($user_image_temp,"../images/$user_image");

    $user_role = $_POST["user_role"];
    $user_password = $_POST["user_password"];

    //加密
    $qeury = "SELECT randSalt FROM users";
    $randsalt_qeuery = mysqli_query($conn, $qeury);
    if(!$randsalt_qeuery ){
        die("Query Failed".mysqli_error($conn));
    }
        $row  = mysqli_fetch_array($randsalt_qeuery);
        $salt = $row['randSalt'];
        $salt_user_password = crypt($user_password,$salt);

    $qeury = "UPDATE users SET ";
    $qeury .= "user_firstname = '{$user_first_name}', ";
    $qeury .= "user_lastname ='{$user_last_name}', ";
    $qeury .= "username ='{$username}', ";
    $qeury .= "user_email ='{$user_email}', ";
    $qeury .= "user_role ='{$user_role}', ";
    $qeury .="user_password = '{$salt_user_password}', ";
    //$qeury .= "post_date = now(), ";
    $qeury .= "user_image ='{$user_image}'  ";
    $qeury .= "WHERE user_id = {$edit_user_id} ";

    $edit_user = mysqli_query($conn,$qeury);
    confirmQuery($edit_user);

    echo "User Edeted:"."<a href='users.php'> View Users </a>";
   
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
         <input type="text" value="<?php echo $user_password; ?>" class="form-control" name="user_password"> 
     </div>

     <div class="form-group">
         <input class="btn btn-primary" type="submit" name="edit_user" value="Update User"> 
     </div>

</form>
 
     