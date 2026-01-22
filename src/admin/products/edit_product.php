<?php 
$id =isset($_REQUEST)? $_REQUEST['id']:'';
$category_id=isset($_POST['category_id'])? $_POST['category_id']:'';  
$title=isset($_POST['title'])? $_POST['title']:''; 
$price=isset($_POST['price'])? $_POST['price']:''; 
$description=isset($_POST['description'])? $_POST['description']:''; 

include_once('config your database');
$sql="UPDATE `products` SET `category_id`='$category_id',`title`='$title',`price`='$price',`description`='$description' WHERE `id`='$id'";

$retval=mysqli_query($conn,$sql); 
if(!$retval){ 
    die('could not update '.mysqli_error($conn)); 
} 
include_once('index.php');
?>