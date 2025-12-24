<?php
include("baglanti.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $comment = $_POST['comment'];
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;

    $query = "INSERT INTO comment (username, comment, date, parent_id) VALUES (?, ?, NOW(), ?)";
    $stmt = $baglanti->prepare($query);
    $stmt->bind_param("ssi", $username, $comment, $parent_id);
    $stmt->execute();

    header("Location: profile.php");
    exit;
}
?>
