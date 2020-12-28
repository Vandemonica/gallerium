<?php
session_start();
include "include/database.php";
$alert = "<br>";

if(isset($_POST["daftar"])){
    $nama = strtolower(htmlspecialchars(mysqli_real_escape_string($conn, trim($_POST["nam"]))));
    $san0 = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["san"]));
    $san1 = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["sanV"]));

    $checkNam = mysqli_query($conn, "SELECT nama FROM usertb WHERE nama = '$nama'");

    if(empty(trim($nama)) || empty(trim($san0))){
        $alert = "Isi semua formulir!";
    }
    elseif($san0 != $san1){
        $alert = "Kedua sandi tidak sama";
    }
    elseif(mysqli_num_rows($checkNam) != 0){
        $alert = "Nama telah digunakan";
    }
    elseif(strlen($nama) < 2 || strlen($nama) > 24){
        $alert = "Nama setidaknya 2 karakter dan Maksimal 24 karakter";
    }
    elseif(strlen($san0) < 8){
        $alert = "Sandi setidaknya 8 karakter";
    }
    elseif(preg_match('/[\'^£$%&*()}{@#~?"><>,|=_+¬-]/', $nama)){
        $alert = "Nama hanya boleh mengandung huruf A - Z dan angka";
    }
    else{
        $sandi = password_hash($san0, PASSWORD_BCRYPT);
        mysqli_query($conn, "INSERT INTO usertb(id, nama, sandi) 
                                    VALUES(null, '$nama', '$sandi')");
        $alert = "<span style='color: green;'>Registrasi berhasil!</span>";
        header("refresh:1;url=masuk.php");
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
    <title>Daftar</title>
</head>
<body>
<style>img[alt="www.000webhost.com"]{display:none;}</style>
    <form method="post" id="dafForm">
        <div class="LogBox">

            <h1>Daftar ke Gallerium</h1>

            <h2>--Buat akun untuk bergabung dengan kami--</h2>

            <h3>| Nickname Pengguna |</h3>
            <div class="LogInp">
                <input type="text" name="nam" id="NI">
                <span id="NP"></span>
            </div>

            <h3>| Sandi Akun |</h3>
            <div class="LogInp">
                <input type="password" name="san" id="SI" onkeyup="SanCheck('SI', 'SP')">
                <span id="SP"></span>
            </div>

            <h3>| Konfirmasi Sandi |</h3>
            <div class="LogInp">
                <input type="password" name="sanV" id="SIV" onkeyup="SanCheckV('SIV', 'SI', 'SPV')">
                <span id="SPV"></span>
            </div>

            <input style="margin-top: 20px;" type="checkbox" onclick="ShowSandi('SI', 'SIV')"> Tampilkan sandi

            <p class="alertLog"><?=$alert;?></p>
            <button type="submit" name="daftar" id="su-Btn">Daftar</button>
            <span>Sudah punya akun? <a href="masuk.php">masuk</a> sekarang!</span>

        </div>
    </form>
    <script src="javascript/daftar.js"></script>
    <script src="javascript/backer.js"></script>
</body>
</html>