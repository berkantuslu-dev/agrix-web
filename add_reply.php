<?php
include("baglanti.php");
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $reply = $_POST['reply'];
    $comment_id = $_POST['comment_id'];

    $query = "INSERT INTO replies (comment_id, username, reply) VALUES (?, ?, ?)";
    $stmt = $baglanti->prepare($query);
    $stmt->bind_param("iss", $comment_id, $username, $reply);

    if ($stmt->execute()) {
        header("Location: profile.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    header("Location: login.php");
    exit;
}
?>
