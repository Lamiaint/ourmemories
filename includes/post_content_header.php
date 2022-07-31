<!-- Header -->
<header id="portfolio">
    <a href="#"><img src="" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">

    <!-- <h1><b>My Portfolio</b></h1> -->
    <div class="w3-section w3-bottombar w3-padding-16">
    <a class='w3-margin-right' href="index.php">首页 </a>  
                    <?php
                         $conn = getConnection();
                         $qeury = "select * from categories";
                         $qeuryResults = mysqli_query($conn,$qeury); 

                    while($qeuryResultsRow = mysqli_fetch_assoc($qeuryResults)){
                       
                    $cat_title = $qeuryResultsRow["title"];
                    $cat_id = $qeuryResultsRow["id"];
                    
                    //选中标识
                    // $category_class = '';

                    // $registration_class = '';

                    // $registration = 'registration.php';
                    
                    // $pageName = basename($_SERVER['PHP_SELF']);

                    // if(isset($_GET['category']) && $_GET['category'] ==$cat_id){

                    //   $category_class = 'active';

                    // }elseif($pageName == $registration){

                    //   $registration_class = 'active';

                    // }


                    if(!empty($cat_title) && !empty($cat_id ) ){
                       
                        echo " <a class='w3-margin-right' href='category.php?category=$cat_id'>{$cat_title }</a>";
                        
                    }
                                      
                    }
                    ?>                    
    </div>
    </div>
  </header>