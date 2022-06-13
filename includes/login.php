<?php ob_start(); ?>
<?php session_start();  ?>
<?php include "db.php";  ?>
<?php include "../admin/functions.php"; ?>

<?php 
        //login    
            if (isset($_POST["login"])) {
                $Form_User_Name = $_POST["username"];
                $Form_Password = $_POST["password"];
                
                echo $Form_User_Name." =Form_User_Name,  ";
                echo $Form_Password." =Form_Password,";

                //$Form_Password = password_hash($Form_Password,PASSWORD_BCRYPT,array('cost'=>12));

                $conn = getConnection();
                $Form_User_Name = escape($Form_User_Name);
                $Form_Password = escape($Form_Password);
                
                $select_users = "SELECT * FROM users WHERE username = '{$Form_User_Name}' ";
                $userNameResult = mysqli_query($conn, $select_users);
               
                print_r($userNameResult);

                if (!$userNameResult) {
                    die("query failed".mysqli_error($conn));
                }

                    while($row = mysqli_fetch_array($userNameResult)){
                        $db_username = $row["username"];
                        $db_user_password = $row["user_password"];
                        $db_user_role = $row["user_role"];
                        $db_user_firstname = $row["user_firstname"];
                        $db_user_lastname = $row["user_lastname"];

                        $Form_Password = crypt($Form_Password, $db_user_password);

                     if (password_verify($Form_Password, $db_user_password) && $Form_User_Name === $db_username) {
                        $_SESSION['username'] = $db_username;
                        $_SESSION['firstname'] = $db_user_firstname;
                        $_SESSION['lastname'] = $db_user_lastname;
                        $_SESSION['user_role'] = $db_user_role;
                        $_SESSION['password'] = $db_user_password;
                        header("Location:../admin");
                        } else {
                            header("Location:../admin");
                        }

                   
                            // if($Form_User_Name !== $db_username && $Form_Password !== $db_user_password){
                            //     $_SESSION['username'] = $db_username;
                            //     $_SESSION['firstname'] = $db_user_firstname;
                            //     $_SESSION['lastname'] = $db_user_lastname;
                            //     $_SESSION['user_role'] = $db_user_role;
                            //     $_SESSION['password'] = $db_user_password;
                            //     header("Location:../admin");
                            //  } else {
                            //     header("Location:../admin");
                            //  }


                    }

            }
       
    ?>


  
<?php //ob_end_flush(); //this should be last line of your page     ?>

