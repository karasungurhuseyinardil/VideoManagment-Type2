<?php
include 'config.php';

$video_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $link = isset($_POST['link']) ? $_POST['link'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;

    if (!empty($link) && !empty($description)) {
        
        $stmt = $conn->prepare("UPDATE video SET link=?, description=? WHERE id=?");
        $stmt->bind_param("ssi", $link, $description, $video_id);
        
        if ($stmt->execute()) {
            header("Location: page2.php");
            exit();
        } else {
            echo "Hata: " . $stmt->error;
        }
    } else {
        echo "<script>alert('Tüm alanları doldurunuz');</script>";
    }
} else {
    if ($video_id !== null) {
        
        $stmt = $conn->prepare("SELECT * FROM video WHERE id=?");
        $stmt->bind_param("i", $video_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $link = $row['link'];
            $description = $row['description'];
        } else {
            echo "Video bulunamadı.";
            exit();
        }
    } else {
        echo "Video ID belirtilmedi.";
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Video Güncelle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form method="POST">
            <label for="link">Video Linki:</label>
            <input type="text" id="link" name="link" value="<?php echo htmlspecialchars($link); ?>" required>
            <label for="description">Açıklama:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea>
            <button type="submit">Kaydet</button>
            <button type="button" onclick="window.location.href='page2.php'">Vazgeç</button>
        </form>
    </div>
</body>
</html>
