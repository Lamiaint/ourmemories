<!DOCTYPE html>
<?php ob_start(); ?>
<?php  //session_start();  ?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <!-- <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="description" content="">
    <meta name="author" content="">
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
     

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/nevigation.php";?>
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
