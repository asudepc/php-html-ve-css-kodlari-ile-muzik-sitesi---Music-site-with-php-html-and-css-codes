<?php
include('connect_db.php');

// Kullanıcıyı silme işlemi
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['kullanici_adi'])) {
    $kullaniciAdi = $_GET['kullanici_adi'];

    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {

        if ($kullaniciAdi != 'root')
        {

        $sql = "DELETE FROM kullanici_tablosu WHERE kullanici_adi = '$kullaniciAdi'";
        $result = $conn->query($sql);

        if ($result) {
            echo '<script>
            alert("Kullanıcı başarıyla silindi.");
            window.location.href = "adminKullanici.php";
            </script>';
        } else {

            echo '<script>
            alert("Kullanıcı silinirken bir hata oluştu.");
            window.location.href = "adminKullanici.php";
            </script>';

        }
    }
    else {
        echo '<script>
            alert("ADMİN KULLANICISINI SİLEMEZSİN !!!");
            window.location.href = "adminKullanici.php";
            </script>';
    }
    }
}


?>