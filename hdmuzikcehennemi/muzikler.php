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
        <section class="content" style="margin-left:150px;margin-top:50px; float:left;width:650px;">
          <div class="post" style="padding:20px;padding:20px 30px; text-align:center;font-size:18px;">
            <h2 style="font-size:23px">Müzikler</h2>
            <div class="post-inner" style="margin-top:18px;margin-bottom:30px;padding:40px; text-align:left; height:auto;">
              <header><br>
                <div class="music-list">
                  <?php
                    include('connect_db.php');
                    $sql = "SELECT muzik_adi, sanatci FROM muzikler";
                    $result = $conn->query($sql);
                    $musicList = '';
                    while ($row = $result->fetch_assoc()) {
                      $musicName = $row['muzik_adi'];
                      $musicArtist = $row['sanatci'];
                      $musicList .= '<div>';
                      $musicList .= '<span><a href="?music=' . urlencode($musicName) . '">' . $musicName . '</a></span>';
                      $musicList .= '<span> - ' . $musicArtist . ' </span>';
                      $musicList .= '</div>';
                      if (isset($_GET['music']) && $_GET['music'] === $musicName) {
                        $hedefDosya = file_get_contents("upload.php");
                        $musicList .= '<audio src="' . $hedefDosya . '" controls autoplay></audio>';
                      }
                    }
                    echo $musicList . '<br>';
                  ?>
                </div>
                
              </header>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
</body>
</html>
