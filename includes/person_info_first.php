<!-- First Container -->
<div class="container-fluid bg-1 text-center">
<?php

$conn = getConnection();

 $userResults = "SELECT u.* FROM users u Where u.username = 'Lamia.Int' ";
 $select_users = mysqli_query($conn, $userResults);
 if ($user_row = mysqli_fetch_assoc($select_users)) {
     $username = $user_row["username"];
     $user_image = $user_row["user_image"];
     $user_info = $user_row["user_info"];
     echo " <h2 style='font-size:30px' class='margin'>Who Am I?</h2>";
     echo " <img src='images/$user_image'  width='345' height='345'>";
     echo "<p><p/>";
     echo "<h2 style='font-size:30px' >I'm an adventurer</h2>";
     echo "<p>一段在地球的旅程<p/>";  
     echo "<p>to be continue......<p/>"; 
 } 
?>

</div>

 
    
 