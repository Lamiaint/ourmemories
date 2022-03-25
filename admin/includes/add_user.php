
<?php
if(isset($_POST["create_user"])){
    //$user_name = $_POST["user_id"];
    $user_first_name = $_POST["user_first_name"]; 
    $user_last_name = $_POST["user_last_name"];
    $user_name = $_POST["user_name"];
    $user_role = $_POST["user_role"];
    
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES["image"]["tmp_name"];
    
    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];
   // $user_date = date('d-m-y');

   move_uploaded_file($user_image_temp,"../images/$user_image");

    $query = "INSERT INTO users(user_firstname,user_lastname,username,user_role,user_image,user_email,user_password)";
    $query .= "VALUES('{$user_first_name}','{$user_last_name}','{$user_name}','{$user_role}','{$user_image}','{$user_email}','{$user_password}')";

    global $conn;
    $create_post_query = mysqli_query($conn,$query); 
    confirmQuery($create_post_query);  

    echo "User Created:"."<a href='users.php'> View Users </a>";
}

?>

<form action="" method="post" enctype="multipart/form-data">
     <div class="form-group">
         <label for="User_First_Name">Firstname</label>
         <input type="text" class="form-control" name="user_first_name"> 
     </div>

     <div class="form-group">
         <label for="User_Last_Name">Lastname</label>
         <input type="text" class="form-control" name="user_last_name">
     </div>

     <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name">
     </div>

     <div class="form-group">
        <label for="user_image">Userimage</label>
        <input type="file"  name="image"> 
     </div>

     <div class="form-group">             
        <select name="user_role" id="">            
        <option value="subscriber">Select Options</option>  
        <option value="admin">Admin</option>
        <option value="guest">Guest</option>
        <option value="subscriber">Subscriber</option>
        </select>
    </div>

     <div class="form-group">
         <label for="user_email">Useremail</label>
         <input type="text" class="form-control" name="user_email"> 
     </div>

     <div class="form-group">
         <label for="user_password">Password</label>
         <input type="text" class="form-control" name="user_password"> 
     </div>

     <div class="form-group">
         <input class="btn btn-primary" type="submit" name="create_user" value="Add User"> 
     </div>

</form>
     