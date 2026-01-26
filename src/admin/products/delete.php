<?php
include_once 'config your database';
$id=$_GET['id'];
$sql="DELETE FROM products WHERE id='$id'";
$result=mysqli_query($conn,$sql);
if(!$result){
    die("Delete failed: ".mysqli_error($conn));
}
header("Location:index.php");
?>