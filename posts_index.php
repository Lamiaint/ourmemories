<!DOCTYPE html>
<?php ob_start(); ?>
<?php  //session_start();  ?>
<?php  //include "includes/db.php"; ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <!-- <link rel="stylesheet" href="css/font-awesome.min.css"> -->
  

    <title>Blog Home - OurMemories</title>


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">


    <!--  add post text editor-->
    <link  href="css/summernote.css" rel="stylesheet"> 

    <!-- emojis -->
   <link href="css/emojionearea.min.css" rel="stylesheet" >
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
     

</head>

<body>
<div id="wrapper">
        <!-- Navigation -->
        <?php  include "includes/nevigation.php";?>
        <?php     
         //$conn = getConnection();
        if(!$conn){
            die("failed to connect DB");
        }       
        ?>
 
    <div id="page-wrapper">

    <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Wellcome
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                            $source = "";
                        }

                        switch($source){
                            case"add_post_index";
                            include "includes/add_post_index.php"; 
                            break;

                            case"edite_post_index";
                            include "includes/edite_post_index.php"; 
                            break;


                            //  case"delete_post";
                            //  include "includes/delete_post.php"; 
                            //  break;

                         


                            // default:
                            // include "index.php";
                            // break;

                        }
                        
                       ?> 
                     </div>

                </div><!-- /.row -->
    </div><!-- /.container-fluid -->
            
</div><!-- /#page-wrapper -->

     
<?php include "includes/footer/footer.php";  ?>
