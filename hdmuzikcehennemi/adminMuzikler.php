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
include('connect_db.php');

// Müzikleri veritabanından çek
function getMuzikler()
{
  global $conn;

  $sql = "SELECT * FROM muzikler";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $muzikler = array();
    while ($row = $result->fetch_assoc()) {
      $muzikler[] = $row;
    }
    return $muzikler;
  } else {
    return false;
  }
}

$muzikler = getMuzikler();

// Müzikleri listele ve düzenleme formlarını oluştur
if ($muzikler) {
  echo '<h2>Müzikler</h2>';
  foreach ($muzikler as $muzik) {
    echo '<div class="kullanici-listesi">';
    echo '<span id="muzikAdi-' . $muzik['muzik_adi'] . '">' . $muzik['muzik_adi'] . ' - </span>';
    echo '<span style="color:#bffcc5"id="sanatci-' . $muzik['sanatci'] . '">' . $muzik['sanatci'] . ' </span>';

    echo '<div class="kutu2" style="margin-left:100px">';
    echo '<a style="margin-right:5px;" onclick="duzenle(\'' . $muzik['muzik_adi'] . '\')">Düzenle</a>';
    echo '<a style="margin-right:5px;" onclick="sil(\''. $muzik['muzik_adi']. '\')">Sil</a>';
    echo '</div>';

   

    // Düzenleme formunu oluştur
    echo '<div class="duzenle-form" id="duzenle-form-' . $muzik['muzik_adi'] . '" style="display:none;">';
    echo '<form method="POST">';
    echo '<input style="padding:3px; font-size:13px" type="text" name="muzik_adi" id="muzikAdiInput-' . $muzik['muzik_adi'] . '" value="' . $muzik['muzik_adi'] . '" required>';
    echo '<input style="padding:3px; font-size:13px" type="text" name="sanatci" id="sanatciInput-' . $muzik['muzik_adi'] . '" value="' . $muzik['sanatci'] . '" required>';
    echo '<input type="hidden" name="eski_muzik_adi" value="' . $muzik['muzik_adi'] . '">';
    echo '<button type="submit" style="padding:2px; margin-left:9px">Kaydet</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
  }
} else {
  echo '<p>Hiç müzik bulunamadı.</p>';
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
  function duzenle(muzikAdi) {
    var duzenleForm = document.getElementById('duzenle-form-' + muzikAdi);
    var digerDuzenleFormlar = document.getElementsByClassName('duzenle-form');

    // Diğer düzenleme formlarını kapat
    for (var i = 0; i < digerDuzenleFormlar.length; i++) {
      if (digerDuzenleFormlar[i] !== duzenleForm) {
        digerDuzenleFormlar[i].style.display = 'none';
      }
    }

    // Seçilen düzenleme formunu aç
    duzenleForm.style.display = 'block';
  }


  function sil(muzikAdi) {
    
    window.location.href = "adminKullanici.php";
    console.log('Silme işlemi: ' + muzikAdi);
  }
</script>






</html>
