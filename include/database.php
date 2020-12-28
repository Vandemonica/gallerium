<?php
// panduan singkat:
// jika ingin menjalankan web cukup
// buat database 'gallerium' / terserah tapi ganti var $datb = "namaDatabaseAnda"
// tabel akan dibuatkan otomatis

$host = "localhost";
$user = "root";
$pass = "";
$datb = "gallerium";

$conn = mysqli_connect($host, $user, $pass, $datb);

$checkUserTb = mysqli_query($conn, "SELECT * FROM usertb");
$checkImgTb = mysqli_query($conn, "SELECT * FROM imagetb");
$checkMarkTb = mysqli_query($conn, "SELECT * FROM marktb");

if(empty($checkUserTb)){
    mysqli_query($conn, "CREATE TABLE usertb(
            id INT(14) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nama VARCHAR(24) NOT NULL,
            sandi TEXT NOT NULL
        );
    ");
}
if(empty($checkImgTb)){
    mysqli_query($conn, "CREATE TABLE imagetb(
            id INT(14) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            img TEXT NOT NULL,
            by_user VARCHAR(24) NOT NULL,
            caption VARCHAR(36) NOT NULL
        );
    ");
}
if(empty($checkMarkTb)){
    mysqli_query($conn, "CREATE TABLE marktb(
            img INT(14) NOT NULL,
            by_user VARCHAR(24) NOT NULL
        );
    ");
}

?>
