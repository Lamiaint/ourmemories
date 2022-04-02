<?php

function confirmQuery($queryResults){
    global $conn;
    if(!$queryResults){
        die(" failed to create_post_query ".mysqli_error($conn));
    }
}



function insert_categories(){
    if(isset($_POST['submit'])){
       // $conn = getConnection();
        global $conn;
        $title = $_POST['cat_title'];                          
        if($title == "" || empty($title)){
            echo "This field shoul not be empty";
        }else{
            $query = "INSERT INTO  categories(title)";
            $query .= "VALUE('{$title}')";
            $create_category_query = mysqli_query($conn,$query);
    
           echo "successful";
           if(!$create_category_query){
               die("failed to insert".mysqli_error($conn));
           }
        }                            
    }
}



function findAllCategories(){
    //$conn = getConnection();
    global $conn;
    $qeury = "select * from categories limit 5";
    $select_categories = mysqli_query($conn,$qeury); 
    while($qeuryResultsRow = mysqli_fetch_assoc($select_categories)){
    $cat_id = $qeuryResultsRow["id"];
    $cat_title = $qeuryResultsRow["title"];
     
    echo "<tr>";       
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
    }

}

function deleteCategories(){
    //$conn = getConnection();
    global $conn;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE id = {$the_cat_id} ";
        $delete_query = mysqli_query($conn,$query);
        header("Location:categories.php");
     }

}

















?>











