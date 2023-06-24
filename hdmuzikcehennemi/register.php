<?php
session_start();
include('connect_db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['re_password'];

  if (preg_match('/\s/', $username)) {
    $_SESSION['registerErrorMsg'] = "Kullanıcı adı boşluk içeremez";
    header("Location: index.php?fonksiyon=calistir");
    exit();
    
} elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
    $_SESSION['registerErrorMsg'] = "Kullanıcı adı sadece Latin harflerini içerebilir";
    header("Location: index.php");
    exit();
}
 elseif (strlen($password) >= 8) {
  $_SESSION['registerErrorMsg'] = "Şifreniz en az 8 haneli olmalıdır.";
  header("Location: index.php");
  exit();
}



  if ($password != $confirmPassword) {
    $_SESSION['registerErrorMsg'] = "Şifreler eşleşmiyor";
  } else {
      $checkQuery = "SELECT * FROM kullanici_tablosu WHERE kullanici_adi = '$username'";
      $checkResult = $conn->query($checkQuery);

      if ($checkResult->num_rows > 0) {
        $_SESSION['registerErrorMsg'] = "Bu kullanıcı adı zaten kullanılıyor";
      } else {
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
          $kayitTarihi = date("Y-m-d H:i");

          $sql = "INSERT INTO kullanici_tablosu (kullanici_adi, sifre, kayit_tarihi) VALUES ('$username', '$hashedPassword', '$kayitTarihi')";

          if ($conn->query($sql) === TRUE) {
            $_SESSION['successMsg'] = "Kullanıcı başarıyla kaydedildi";
          } else {
            $_SESSION['registerErrorMsg'] = "Kayıt işlemi sırasında bir hata oluştu";
          }
      }
  }
  header("Location: index.php");
  exit();
}

?>