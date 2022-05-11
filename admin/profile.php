<?php include "includes/admin_header.php"; ?>
<?php   
$conn = getConnection();        

if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_profile_query = mysqli_query($conn,$query);
    while($row = mysqli_fetch_array($select_user_profile_query)){
        //$user_id = $user_row["user_id"];
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $username = $row["username"];
        $user_email = $row["user_email"];
        $user_role = $row["user_role"];
        $password = $row["user_password"];
        //$user_image = $user_row["user_image"];
    }
}

?>

<?php
if(isset($_POST["edit_user"])){
    $user_first_name = $_POST["user_firstname"];
    $user_last_name = $_POST["user_lastname"];
    $user_name = $_POST["user_name"];
    $user_email = $_POST["user_email"];
    $user_role = $_POST["user_role"];
   // $user_password = $_POST["user_password"];
    $qeury = "UPDATE users SET ";
    $qeury .= "user_firstname = '{$user_first_name}', ";
    $qeury .= "user_lastname ='{$user_last_name}', ";
    $qeury .= "username ='{$user_name}', ";
    $qeury .= "user_email ='{$user_email}', ";
    $qeury .= "user_role ='{$user_role}' ";
   // $qeury .="user_password = '{$user_password}' ";
    $qeury .= "WHERE username = '{$username}' ";

    $edit_user = mysqli_query($conn,$qeury);
    confirmQuery($edit_user);
//echo $username;

}

?>

    <div id="wrapper">
        <?php     $conn = getConnection(); if(!$conn){die("failed to connect DB"); }        ?>
        <!-- Navigation -->
        <?php include "includes/admin_nevigation.php";?>
 
    <div id="page-wrapper">

    <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Wellcome to Admin
                            <small>                             
                            <?PHP 
                            if(isset($_SESSION['user_role'])){
                            $username = $_SESSION['username'];
                            echo $username;
                            }?>
                            </small>
                        </h1>

<div class="container main-container" role="main">
<div class="well">
<div class="page-area">                     
<form action="" method="post" enctype="multipart/form-data">
     <div class="form-group">
         <label for="user_firstname">Firstname</label>
         <input type="text" value="<?php echo $user_firstname ?>"class="form-control" name="user_firstname"> 
     </div>

     <div class="form-group">
         <label for="user_lastname">Lastname</label>
         <input type="text" value="<?php echo $user_lastname; ?>"  class="form-control" name="user_lastname">
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

<!-- 
     <div class="form-group">
         <label for="user_password">Password</label>
         <input  type="password" autocomplete="off" class="form-control" name="user_password"> 
     </div> -->


     <div class="form-group">
         <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile"> 
     </div>

</form>
</div>
</div>
</div>
                   
                     </div>

                </div><!-- /.row -->
    </div><!-- /.container-fluid -->
            
</div><!-- /#page-wrapper -->

     
<?php include "includes/admin_footer.php";  ?>
