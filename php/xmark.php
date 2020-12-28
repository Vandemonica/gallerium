<?php
session_start();

include "../include/database.php";

$user = $_SESSION["user"];
$id = $_GET["id"];

$checkPos = mysqli_query($conn, 
    "SELECT * FROM marktb WHERE img = '$id' AND by_user = '$user'");

switch (mysqli_num_rows($checkPos)) {
    case 0:
        mysqli_query($conn, 
        "INSERT INTO marktb(img, by_user) VALUES('$id', '$user')");
    break;
    
    default:
        mysqli_query($conn, 
        "DELETE FROM marktb WHERE img = '$id' AND by_user = '$user'");
    break;
}

?>