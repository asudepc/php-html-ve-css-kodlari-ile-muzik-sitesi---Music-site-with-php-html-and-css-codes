
<?php
include('connect_db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
                      $username = $_SESSION['username'];
                      $confirm = $_POST["confirm"];
                  
                      if ($confirm == "Hesabı Sil") {
                        $deleteQuery = "DELETE FROM kullanici_tablosu WHERE kullanici_adi = '$username'";
                        if ($conn->query($deleteQuery) === TRUE)
                        {
                        


                        session_unset();
                        session_destroy();

                          echo "Hesabınız başarıyla silindi.";
                          header("Location: index.php");
                          exit;
                        }
                      } else {
                          echo "Hesap silerken bir hata oluştu". $conn->error;;
                      }
                  }

?>