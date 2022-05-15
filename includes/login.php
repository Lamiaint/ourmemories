<?php   include "db.php";  ?>
<?php  session_start();  ?>

<?php if(isset($_POST["login"])){
    $Form_User_Name = $_POST["username"];
    $Form_Password = $_POST["password"];
    
    $conn = getConnection();
    $Form_User_Name = mysqli_real_escape_string($conn,$Form_User_Name);
    $Form_Password = mysqli_real_escape_string($conn,$Form_Password);
    
    $select_users = "SELECT * FROM users WHERE username = '{$Form_User_Name}' ";
    $userNameResult = mysqli_query($conn,$select_users);
    if(!$userNameResult){
        die("query failed".mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($userNameResult)) {
        $db_username = $row["username"];
        $db_user_password = $row["user_password"];
        $db_user_role = $row["user_role"];
        $db_user_firstname = $row["user_firstname"];
        $db_user_lastname = $row["user_lastname"];
  
    }

    // $Form_Password = crypt($Form_Password,$db_user_password);
    
       if(password_verify($Form_Password,$db_user_password) && $Form_User_Name == $db_username){
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['password'] = $db_user_password;
               header("Location:../admin"); 

            // header("Location:../index.php");
        }else{
             //header("Location:../index.php");
              header("Location:../admin"); 

           



        }
    }

?>



