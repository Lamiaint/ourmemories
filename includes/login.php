<?php   include "db.php";  ?>
<?php  include "../admin/functions.php"; ?>
<?php  session_start();  ?>

<?php 
if(isset($_POST["login"])){
    $conn = getConnection();
    $Form_User_Name = escape($_POST["username"]);
    $Form_Password = escape($_POST["password"]);

    $select_users = "SELECT * FROM users WHERE username = '{$Form_User_Name}' ";
    $userNameResult = mysqli_query($conn,$select_users);
    $row = mysqli_fetch_array($userNameResult);
   
    if(!$userNameResult){
        die("query failed".mysqli_error($conn));
    }

    echo "Form_User_Name=".$Form_User_Name.", ";
    echo "Form_Password=".$Form_Password." ";

            if ($row) {
                $db_username = $row["username"];
                $db_user_password = $row["user_password"];
                $db_user_role = $row["user_role"];
                $db_user_firstname = $row["user_firstname"];
                $db_user_lastname = $row["user_lastname"];

                echo  "db_username=".$db_username." ";

                if (password_verify($Form_Password, $db_user_password) && $Form_User_Name == $db_username) {
                    $_SESSION['username'] = $db_username;
                    $_SESSION['firstname'] = $db_user_firstname;
                    $_SESSION['lastname'] = $db_user_lastname;
                    $_SESSION['password'] = $db_user_password;
                    $_SESSION['user_role'] = $db_user_role;
    
                    header("Location:../admin");
                } else {
                    header("Location:../admin");
                }
            }


        // echo  "db_username=".$db_username." ";
     


  
    }

?>



