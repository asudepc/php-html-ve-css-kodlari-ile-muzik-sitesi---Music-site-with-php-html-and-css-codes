<?php
if (isset($_GET['dosya'])) {
    $dosyaYolu = $_GET['dosya'];

    echo "<audio controls autoplay>
            <source src='$dosyaYolu' type='audio/mp3'>
          </audio>";
} else {
    echo "Müzik dosyası bulunamadı.";
}
?>
