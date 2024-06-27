<?php
include 'config.php';

$sql = "SELECT * FROM video WHERE is_deleted=0";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Video Yönetim Portalı</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Videolar</h1>
        <table>
            <tr>
                <th>Video</th>
                <th>Açıklama</th>
                <th>İşlemler</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $video_id = $row['id'];
                    $video_link = $row['link'];
                    $description = $row['description'];
                    $thumbnail_url = "https://img.youtube.com/vi/" . substr($video_link, strpos($video_link, "v=") + 2) . "/default.jpg";
                    echo "<tr>
                            <td><a href='$video_link' target='_blank'><img class='thumbnail' src='$thumbnail_url' alt='Thumbnail'></a></td>
                            <td>$description</td>
                            <td>
                                <a href='page4.php?id=$video_id'>Güncelle</a> |
                                <a href='delete_video.php?id=$video_id' onclick=\"return confirm('Bu videoyu silmek istediğinize emin misiniz?');\">Sil</a>
                            </td>
                          </tr>";
                }
            }
            ?>
        </table>
        <button onclick="window.location.href='page3.php'">Yeni Video Ekle</button>
    </div>
</body>
</html>

<?php
$conn->close();
?>
