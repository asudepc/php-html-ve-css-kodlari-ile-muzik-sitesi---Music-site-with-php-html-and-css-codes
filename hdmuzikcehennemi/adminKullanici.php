<!DOCTYPE html>
<html lang="en">
<head>
<title>hdmuzikcehennemi</title>
<meta charset="utf-8">
<link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script src="js/jquery-1.8.0.min.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/functions.js"></script>
<style>
    .form-container {
      display: none;
    }
    .kutu {
      background: url(css/images/widget-title.png) ; height: 53px; line-height: 43px; padding-left: 10px;
      background-size:100%;
    width: 500px;
    height:auto;
    margin-bottom:10px;
    font-size:17px;
    float:left;
}



.kullanici-listesi {
  background: url(css/images/widget-title.png) ; height: 53px; line-height: 43px; padding-left: 10px;
      background-size:100%;
    width: 500px;
    height:auto;
    margin-bottom:10px;
    font-size:17px;
    float:left;
        }
        .duzenle-form {
            display: none;

        }
header {
  overflow: hidden;
}

.kullanici-listesi a{
  font-size:15px;
}

.kutu2 {
  float:right;
}




    </style>
</head>




<?php

include('connect_db.php');




?>



<body>
<div id="wrapper">
  <div class="light-bg">
    <div class="shell">
      <div class="header">
        <h1 id="logo"><a href="index.php">hdmuzikcehennemi</a></h1>
        <nav id="navigation">
        <ul>
            <li><a href="muzikler.php">MÜZİKLER</a></li>
            <li><a href="hakkimizda.php">HAKKIMIZDA</a></li>
            <li><a href="admin.php">ADMİN</a></li>
            <li><a href="profile.php">PROFİL</a></li>
          </ul>
        </nav>
      </div>
      
      <div class="main">

        <section class="content" style="margin-top:50px; float:right;width:650px; ">
        
          <div class="post" style="padding:20px;padding:20px 30px; text-align:center;font-size:18px;">
          
            <h2 style="font-size:23px">Kullanıcı Listesi</h2>
            <div class="post-inner" style="margin-top:18px;margin-bottom:30px;padding:40px; text-align:left; ">
              <header>
              <?php
// Kullanıcı adı güncelleme işlemini kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kullanici_adi']) && isset($_POST['eski_kullanici_adi'])) {
  // Formdan kullanıcı adını ve eski kullanıcı adını al
  $kullaniciAdi = $_POST['kullanici_adi'];
  $eskiKullaniciAdi = $_POST['eski_kullanici_adi'];


  // Kullanıcı adının veritabanında olup olmadığını kontrol et
  $sql = "SELECT COUNT(*) AS count FROM kullanici_tablosu WHERE kullanici_adi = '$kullaniciAdi'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $kullaniciSayisi = $row['count'];

  // Kullanıcı adı veritabanında yoksa güncelleme yap
  if ($kullaniciSayisi == 0) {


   if (preg_match('/\s/', $kullaniciAdi)) {
      $_SESSION['registerErrorMsg'] = "<vrt style='color:red'>Kullanıcı adı boşluk içeremez</vrt><br>";
      echo $_SESSION['registerErrorMsg'];
      
  } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $kullaniciAdi)) {
      $_SESSION['registerErrorMsg'] = "<vrt style='color:red'>Kullanıcı adı sadece Latin harflerini içerebilir</vrt><br>";
      echo $_SESSION['registerErrorMsg'];
  }

  elseif (strlen($kullaniciAdi) < 4)
{
  echo '<script>if (confirm("Kullanıcı adı 4 karakter veya fazla olmalıdır.")) {
    window.location.href = "adminKullanici.php";
  }      
  </script>';
}
else {
    // Veritabanında mevcut kullanıcı adını yeni kullanıcı adıyla değiştir
    $sql = "UPDATE kullanici_tablosu SET kullanici_adi = '$kullaniciAdi' WHERE kullanici_adi = '$eskiKullaniciAdi'";
    $result = $conn->query($sql);

    if ($result) {
      // Kullanıcı adı başarıyla güncellendiğini bildir
      echo '<span style="color:Green">Kullanıcı adı başarıyla güncellendi.</span>';

    } else {
      // Güncelleme başarısız olduğunu bildir
      echo '<vrt style="color:red">Kullanıcı adı güncellenirken bir hata oluştu.</vrt><br>';
    }
  }

  } else {
    echo '<vrt style="color:red">Bu kullanıcı adı zaten kullanılıyor.</vrt><br>';
  }
}

