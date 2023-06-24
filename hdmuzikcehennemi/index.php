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
        <section class="content">
          <div class="post">
            1. Başlık
            <div class="post-inner">
              <header>
                <?php
                  session_start();

                  
                

                  if (isset($_SESSION['loginErrorMsg'])) {
                    echo "<p style='color: red;'>Hata: {$_SESSION['loginErrorMsg']}</p>";
                    unset($_SESSION['loginErrorMsg']); 

                  } elseif (isset($_SESSION['username'])) {
                ?>
                <h1>Müzik Ekleme</h1>
                <form action="upload.php" method="POST" class="addmusic" enctype="multipart/form-data" style="margin-top:18px;">
                  <input type="text" name="muzik_adi" placeholder="Müzik Adı" style="padding:4px; font-size:14px;margin-bottom:10px; width:200px;" required><br>
                  <input type="text" name="sanatci" placeholder="Sanatçı" style="padding:4px; font-size:14px;margin-bottom:10px;width:200px;"><br>
                  <input type="file" name="dosya" accept="audio/*" style="padding:4px; margin-bottom:10px; font-size:14px;width:200px;"><br>
                  <button type="submit" style="padding:4px; margin-left:55px;font-size:14px;width:80px;">Yükle</button>
                </form>
                <?php } else {
                  
                  if (isset($_SESSION['successMsg'])) {
                    echo "<p style='color: green;'>{$_SESSION['successMsg']}</p>";
                    unset($_SESSION['successMsg']);
                }
              elseif (isset($_SESSION['registerErrorMsg'])) {
                  echo "<p style='color: red;'>Hata: {$_SESSION['registerErrorMsg']}</p>";
                  unset($_SESSION['registerErrorMsg']);
                }
                else {
                  echo "<p>Müzik yüklemek için giriş yapmalısınız.</p>";
                  echo "<p>Giriş yapmak için <a href='#' onclick='showLoginForm()'>buraya tıklayın</a></p>";
                  echo "<p>Kayıt olmak için <a href='#' onclick='showSignupForm()'>buraya tıklayın</a></p>";
                }
                }
                ?>
              </header>
            </div>
          </div>
        </section>

        <!-- YAN BAR -->

        <aside class="sidebar">
          <div class="widget">
            <h3 class="widgettitle">Kullanıcı Girişi</h3>
            <div class="post-inner" id="loginbg">
<?php 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo "<h3  style='color:white; font-size:15px'>Giriş yapıldı. Kullanıcı profiline <br> gitmek için <a href='profile.php'>tıklayınız.</a></h3>";
} else {
    ?>
    
              <div class="post" id="sign" href="#" onclick="showLoginForm()"><a>Giriş</a></div>
              <div class="post" id="sign" href="#" onclick="showSignupForm()"><a>Kayıt</a></div>
              <div class="loginn">
                <form action="login.php" class="login-form" method="POST">
                  <input class="loginn" type="text" name="username1" placeholder="Kullanıcı Adı" required><br>
                  <input class="" type="password" name="password1" placeholder="Şifre" required><br>
                  <input type="submit" name="login" value="Giriş Yap">
                </form>
                <form action="register.php" class="signup-form" method="POST">
                  <input class="loginn" type="text" name="username" placeholder="Kullanıcı Adı" required><br>
                  <input class="loginn" type="password" name="password" placeholder="Şifre" required><br>
                  <input class="loginn" type="password" name="re_password" placeholder="Tekrar Şifre" required><br>
                  <input type="submit" name="register" value="Kayıt Ol">
                 
                </form>
              </div>
            </div>
    <?php
    }
?>
            
          </div>
          <div class="widget">
            <h3 class="widgettitle">Son Eklenen Müzikler</h3>
            <ul>
<?php
            include('soneklenen.php');
?>
            </ul>
          </div>
          <div class="widget socials-widget">
            <h3 class="widgettitle">Son Kaydolan Kullanıcılar</h3>
            <ul>
<?php
            include('sonkullanici.php');
?>
            </ul>
          </div>
        </aside>
        <div class="cl">&nbsp;</div>
      </div>

      <script>
        function showLoginForm() {
          document.querySelector('.login-form').style.display = 'block';
          document.querySelector('.signup-form').style.display = 'none';
          unset($_SESSION['loginErrorMsg']); 
          unset($_SESSION['successMsg']);  
          unset($_SESSION['registerErrorMsg']);
        }

        function showSignupForm() {
          document.querySelector('.login-form').style.display = 'none';
          document.querySelector('.signup-form').style.display = 'block';
          unset($_SESSION['registerErrorMsg']); 
          unset($_SESSION['loginErrorMsg']); 
          unset($_SESSION['successMsg']); 
        }

      </script>
    </div>
  </div>
</div>
</body>
</html>