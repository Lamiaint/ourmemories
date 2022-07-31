<?php include "includes/header.php"; ?>
 <!-- Navigation -->
 <?php include "includes/nevigation.php"; ?>
 
 <?php 

 if(isset($_POST['submit'])){
    $to      ="streamint@icloud.com";
    $subject =wordwrap($_POST['subject']);
    $body    =$_POST['body'];
    $header  = "Form:".$_POST['email'];
    //mail($to,$subject,$body,$header);

 }  
 
 
 ?>

    <!-- Page Content -->
    
 
    <div class="container">
        <div class="email-container">
            <div class="col-xs-3 col-xs-offset-3">
                <div class="form-wrap">
                   <h3>Contact</h3>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject">
                        </div>
                         <div class="form-group">
                             <textarea class="form-control" name="body" id="body" cols="30" rows="15"> </textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Email">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
 

        <hr>

<?php include "includes/footer/footer.php";?>
