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
          
            <h2 style="font-size:23px">Kullanıcı Bilgileri</h2>
            <div class="post-inner" style="margin-top:18px;margin-bottom:30px;padding:40px; text-align:left; ">
              <header>
                <?php
                session_start();
                include('connect_db.php');

                
                $kayitTarihi = "";

                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                  $username = $_SESSION['username'];

                    $query = "SELECT kayit_tarihi FROM kullanici_tablosu WHERE kullanici_adi = '$username'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $kayitTarihi = $row['kayit_tarihi'];
                    } else {
                        echo "Kayıt tarihi bulunamadı.";
                    }

                    if (isset($_POST['logout'])) {
                        $_SESSION['loggedin'] = false;
                        $_SESSION['admin'] = false;
                        session_unset();
                        session_destroy();
                        session_start();
                        $_SESSION['admin'] = false;
                        header("Location: index.php");
                        exit;
                    }
                  
                    echo 'Kullanıcı Adı: <a href="profile.php">'.$username.'</a>
                    <form method="POST" action="">
                      <button type="submit" name="logout" style="padding:5px; font-Size:15px;margin-left:320px;">Çıkış Yap</button></form>';
                    echo "Kayıt Tarihi: <a>" . $kayitTarihi."</a><br>";
                    if ($username == 'root')
                    {
                      echo '<span style="color:#1CFE10"><br><br>Admin hesabıyla giriş yaptınız. Admin paneline gitmek için <a style=" color:white" href="admin.php">tıklayınız.</a><br><br></span>';
                    }
                    

                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
                        $oldPassword = $_POST['old_password'];
                        $newPassword = $_POST['new_password'];
                        $confirmPassword = $_POST['confirm_password'];

                        if ($newPassword !== $confirmPassword) {
                            echo "<br><br>Yeni şifreler eşleşmiyor<br><br>";
                        } 
                          elseif ( $oldPassword == $newPassword)
                          {
                            echo "<br><br>Eski şifreyle yeni şifre aynı olamaz.<br><br>";
                          }
                        else {
                            $query = "SELECT * FROM kullanici_tablosu WHERE kullanici_adi = '$username'";
                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $storedPassword = $row['sifre'];

                                if (password_verify($oldPassword, $storedPassword)) {
                                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                                    $updateQuery = "UPDATE kullanici_tablosu SET sifre = '$hashedPassword' WHERE kullanici_adi = '$username'";
                                    $conn->query($updateQuery);

                                    echo "<br><br>Şifreniz başarıyla güncellendi<br><br>";
                                } else {
                                    echo "<br><br>Eski şifre yanlış<br><br>";
                                }
                            } else {
                                echo "<br><br>Kullanıcı bulunamadı<br><br>";
                            }
                        }
                    }


                    ?>

                    <div id="form11" class="form-container">
                    <form method="POST" >
                      <br><br><br>
                      <label for="old_password">Eski Şifre:</label>
                      <input type="password" name="old_password" required><br><br>
                      <label for="new_password">Yeni Şifre:</label>
                      <input type="password" name="new_password" required><br><br>
                      <label for="confirm_password">Yeni Şifre (Tekrar):</label>
                      <input type="password" name="confirm_password" required><br><br>
                      <button type="submit" name="updatePassword" style="padding:5px; font-size:15px; margin-left:50px;">Şifreyi Güncelle</button>
                    </form>
                    </div>

                    
                      <div id="form22" class="form-container" >
                      <form method="post" onsubmit="return confirmDelete();" action="hesapsil.php">
                      <br><br><br><input type="submit" name="confirm"  value="Hesabı Sil" style="padding:13px; font-Size:17px;margin-left:200px; background-color:Red">
                      </form>
                      </div>

                      <div id="form33" class="form-container" ><br><br>
                      <form action="kullaniciadi_g.php" method="POST">
                           <label for="new_username">Yeni Kullanıcı Adı:</label>
                           <input type="text" id="new_username" name="new_username" required>
                           <button type="submit" style="padding:5px; font-size:15px; margin-left:20px;">Değiştir</button>
                      </form>
<?php 
                } else {
                    echo 'Önce giriş yapmanız gerekiyor.<br><a href="index.php" style="text-decoration:underline">Anasayfaya dön</a>';
                }

                $conn->close();
                ?>
              </header>
            </div>
          </div>
        </section>
        <aside class="sidebar">
        <div class="widget" style="margin-top:50px;">
            <h3  class="widgettitle">Kullanıcı İşlemleri</h3>
            <ul>
              <li><a href="profile.php">Profil</a></li>
              <li><a onclick="toggleForm('form1')">Şifreyi Güncelle</a></li>
              <li><a onclick="toggleForm('form3')">Kullanıcı Adını değiştir</a></li>
              <li><a onclick="toggleForm('form2')">Hesabı Sil</a></li>
            </ul>
          </div>
              </aside>
          </div>
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


      var username = "<?php echo $_SESSION['username']; ?>"
      if (username != 'root')
       {

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
    else {
      alert("ROOT KULLANICISINI SİTE ÜZERİNDEN DÜZENLEYEMEZSİN !");
      window.location.href = "profile.php";

    }
    }

  </script>

</body>
</html>
