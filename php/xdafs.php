<?php
include "../include/database.php";

$getNam = $_GET["nam"];

$existNam = mysqli_query($conn, "SELECT nama FROM usertb WHERE nama = '$getNam'");

if($getNam == null){
    echo("");
}
elseif(strlen($getNam) < 2 || strlen($getNam) > 24){
    echo("<a class='xMark'>&#10005;</a> Nama setidaknya 2 karakter dan maksimal 24 karakter");
}
elseif(preg_match('/[\'^£$%&*()}.`{@#~?"><>,|=_+¬-]/', $getNam)){
    echo("<a class='xMark'>&#10005;</a> Nama hanya boleh mengandung huruf A - Z dan angka");
}
elseif(mysqli_num_rows($existNam) != 0){
    echo("<a class='xMark'>&#10005;</a> Nama ".$getNam." telah digunakan");
}
else{
    echo("<a class='cMark'>&#10003;</a> Ok");
}

?>