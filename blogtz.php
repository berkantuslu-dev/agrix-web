<?php

require 'baglanti.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta charset="UTF-8">
    <meta name="description" content="Agrix is an innovative agritech company based in Dar es Salaam, Tanzania. We empower farmers and retailers with smart agricultural technologies, market access, and educational programs to enhance productivity, profitability, and sustainability in the agricultural sector.">
<meta name="keywords" content="Tanzania agritech, smart farming, sustainable agriculture, farmer support programs, agricultural education, market access, Dar es Salaam agriculture, agricultural innovation, farmer solutions, agri analytics, agribusiness development">
  <meta name="robots" content="index, follow">
  <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
    <title>Agrix Tanzania</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
        }
        .container {
            padding-top: 120px;
            max-width: 800px;
            margin: 0 auto;
            padding-left: 20px;
            padding-right: 20px;
        }
        .container  h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .container  ul {
            list-style-type: none;
            padding: 0;
        }
       .container   li {
            background: white;
            margin-bottom: 10px;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
      .container li a {
            text-decoration: none;
            color: #1a73e8;
            font-weight: 600;
            font-size: 1.1em;
            display: block;
        }
        .container  li a:hover {
            color: #0c56d0;
        }

        @media (max-width: 600px) {
            .container {
                padding-top: 100px;
            }
            li {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
<?php include 'navbartz.php'; ?>
<div class="container">
    <h2>Blog Posts</h2>
    <ul>
        <?php
        $sorgu = "SELECT id, title FROM blog ORDER BY created_at DESC";
        $sonuc = $baglanti->query($sorgu);

        if ($sonuc->num_rows > 0) {
            while ($satir = $sonuc->fetch_assoc()) {
                echo '<li><a href="blogitemtz.php?id=' . $satir['id'] . '">' . htmlspecialchars($satir['title']) . '</a></li>';
            }
        } else {
            echo '<li>No blog posts found.</li>';
        }
        ?>
    </ul>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
