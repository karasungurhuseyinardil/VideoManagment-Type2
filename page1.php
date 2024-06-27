<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location: page2.php");
            exit;
        } else {
            echo "<script>alert('Kullanıcı adı veya şifre hatalı');</script>";
        }
    } else {
        echo "<script>alert('Kullanıcı adı veya şifre hatalı');</script>";
    }
}

$conn->close(); 
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form method="POST">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Giriş Yap</button>
        </form>
    </div>
</body>
</html>