// Kullanıcıları veritabanından çek
function getKullanicilar()
{
  global $conn;

  $sql = "SELECT * FROM kullanici_tablosu ORDER BY kayit_tarihi DESC ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $kullanicilar = array();
    while ($row = $result->fetch_assoc()) {
      $kullanicilar[] = $row;
    }
    return $kullanicilar;
  } else {
    return false;
  }
}

$kullanicilar = getKullanicilar();


// Kullanıcıları listele
if ($kullanicilar) {
  echo '<h2 style="margin:15px 0 12px 0;">Kullanıcılar</h2>';
  foreach ($kullanicilar as $kullanici) {
    echo '<div class="kullanici-listesi">';
    echo '<span';

     if ($kullanici['kullanici_adi'] == 'root') 
     {echo ' style="color:#1cfe10"';}

     echo 'id="kullaniciAdi-' . $kullanici['kullanici_adi'] . '">' . $kullanici['kullanici_adi'] . '</span>';

    echo '<div class="kutu2" style="margin-left:100px">';
    echo '<a style="margin-right:5px;" onclick="duzenle(\'' . $kullanici['kullanici_adi'] . '\')">Düzenle</a>';
    echo '<a style="margin-right:15px;" onclick="confirmDelete(\'' . $kullanici['kullanici_adi'] . '\')">Sil</a>';
    echo '</div>';

    echo '<div class="kutu2">';
    echo $kullanici['kayit_tarihi'];
    echo '</div>';

    // Düzenleme formunu oluştur
    echo '<div class="duzenle-form" id="duzenle-form-' . $kullanici['kullanici_adi'] . '">';
    echo '<form method="POST">';
    echo '<input style="padding:3px; font-size:13px" type="text" name="kullanici_adi" id="kullaniciAdiInput-' . $kullanici['kullanici_adi'] . '" required>';
    echo '<input type="hidden" name="eski_kullanici_adi" value="' . $kullanici['kullanici_adi'] . '">';
    echo '<button type="submit" style="padding:2px; margin-left:9px">Kaydet</button>';
    echo '</form>';
    echo '</div>';

    echo '</div>';
  }
} else {
  echo '<p>Hiç kullanıcı bulunamadı.</p>';
}
?>


              </header>
              
            </div>
          </div>
        </section>
        <aside class="sidebar">
        <div class="widget" style="margin-top:50px;">
            <h3  class="widgettitle">Admin İşlemleri</h3>
            <ul>
              <li><a href="admin.php">Giriş</a></li>
              <li><a href="adminKullanici.php">Kullanıcıları Yönet</a></li>
              <li><a href="adminMuzikler.php">Müzikleri Yönet</a></li>
              <li><a onclick="toggleForm('form2')">Admin Bilgileri</a></li>
            </ul>
          </div>
              </aside>
          </div>
    </div>
  </div>
</div>

</body>


<script>
  function duzenle(kullaniciAdi) {


    if (kullaniciAdi == 'root')
    {
      alert("ADMİN KULLANICISINI DÜZENLEYEMEZSİN.");
      window.location.href = "adminKullanici.php";

    }

    else {

    var duzenleForm = document.getElementById('duzenle-form-' + kullaniciAdi);
    var kullaniciAdiInput = document.getElementById('kullaniciAdiInput-' + kullaniciAdi);

    duzenleForm.style.display = 'block';
    kullaniciAdiInput.value = kullaniciAdi;

    var form = document.getElementById('duzenle-form-' + kullaniciAdi);
    var digerFormlar = document.getElementsByClassName('duzenle-form');

    // Diğer formları kapat
    for (var i = 0; i < digerFormlar.length; i++) {
      if (digerFormlar[i] !== form) {
        digerFormlar[i].style.display = 'none';
      }
      }
    }
  }



  function confirmDelete(kullaniciAdi) {

    if (kullaniciAdi == 'root')
    {
      alert("ADMİN KULLANICISINI SİLEMEZSİN.");
      window.location.href = "adminKullanici.php";

    }
    else{

            var confirmMessage = confirm("Hesabı silmek istiyor musunuz?");
            if (confirmMessage) {
                window.location.href = "adminKullaniciSil.php?kullanici_adi=" + kullaniciAdi + "&confirm=yes";
            }
        }
  }

</script>






</html>
