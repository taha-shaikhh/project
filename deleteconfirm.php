<?php
session_start();
include 'conn.php';
if ($_SESSION["user"] == "admin") {

    $pid = $_GET['pid'];
    $query = "DELETE FROM `product` WHERE pid = '$pid'";
    $result = mysqli_query($conn, $query);
    if($result){
            header("location:admin.php");
    }else{
        echo "<h2> There was some problem</h2>";
    }

    if(!$_SESSION["user"] == "admin"){
        header('location:db.php');
    }
    mysqli_close($conn);
}
?>