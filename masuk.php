<?php
session_start();
include "include/database.php";

$alert = "<br>";

if(isset($_POST["masuk"])){
    $nama = strtolower($_POST["nam"]);
    $sandi = $_POST["san"];

    $checkNam = mysqli_query($conn, "SELECT * FROM usertb WHERE nama = '$nama'");

    $existNam = mysqli_fetch_assoc($checkNam);

    if(empty(trim($nama)) || empty(trim($nama))){
        $alert = "Isi semua formulir";
    }
    elseif(mysqli_num_rows($checkNam) != 0){
        if(password_verify($sandi, $existNam["sandi"]) == 1){
            $_SESSION["user"] = $nama;
            header("location: index.php");
        }
        elseif(password_verify($sandi, $existNam["sandi"]) == 0){
            $alert = "Sandi anda salah";
        }
    }
    else{
        $alert = "Nama tidak terdaftar";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="include/jquery.js"></script>
    <link rel="stylesheet" href="css/frontline.css" type="text/css">
    <title>Masuk</title>
</head>
<body>
<style>img[alt="www.000webhost.com"]{display:none;}</style>
    <form method="post">
        <div class="LogBox">
            <div class="Lanjut">
                <a href="index.php">&#8678;</a>
            </div>

            <h1>Masuk ke Gallerium</h1>

            <h2>--Login ke akun agar bisa membagi dan menyimpan gambar--</h2>
            
            <h3>| Nickname Pengguna |</h3>  
            <div class="LogInp">         
                <input type="text" name="nam">
            </div>

            <h3>| Sandi Akun |</h3>
            <div class="LogInp">
                <input type="password" name="san" id="SI">
            </div>
                
            <input style="margin-top: 20px;" type="checkbox" onclick="ShowSandi('SI')"> Tampilkan sandi

            <p class="alertLog"><?=$alert;?></p>
            <button type="submit" id="si-Btn" name="masuk">Masuk</button>
            <span>Belum punya akun? <a href="daftar.php">daftar</a> sekarang!</span>

        </div>
    </form>
    <script src="javascript/backer.js"></script>
</body>
</html>