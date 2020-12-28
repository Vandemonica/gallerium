<?php
session_start();
include "include/database.php";

$selectImg = mysqli_query($conn, "SELECT * FROM imagetb ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/desktop.css" type="text/css">
    <link rel="stylesheet" href="css/mobile.css" type="text/css">
    <script src="include/jquery.js"></script>
    <title>Gallerium</title>
</head>
<body onresize="DinamicResize()">
    <!-- ================== Pop Image ============================== -->
    <!-- ini display none jadi nggak muncul diawal -->
    <div id="Pop" class="Pop">
        <button id="PopBtn">&#10005;</button>
        <div class="ImgPopBox">
            <img id="ImgPop">
        </div>
        <div class="ImgPopMisc">
            <h3 id="CaptPop"></h3>
            <p id="ByPop"></p>
        </div>
    </div>
    <!-- ======================== Penutup Pop ======================== -->

    <!-- ======================= Banner utama ======================== -->
    <div class="Banner">
        <div class="Judul">
            <h1>Gallerium</h1>
        </div>

        <nav id="NavBtn">&#9881;</nav>
        <!-- ====== Navigasi ====== -->
        <div id="Navigasi">
            <ul id="NavMenu">
                <!-- ==== jika sudah isset usernya(login)  ==== -->
                <?php if( @isset($_SESSION["user"]) ):?>
                    <li><a href="kirim.php">Posting</a></li>
                    <li><a href="akun.php">Akunku</a></li>
                    <li><a href="keluar.php">Log-Out</a></li>
                <!-- ============ jika belum ============= -->
                <?php else:?>
                    <li><a href="masuk.php">Log-In</a></li>
                <?php endif;?>
            </ul>
        </div>
        <!-- == Penutup Navigasi == -->
    </div>
    <!-- =================== Penutup Banner ======================= -->
    
    <!-- ============================ Sampul ======================== -->
    <div class="Sampul">
        <div class="Sambutan">
            <h2>Welcome To Gallerium</h2>
            <p>
                Jelajahi karya-karya di Gallery online Gallerium
                dan Dapatkan inspirasi dari berbagai pengguna
            </p>
        </div>
        <div class="BtnGabSek">
            <!-- Jika sudah isset -->
            <?php if( @isset($_SESSION["user"]) ):?>
                <p>"Dari User untuk User"</p>
            <!-- selain dari itu -->
            <?php else:?>
                <a href="daftar.php">Bergabung Sekarang</a>
            <?php endif;?>
        </div>
    </div>
    <!-- ====================== Penutup Sampul ======================== -->

    <!-- ======================= Gallery ============================= -->
    <div class="Galleri">
        <!-- Looping + fetch data Image -->
        <?php while($vex = mysqli_fetch_assoc($selectImg)):?>
            <!-- Lokalisasi variabel atau apapun ini.. -->
            <?php
                $id = $vex["id"];
                $img = $vex["img"];
                $by = $vex["by_user"];

                $user = @$_SESSION["user"];

                // query data marktb yg sudah di 'mark' oleh user
                $selectMark = mysqli_query($conn, 
                    "SELECT * FROM marktb WHERE img = '$id' AND by_user = '$user'");
            ?>
            <!-- ======== Postingan ======= -->
            <div class="Pos">
                <!-- Image box jika diclick memunculkan Pop image -->
                <div class="ImgBox" 
                    onclick="Open(<?=$id;?>, '<?=$img;?>');"
                    
                        >
                    <img src="image/<?=$img;?>">
                </div>
                <!-- ==== Misc(caption dan user) ==== -->
                <div class="ImgMisc">
                    <div class="Info">
                        <p id="by<?=$id;?>">
                            From: <?=$by;?>
                        </p>
                        <span id="cap<?=$id;?>">
                            <?=$vex['caption'];?>
                        </span>
                    </div>
                    <!-- jika sudah isset usernya(login) dan postingan belum di 'mark' -->
                    <?php if(@isset($_SESSION["user"]) && mysqli_num_rows($selectMark) == 0):?>
                        <!-- class = mark -->
                        <button class="Mark" id="Mark<?=$id;?>"
                            onclick="Mark(<?=$id;?>)">&#9734;
                        </button>

                    <!-- (if-else untuk Btn 'mark') Jika sudah isset dan postingan telah di 'mark' -->
                    <?php elseif(@isset($_SESSION["user"]) && mysqli_num_rows($selectMark) != 0):?>
                        <!-- class = marked -->
                        <button class="Marked" id="Mark<?=$id;?>"
                            onclick="Mark(<?=$id;?>)">&#9734;
                        </button>
                    <!-- Selain dari itu (kosongin aja) -->
                    <?php else:?>

                    <?php endif;?>
                </div>
                <!-- ======= Penutup Misc ======== -->
            </div>
            <!-- ===== Penutup postingan ======= -->
        <?php endwhile;?>
    </div>
    <!-- ==================== Penutup Gallery ====================== -->
    <script src="javascript/main.js"></script>
</body>

<script>
    function DinamicResize(){
        let _Nav = document.getElementById("Navigasi");

        if(window.innerWidth > 577){
            _Nav.style.display = "block";
        }
        else{
            _Nav.style.display = "none";
        }
    }
</script>

</html>