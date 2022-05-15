 <?php
 /* 
//set DataBase Connection
function dataBase(){
    $db_host= "localhost";
    $db_user = "root";
    $db_pass = "";
    $dbdb_name = "ourmemories";
    $connection=mysqli_connect($db_host,$db_user,$db_pass,$dbdb_name);
    return $connection;
}
*/
 
/* 
Constance
foreach($db as $key=>$value){
    define(strtoupper($key),$value);
}
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if($connection){
    echo "connected";
}else{
    echo "failed to connect";
}
*/ 



//1. get db connection
function getConnection(){
  $db_host= "localhost";
  $db_user = "root";
  $charset="utf8mb4";
  $db_pass = "";
  $dbdb_name = "ourmemories";
  $connection=mysqli_connect($db_host,$db_user,$db_pass,$dbdb_name);
  return $connection;
}

//$conn = getConnection();




function qeuryNevigation(){
  global $conn;
//2.qeury data NevigationTitle from db
$qeury = "select * from categories";
    $qeuryResults = mysqli_query($conn,$qeury); 
        while($qeuryResultsRow = mysqli_fetch_assoc($qeuryResults)){
          $title = $qeuryResultsRow["title"];
          echo "<li><a href='#'>{$title }</a></li>";
        }
}





