<?php
include 'config.php';

$video_id = $_GET['id'];

$sql = "UPDATE video SET is_deleted=1 WHERE id=$video_id";
if ($conn->query($sql) === TRUE) {
    header("Location: page2.php");
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
