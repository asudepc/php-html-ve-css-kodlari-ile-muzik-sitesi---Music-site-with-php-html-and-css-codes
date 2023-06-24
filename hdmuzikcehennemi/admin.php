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
    </style>
</head>



<?php

session_start();

include('connect_db.php')




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
          
            <h2 style="font-size:23px">Giriş Durumu</h2>
            <div class="post-inner" style="margin-top:18px;margin-bottom:30px;padding:40px; text-align:left; ">
              <header style="text-align:center;">
                <?php


                if ($_SESSION['admin'] !== true) {
                
                  echo 'Admin Girişi yapmadan bu sayfaya erişemezsiniz.<br><a href="index.php" style="text-decoration:underline">Anasayfaya dön</a> ';
                }
                else{
                    
              echo'
              <span style="text-align:center;">Admin sayfasındasınız. <br>Sol taraftaki menülerden işlemlerinizi gerçekleştirebilirsiniz.</span>

              </header>
            </div>
          </div>
        </section>
        <aside class="sidebar">
        <div class="widget" style="margin-top:50px;">
            <h3  class="widgettitle">Admin İşlemleri</h3>
            <ul>
              <li><a href="admin.php">Giriş</a></li>
              <li><a href="adminKullanici.php"> Kullanıcıları Yönet</a></li>
              <li><a href="adminMuzikler.php">Müzikleri Yönet</a></li>
              <li><a onclick="toggleForm("form2")">Admin Bilgileri</a></li>
            </ul>
          </div>
              </aside>
          </div>';
          }
          ?>
    </div>
  </div>
</div>



<script>



      function confirmDelete() {
      return confirm("Hesabınızı silmek istiyor musunuz?");
    }


    function toggleForm(formId) {
      var formc1 = document.getElementById("form11");
      var formc2 = document.getElementById("form22");
      var formc3 = document.getElementById("form33");
      
      if (formId === "form1") {
        if (formc1.style.display === "none") {
          formc1.style.display = "block";
          formc2.style.display = "none";
          formc3.style.display = "none";
        } else {
          formc1.style.display = "none";
        }
      } else if (formId === "form2") {
        if (formc2.style.display === "none") {
          formc1.style.display = "none";
          formc2.style.display = "block";
          formc3.style.display = "none";
        } else {
          formc2.style.display = "none";
        }
      }
      if (formId === "form3") {
        if (formc3.style.display === "none") {
          formc1.style.display = "none";
          formc2.style.display = "none";
          formc3.style.display = "block";
          ;
        } else {
          formc3.style.display = "none";
        }
      }


    }
  </script>

</body>
</html>
