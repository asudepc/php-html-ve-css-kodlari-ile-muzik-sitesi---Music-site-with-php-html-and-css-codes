<?php

include('connect_db.php');

session_start();

$currentUsername = $_SESSION['username'];


$newUsername = $_POST['new_username'];


$query = "SELECT COUNT(*) as count FROM kullanici_tablosu WHERE kullanici_adi = '$newUsername'";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];


if ($count > 0) {
    echo '<script>if (confirm("Bu kullanıcı adı zaten mevcut.")) {
        window.location.href = "profile.php";
      }      
      </script>';
} 
else if (strlen($newUsername) < 4)
{
  echo '<script>if (confirm("Kullanıcı adı 4 karakter veya fazla olmalıdır.")) {
    window.location.href = "profile.php";
  }      
  </script>';
}
else if (preg_match('/\s/', $newUsername)) {
  echo '<script>if (confirm("Kullanıcı adı boşluk içeremez.")) {
    window.location.href = "profile.php";
  }      
  </script>';
  
} else if (!preg_match('/^[a-zA-Z0-9]+$/', $newUsername)) {
echo '<script>if (confirm("Kullanıcı adı sadece Latin harflerini içerebilir.")) {
        window.location.href = "profile.php";
      }      
      </script>';
}



else {

    $updateQuery = "UPDATE kullanici_tablosu SET kullanici_adi = '$newUsername' WHERE kullanici_adi = '$currentUsername'";

    mysqli_query($conn, $updateQuery);

    $_SESSION['username'] = $newUsername;

    echo '<script>if (confirm("Kullanıcı adı başarıyla güncellendi.")) {
        window.location.href = "profile.php";
      }      
      </script>';
}

?>