<?php
session_start();
include "include/database.php";

$alert = "<br>";

if(isset($_POST["upload"])){
    $imgName = $_FILES["gambar"]["name"];
    $imgSize = $_FILES["gambar"]["size"];
    $imgTmp = $_FILES["gambar"]["tmp_name"];
    $imgCapt = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["caption"]));
    $user = $_SESSION["user"];

    $ekstensi = array("jpg", "png", "jpeg");
    $ranHash = mt_rand(0, 1000);

    $divider = explode(".", $imgName);
    $imgFormat = strtolower(end($divider));
    
    if(strlen($imgCapt) > 23){
        $alert = "Maksimal caption 24 karakter";
    }

    if(in_array($imgFormat, $ekstensi)){
        if($imgSize < 2097152){

            $img = $ranHash.$imgName;
            
            move_uploaded_file($imgTmp, "image/".$img);

            mysqli_query($conn, "INSERT INTO imagetb(id,img,by_user,caption) VALUES(null,'$img','$user','$imgCapt')");

            header("location: index.php");
        }
        else{$alert = "Maksimal ukuran 2mb";}
    }
    else{$alert = "Format diperbolehkan hanya JPG, PNG, JPEG";}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <title>Upload</title>
</head>
<body>
<style>img[alt="www.000webhost.com"]{display:none;}</style>
    <div class="Upload">
        <form enctype="multipart/form-data" method="POST">
            <input type="file" name="gambar">
            <input type="text" name="caption" class="CaptInp">
            <button type="submit" name="upload">Upload</button>
        </form>
        <?=$alert;?>
    </div>
</body>
</html>