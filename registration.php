<?php  include "includes/header/header.php"; ?>
 <!-- Navigation -->
 <?php  include "includes/nevigation.php"; ?>


<?php
$conn = getConnection();
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($conn,$username);
    $email    = mysqli_real_escape_string($conn,$email);
    $password = mysqli_real_escape_string($conn,$password);

    $qeury = "SELECT randSalt FROM users";
    $select_randsalt_qeuery = mysqli_query($conn, $qeury);
    if(!$select_randsalt_qeuery ){
        die("Query Failed".mysqli_error($conn));
    }

        $row  = mysqli_fetch_array($select_randsalt_qeuery);
        $salt = $row['randSalt'];

        $qeury = "INSERT INTO users (username,user_email,user_password,user_role) ";
        $qeury .= "VALUES('{$username}','{$email}','{$password}','subscriber' )";
        $register_user_query = mysqli_query($conn,$qeury);
        if(!$register_user_query){
            die("Query Failed".mysqli_error($conn).''.mysqli_errno($conn));

        }

 




    
}?>
    
    <!-- Page Content -->
    <div class="container"> 
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

        <hr>

<?php include "includes/footer/footer.php";?>
