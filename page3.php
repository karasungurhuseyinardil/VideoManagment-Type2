<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $link = $_POST['link'];
    $description = $_POST['description'];

    if (!empty($link) && !empty($description)) {
        $date_added = date('Y-m-d H:i:s');
        $sql = "INSERT INTO video (link, description, date_added, is_deleted) VALUES ('$link', '$description', '$date_added', 0)";
        if ($conn->query($sql) === TRUE) {
            header("Location: page2.php");
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Tüm alanları doldurunuz');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Video Ekle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form method="POST">
            <label for="link">Video Linki:</label>
            <input type="text" id="link" name="link" required>
            <label for="description">Açıklama:</label>
            <textarea id="description" name="description" required></textarea>
            <button type="submit">Kaydet</button>
            <button type="button" onclick="window.location.href='page2.php'">Vazgeç</button>
        </form>
    </div>
</body>
</html>
