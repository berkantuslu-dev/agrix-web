<?php

// Veritabanı bağlantısı
$host = "localhost";
$dbname = "agrix";
$username = "root";
$password = "";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Form gönderildiğinde verileri işleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $yazar_ad_soyad = $_POST['yazar_ad_soyad'];
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    $kaynakca = $_POST['kaynakca'];

    $sql = "INSERT INTO yazar_bilgileri_ingilizce (yazar_ad_soyad, baslik, icerik, kaynakca) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $yazar_ad_soyad, $baslik, $icerik, $kaynakca);

    if ($stmt->execute()) {
        $success_message = "Article Published";
    } else {
        $error_message = "Bir hata oluştu: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Saving Page</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            color: #275462;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 1rem;
            color: #555;
        }

        input, textarea, button {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            background-color: #275462;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #1c3e4b;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 1rem;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        @media screen and (max-width: 768px) {
            .container {
                width: 95%;
            }
        }
    </style>
</head>
<body>
<?php if (isset($success_message)): ?>
            <p class="message success"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="message error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    <div class="container">
        <h1>Publish Article</h1>
        <form method="POST" action="">
            <label for="yazar_ad_soyad">Writer Name-Surname:</label>
            <input type="text" id="yazar_ad_soyad" name="yazar_ad_soyad" required>

            <label for="baslik">Subject:</label>
            <input type="text" id="baslik" name="baslik" required>

            <label for="icerik">Content</label>
            <textarea id="icerik" name="icerik" required></textarea>

            <label for="kaynakca">Resources</label>
            <textarea id="kaynakca" name="kaynakca"></textarea>

            <button type="submit">Publish Article</button>
        </form>

       
    </div>
</body>
</html>
