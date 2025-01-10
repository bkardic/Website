<?php 

include("baglan.php");

$mesaj_gonderildi = "";  

if (isset($_POST["gönder"])) {

   
    $name = $_POST["ad"];
    $mesaj = $_POST["mesaj"];

   
    $ekle = $baglan->prepare("INSERT INTO gb (ad, mesaj) VALUES (?, ?)");
    
    
    if ($ekle === false) {
        die('SQL sorgusu hazırlama hatası: ' . $baglan->error);
    }

   
    $ekle->bind_param("ss", $name, $mesaj);  

 
    if ($ekle->execute()) {
        $mesaj_gonderildi = '<div class="alert alert-info" role="alert">
                              Mesajınız başarıyla gönderildi.
                              </div>';
    } else {
        $mesaj_gonderildi = '<div class="alert alert-danger" role="alert">
                              Mesaj gönderilemedi. Hata: ' . $baglan->error . '
                              </div>';
    }

   
    $ekle->close();
    mysqli_close($baglan);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim</title>
    <link rel="stylesheet" href="../css/iletişim.css?v=1.0">
</head>
<body>

<header>
    <div class="container">
        <h1>İletişim</h1>
        <nav>
            <ul>
                <li><a href="index.php">Anasayfa</a></li>
                <li><a href="hakkında.php">Hakkında</a></li>
                <li><a href="turistik-yerler.php">Turistik Yerler</a></li>
                <li><a href="iletişim.php">İletişim</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="center-form">
    <br><br><br><br><br><br>
    <fieldset>
        <h3>İLETİŞİM FORMU</h3>

        <?php if ($mesaj_gonderildi != ""): ?>
            <div class="message-container">
                <?php echo $mesaj_gonderildi; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="iletişim.php">
            <div>
                <label for="ad"><b>Adınız:</b></label>
                <input type="text" name="ad" id="ad" required />
            </div>

            <br>

            <div>
                <label for="mesaj"><b>Mesajınız:</b></label><br>
                <textarea rows="6" name="mesaj" id="mesaj" cols="30" required></textarea>
            </div>

            <br>

            <div>
                <input type="reset" value="Temizle" /> 
                <input type="submit" name="gönder" value="Gönder" />
            </div>
        </form> 
    </fieldset>
</div>

</body>
</html>
