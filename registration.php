<?php  include "includes/header.php"; ?>
 <!-- Navigation -->
 <?php  include "includes/nevigation.php"; ?>


<?php
$conn = getConnection();
if(isset($_POST['submit'])){
    $username = escape($_POST['username']);
    $email    = escape($_POST['email']);
    $password = escape($_POST['password']);
    if(!empty($username) && !empty( $email) && !empty($password )){
 
    $password = password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));

        $qeury = "INSERT INTO users (username,user_email,user_password,user_role) ";
        $qeury .= "VALUES('{$username}','{$email}','{$password}','subscriber' )";
        $register_user_query = mysqli_query($conn,$qeury);
        if(!$register_user_query){
            die("Register_User_Query Failed".mysqli_error($conn).''.mysqli_errno($conn));
        }  
        $message = "succsseful";

    }else{ 
        $message = "fields can not be empty";}
    
}else{  
    $message = "";}?>
    
    <!-- Page Content -->
    <div class="container"> 
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
              
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                     <!-- 注册成功 -->
                    <h3 class="text-center"> <?php echo $message;?> </h3>
                     <!-- 注册后登陆 -->
                    <h3 class="active_link"> <a href="index.php"> login </a></h3>
              
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
