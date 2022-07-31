<table class="=table table-bordered table-hover">
        <thead>
            <tr>
                <th> Id </th>
                <th> Userinfo</th>
                <th> Username </th>
                <th> Firstname </th>
                <th> Lastname </th>
                <th> Useremail </th>
                <th> Userrole </th>  
                <th> userimage </th>  
                <th> Admin </th>
                <th> Describer </th>           
                <th> Edit </th> 
                <th> Delete </th>

               
            </tr>
        </thead> 
        <tbody>
    <?php

        $conn = getConnection();
        $postResults = "SELECT * FROM users ";
        $select_users = mysqli_query($conn,$postResults); 
            
        while ($user_row = mysqli_fetch_assoc($select_users)) {
            $user_id = $user_row["user_id"];
            $user_info = $user_row["user_info"];  
            $username = $user_row["username"];
            $user_firstname = $user_row["user_firstname"];
            $user_lastname = $user_row["user_lastname"];
            $user_email = $user_row["user_email"];
            $user_role = $user_row["user_role"];
            $user_image = $user_row["user_image"];
         
            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$user_info}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";    
            echo "<td><img width='80' src='../images/$user_image' alt='image'></td>";     

            $query = "SELECT * FROM users WHERE user_id = '{$user_id}' ";
            $select_user_id_query = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($select_user_id_query)){
                $user_id = $row["user_id"];
                $username = $row["username"];
            }

           echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
           echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
           echo "<td><a class='btn btn-info' href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
?>

           <form method="post">
            <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
            <?php echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>'; ?>
            </form>

            <?php
        //    echo "<td><a href='users.php?source=delete&delete=$user_id'>Delete</a></td>";
           echo "</tr>";           
        }
        ?>
    </tbody>
</table>    

<?php

// if(isset($_GET["Edit"])){
//     global $conn;
//     $user_id = $_GET["Edit"];
//     $query = "UPDATE users SET comment_status = 'approve' WHERE user_id = '{$user_id}' ";
//     $user_query = mysqli_query($conn,$query);
//     header("Location:users.php");
// }

//echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
//取key值
if(isset($_GET["change_to_admin"])){
    //global $conn;
    $the_user_id = escape($_GET["change_to_admin"]);
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
    $change_to_admin_query = mysqli_query($conn,$query);
    header("Location:users.php");
}

if(isset($_GET["change_to_sub"])){
    //global $conn;
    $the_user_id = escape($_GET["change_to_sub"]);
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
    $change_to_sub_query = mysqli_query($conn,$query);
    header("Location:users.php");
}


if(isset($_POST["delete"])){
    // global $conn;
    $user_role =  escape($_SESSION['user_role']);
        if($user_role == 'admin'){
            $user_id = mysqli_real_escape_string($conn,$_POST["user_id"]);
            $query = "DELETE FROM users WHERE user_id = '{$user_id}' ";
            $delete_query = mysqli_query($conn,$query);
            header("Location:users.php");
         }
      

}
?>












