<?php
require 'baglanti.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $author = $_POST['author'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Process the link data
    $linkTitles = $_POST['linkTitle'] ?? [];
    $links = $_POST['link'] ?? [];
    
    // Process the phone data
    $phoneOwners = $_POST['phoneOwner'] ?? [];
    $phones = $_POST['phone'] ?? [];

    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $targetPath = 'uploads/' . $imageName;
        if (move_uploaded_file($imageTmp, $targetPath)) {
            $imagePath = $targetPath;
        }
    }

    // Insert blog post data
    $stmt = $baglanti->prepare("INSERT INTO blogs (author, title, content, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $author, $title, $content, $imagePath);
    $stmt->execute();
    $blogId = $stmt->insert_id;
    $stmt->close();

    // Insert multiple links
    foreach ($linkTitles as $index => $linkTitle) {
        if (!empty($linkTitle) && !empty($links[$index])) {
            $stmt = $baglanti->prepare("INSERT INTO blog_links (blog_id, link_title, link_url) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $blogId, $linkTitle, $links[$index]);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Insert multiple phone numbers
    foreach ($phoneOwners as $index => $phoneOwner) {
        if (!empty($phoneOwner) && !empty($phones[$index])) {
            $stmt = $baglanti->prepare("INSERT INTO blog_phone_numbers (blog_id, phone_owner, phone_number) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $blogId, $phoneOwner, $phones[$index]);
            $stmt->execute();
            $stmt->close();
        }
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $baglanti->query("DELETE FROM blogs WHERE id=$id");
    $baglanti->query("DELETE FROM blog_links WHERE blog_id=$id");
    $baglanti->query("DELETE FROM blog_phone_numbers WHERE blog_id=$id");
    header("Location: blogadmin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Agrix is an innovative agritech company based in Dar es Salaam, Tanzania.">
    <meta name="keywords" content="Tanzania agritech, smart farming, sustainable agriculture">
    <meta name="robots" content="index, follow">
    <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <title>Blog Admin</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 800px; margin: auto; padding: 20px; }
        form input, form textarea { width: 100%; margin-bottom: 10px; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
        form button { padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        .navbar { height: 80px; position: fixed; top: 0; width: 100%; background-color: #333; color: white; display: flex; align-items: center; padding: 0 20px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Share a New Blog Post</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="author" placeholder="Author Name" required>
        <input type="text" name="title" placeholder="Blog Title" required>
        <textarea name="content" rows="6" placeholder="Blog Content" required></textarea>
        <input type="file" name="image">

        <button type="submit">Share Blog</button>
    </form>

    <h3>Existing Blog Posts</h3>
    <table>
        <tr><th>Title</th><th>Action</th></tr>
        <?php
        $result = $baglanti->query("SELECT id, title FROM blogs ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row['title']) . "</td><td><a href='?delete=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td></tr>";
        }
        ?>
    </table>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
