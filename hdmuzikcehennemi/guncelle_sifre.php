<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("connect_db.php");

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePassword'])) {
    $username = $_SESSION['username'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['passwordUpdateErrorMsg'] = "Yeni şifreler eşleşmiyor";
        header("Location: guncelle_sifre.php");
        exit;
    }

    $query = "SELECT * FROM kullanici_tablosu WHERE kullanici_adi = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['sifre'];

        if (password_verify($oldPassword, $storedPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updateQuery = "UPDATE kullanici_tablosu SET sifre = '$hashedPassword' WHERE kullanici_adi = '$username'";
            $conn->query($updateQuery);

            $_SESSION['passwordUpdateSuccessMsg'] = "Şifreniz başarıyla güncellendi";
            header("Location: profile.php");
            exit;
        } else {
            $_SESSION['passwordUpdateErrorMsg'] = "Eski şifre yanlış";
            header("Location: guncelle_sifre.php");
            exit;
        }
    } else {
        $_SESSION['passwordUpdateErrorMsg'] = "Kullanıcı bulunamadı";
        header("Location: guncelle_sifre.php");
        exit;
    }
}

$conn->close();
?>
