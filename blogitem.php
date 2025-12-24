<?php
require 'baglanti.php';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Invalid blog ID.</p>";
    include 'footer.php';
    exit;
}

$id = intval($_GET['id']);
$stmt = $baglanti->prepare("SELECT * FROM blog WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$yazi = $result->fetch_assoc();
$tarih = date("d/m/Y H:i", strtotime($yazi['created_at']));

if (!$yazi) {
    echo "<p>Blog post not found.</p>";
    include 'footer.php';
    exit;
}

$imagePath = htmlspecialchars($yazi['image']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Agrix is an innovative agritech company based in Dar es Salaam, Tanzania. We empower farmers and retailers with smart agricultural technologies, market access, and educational programs to enhance productivity, profitability, and sustainability in the agricultural sector.">
<meta name="keywords" content="Tanzania agritech, smart farming, sustainable agriculture, farmer support programs, agricultural education, market access, Dar es Salaam agriculture, agricultural innovation, farmer solutions, agri analytics, agribusiness development">
  <meta name="robots" content="index, follow">
  <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
    <title>Agrix Tanzania</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        /* Main container */
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding-top: 100px;
        }

        /* Image Styling */
        .container img {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 10px;
        }

        /* Title and Meta */
       .container h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .meta {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 20px;
        }

        /* Content Styling */
        .content {
            font-size: 1rem;
            color: #333;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Button Styling */
       .container a.button {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }

       .container a.button:hover {
            background: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

          .container  h1 {
                font-size: 1.5rem;
            }

            .content {
                font-size: 0.95rem;
            }

            .meta {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h1><?= htmlspecialchars($yazi['title']) ?></h1>
    <p class="meta">By <?= htmlspecialchars($yazi['author']) ?></p>
	<p class="meta"><?= $tarih ?> </p>
    <?php if (!empty($imagePath)): ?>
        <img src="<?= $imagePath ?>" alt="Blog Image">
    <?php endif; ?>

    <div class="content">
        <p><?= nl2br(htmlspecialchars($yazi['content'])) ?></p>
    </div>

    <?php if (!empty($yazi['link'])): ?>
        <p><a href="<?= htmlspecialchars($yazi['link']) ?>" target="_blank" class="button">Read More</a></p>
    <?php endif; ?>

    <?php if (!empty($yazi['phone'])): ?>
        <p><strong>Contact:</strong> <?= htmlspecialchars($yazi['phone']) ?></p>
    <?php endif; ?>

    <?php
    // Check if there are any additional links or phone numbers
    if (!empty($yazi['link_title']) && !empty($yazi['link'])): ?>
        <p><a href="<?= htmlspecialchars($yazi['link']) ?>" target="_blank" class="button"><?= htmlspecialchars($yazi['link_title']) ?></a></p>
    <?php endif; ?>

    <?php if (!empty($yazi['phone_owner']) && !empty($yazi['phone'])): ?>
        <p><strong>Phone Owner:</strong> <?= htmlspecialchars($yazi['phone_owner']) ?> - <strong>Phone Number:</strong> <?= htmlspecialchars($yazi['phone']) ?></p>
    <?php endif; ?>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
