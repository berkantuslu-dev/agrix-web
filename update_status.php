<?php
session_start();
include 'baglanti.php'; // Veritabanı bağlantısını dahil et

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableName = $_POST['tableName'];
    $rowId = $_POST['rowId'];
    $isCompleted = $_POST['isCompleted'] === 'true' ? 1 : 0;

    $sql = "UPDATE $tableName SET isCompleted = ? WHERE id = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("ii", $isCompleted, $rowId);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}
$baglanti->close();
?>