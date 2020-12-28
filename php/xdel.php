<?php
session_start();
include "../include/database.php";

$id = $_GET["id"];

$img = mysqli_query($conn, 
    "SELECT * FROM imagetb WHERE id = '$id'");
$res = mysqli_fetch_assoc($img);

unlink("../image/".$res['img']);

mysqli_query($conn, "DELETE FROM imagetb WHERE id = '$id'");
?>