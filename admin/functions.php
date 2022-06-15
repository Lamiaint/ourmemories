<?php
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

  


?>


 