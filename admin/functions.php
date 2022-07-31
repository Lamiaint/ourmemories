<?php


function redirect($location){
    return header("Location".$location);

}

function escape($string){
    global $conn;
    return mysqli_real_escape_string($conn,trim($string));
}

function emptyInputSignup($username,$email,$password){
    //$result;


}




function users_online(){
    //    if (isset($_GET['onlineusers'])) {
        global $conn;
       if($conn){
        //    session_start();
        //    include("../includes/db.php");
        //    global $conn;
           
            $session = session_id();
            $time = time();
            $time_out_in_seconds =30;
            $time_out = $time - $time_out_in_seconds;
    
            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($conn, $query);
            $count = mysqli_num_rows($send_query);
                if ($count == null) {
                    mysqli_query($conn, "INSERT INTO users_online(session,time) VALUES('$session','$time')");
                } else {
                    mysqli_query($conn, "UPDATE users_online SET time = '$time' WHERE session= '$session'");
                    
                }
                $users_online_query = mysqli_query($conn, "SELECT * FROM users_online WHERE time >'$time_out'");
    
           // echo $count_user = mysqli_num_rows($users_online_query); //显示在线用户数量
       }

    // }//get request
}
users_online();

 

function confirmQuery($queryResults){
    global $conn;
    if(!$queryResults){
        die(" failed to create_post_query ".mysqli_error($conn));
    }
}



function insert_categories(){
    if(isset($_POST['submit'])){
       // $conn = getConnection();
      global $conn;
        $title = escape($_POST['cat_title']);                          
        if($title == "" || empty($title)){
            echo "This field shoul not be empty";
        }else{
            $query = "INSERT INTO  categories(title)";
            $query .= "VALUE('{$title}')";
            $create_category_query = mysqli_query($conn,$query);
    
           echo "successful";
           if(!$create_category_query){
               die("failed to insert".mysqli_error($conn));
           }
        }                            
    }
}



function findAllCategories(){
   
    global $conn;
    $qeury = "select * from categories ";//limit 5
    $select_categories = mysqli_query($conn,$qeury); 
    while($qeuryResultsRow = mysqli_fetch_assoc($select_categories)){
    $cat_id = $qeuryResultsRow["id"];
    $cat_title = $qeuryResultsRow["title"];
     
    echo "<tr>";       
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
    }

}

function deleteCategories(){
    
    global $conn;
    if(isset($_GET['delete'])){
        $the_cat_id = escape($_GET['delete']);
        $query = "DELETE FROM categories WHERE id = {$the_cat_id} ";
        $delete_query = mysqli_query($conn,$query);
        header("Location:categories.php");
     }

}



//ADMIN 图形展示
function recordCount($table){
    global $conn;
    $query = "SELECT * FROM ".$table;
    $select_all_post = mysqli_query($conn,$query);
    $results = mysqli_num_rows($select_all_post );
    return $results ;  


}


function checkStatus($stable,$column,$status){
    global $conn;
    $query = "SELECT * FROM $stable WHERE $column = '$status' ";
    $results = mysqli_query($conn,$query);
    return mysqli_num_rows($results);

}


function is_admin($username = ''){
     
    global $conn;
    $query = "SELECT user_role FROM users WHERE username = '{$username}' ";
    $results = mysqli_query($conn,$query);
    confirmQuery($results);

    $row = mysqli_fetch_assoc($results);

    if($row['user_role'] == 'admin'){
        return true;

    }else{
        return false;
    }

}



function username_exists($username){
    global $conn;
    $query = "SELECT username FROM users WHERE username = '{$username}' ";
    $results = mysqli_query($conn,$query);
    confirmQuery($results);
    if(mysqli_num_rows($results) > 0){
        return true;
    }else{
        return false;
    }
}

function email_exists($useremail){
    global $conn;
    $query = "SELECT user_email FROM users WHERE user_email = '{$useremail}' ";
    $results = mysqli_query($conn,$query);
    confirmQuery($results);
    if(mysqli_num_rows($results) > 0){
        return true;
    }else{
        return false;
    }
}




    function register_user($username,$email,$password){ 
        global $conn;
            if(username_exists($username) || email_exists($email)){
                $message = "username or useremail exist";

            }else{

                if (!empty($username) && !empty($email) && !empty($password)) {
                    $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
                    $qeury = "INSERT INTO users (username,user_email,user_password,user_role) ";
                    $qeury .= "VALUES('{$username}','{$email}','{$password}','subscriber' )";
                    $register_user_query = mysqli_query($conn, $qeury);
                    confirmQuery( $register_user_query);

                   // $message = "succsessful"; 

                } else {
                    $message = "fields can not be empty";
                }
            }
    }

    function login_user($username,$password){
        global $conn;

        $Form_Name = escape($username);
        $Form_Password = escape($password);
        $select_users = "SELECT * FROM users WHERE username = '{$Form_Name}' ";
        $userNameResult = mysqli_query($conn, $select_users);

        if(!$userNameResult){
            die("QUERY FAILED").mysqli_error($conn);

        }
              while ($row = mysqli_fetch_array($userNameResult)) {
                  $db_username = $row["username"];
                  $db_password = $row["user_password"];
                  $db_user_role = $row["user_role"];

                  if (password_verify($Form_Password,$db_password) && $Form_Name === $db_username && $db_user_role === 'admin') {
                      $_SESSION['username'] = $db_username;
                      $_SESSION['password'] = $db_password;
                      $_SESSION['user_role'] = $db_user_role;
              
                       header("Location:../admin");
                    //   redirect("/OurMemories/admin");
                     
                       
                  }else{
                     
                     header("Location:../index.php");
                    // redirect("/OurMemories/index.php");
                      
                  }
              }
    }



  


?>


 