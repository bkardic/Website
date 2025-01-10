<?php

$host = "localhost";  
$ad = "root";         
$mesaj = "";         
$vt = "form";        


$baglan = mysqli_connect($host, $ad, $mesaj, $vt);


if (!$baglan) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

mysqli_set_charset($baglan, "UTF8");

?>
