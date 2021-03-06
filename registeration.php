<?php  include "includes/header.php"; ?>
 <!-- Navigation -->
 <?php  include "includes/nevigation.php"; ?>


    <?php
    $conn = getConnection();
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $username = trim(escape($_POST['username']));
        $email    = trim(escape($_POST['email']));
        $password = trim(escape($_POST['password']));

        $error = ['username'=>'','email'=>'','password'=>''];

        if(strlen($username ) <4){
            $error['username'] ='Username needs to be longer';
        }

        if($username == ''){
            $error['username'] ='Username cannot be empty';
        }

        if(username_exists($username)){
            $error['username'] ='Username already exists,pick another one';
        }

        if($email == ''){
            $error['email'] ='Email cannot be empty';
        }

        if(email_exists($email)){
            $error['email'] ='Email already exists,<a href="index.php"> please login another one</a>';
        }

        if($password == ''){
            $error ['password'] = 'Password cannot be empty';

        }

        // foreach($error as $key =>$value){
        //     if(empty($value)){
        //         register_user($username,$email,$password);
        //     }
        // }//foreach

        foreach($error as $key =>$value){
            if(empty($value)){
                unset($error[$key]);
            }
        } 
 
        if(empty($error)){
            register_user($username, $email, $password);
            login_user($username, $password);
        }


        
    }?>
    
    <!-- Page Content -->
    <div class="container"> 
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Registeration</h1>
              
                    <form role="form" action="registeration.php" method="post" id="login-form" autocomplete="off">
                     <!-- 注册成功 -->
                    <!-- <h3 class="text-center"> <?php //echo $message;?> </h3> -->
                     <!-- 注册后登陆 -->
                    <!-- <h3 class="active_link"> <a href="index.php"> login </a></h3> -->
              
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                             placeholder="Enter Desired Username" autocomplete="on"
                             value="<?php echo isset($username)? $username :'' ;?>">
                             <p><?php echo isset($error['username'])? $error['username'] :'' ;?></p>
                        </div>

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                             placeholder="somebody@example.com" autocomplete="on"
                             value="<?php echo isset($email)? $email :'' ;?>">
                             <p><?php echo isset($error['email'])? $error['email'] :'' ;?></p>
                        </div>


                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            <p><?php echo isset($error['password'])? $error['password'] :'' ;?></p>
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

        <hr>

<?php include "includes/footer/footer.php";?>
