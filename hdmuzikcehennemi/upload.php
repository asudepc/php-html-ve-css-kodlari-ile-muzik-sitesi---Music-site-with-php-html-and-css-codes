<?php

include('connect_db.php');
session_start();

if (!empty($_POST['muzik_adi']) && !empty($_POST['sanatci']) && !empty($_FILES['dosya'])) {
    
    $muzikAdi = $_POST['muzik_adi'];
    $sanatci = $_POST['sanatci'];

    $dosyaYolu = "muzikler/"; 
    $dosyaAdi = $_FILES['dosya']['name'];
    $geciciDosya = $_FILES['dosya']['tmp_name'];
    $hedefDosya = $dosyaYolu . $dosyaAdi;
    $kadi =$_SESSION['username']; 

    if (move_uploaded_file($geciciDosya, $hedefDosya)) {
        $sql = "INSERT INTO muzikler (muzik_adi, sanatci, dosya_yolu, ekleyen_kullanici) VALUES ('$muzikAdi', '$sanatci', '$hedefDosya', '$kadi')";

        if ($conn->query($sql) === TRUE) {
            echo "Müzik başarıyla eklendi.";
        } else {
            echo "Müzik eklenirken hata oluştu: " . $conn->error;
        }
    } else {
        echo "Dosya yüklenirken hata oluştu.";
    }
} else {
    echo "Form gönderilirken eksik veya hatalı veri.";
}

$conn->close();

?>
