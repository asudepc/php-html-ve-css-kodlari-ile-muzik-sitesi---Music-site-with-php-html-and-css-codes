<?php
include("connect_db.php");

$errorMsg = "";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username1'];
    $password = $_POST['password1'];

    $query = "SELECT * FROM kullanici_tablosu WHERE kullanici_adi = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['sifre'];

        if (password_verify($password, $storedPassword)) {
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
            if ( $_SESSION['username'] == 'root'){$_SESSION['admin'] = true;}
            else{}

            header("Location: profile.php");
            exit;
        } else {
            $_SESSION['loginErrorMsg'] = "Geçersiz kullanıcı adı veya şifre";
        }
    } else {
        $_SESSION['loginErrorMsg'] = "Kullanıcı bulunamadı";
    }

    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePassword'])) {
    $username = $_SESSION['username'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['passwordUpdateErrorMsg'] = "Yeni şifreler eşleşmiyor";
        header("Location: profile.php");
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
            header("Location: profile.php");
            exit;
        }
    } else {
        $_SESSION['passwordUpdateErrorMsg'] = "Kullanıcı bulunamadı";
        header("Location: profile.php");
        exit;
    }
}

$conn->close();
?>
