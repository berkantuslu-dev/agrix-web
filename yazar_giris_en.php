<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Bağlantıyı yap
    $conn = new mysqli('localhost', 'root', '', 'appointments');
    
    // Bağlantı kontrolü
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $yazaradi = $_POST['yazaradi'];
    $parola = $_POST['parola'];

    // Veritabanında kullanıcı adı ve parolayı kontrol et
    $sql = "SELECT * FROM yazar_giris WHERE yazaradi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $yazaradi);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Parolayı kontrol et
        if (password_verify($parola, $row['parola'])) {
            // Başarılı giriş, yönlendirme
            $_SESSION['yazaradi'] = $yazaradi;
            header('Location: yazikayiten.php');
            exit();
        } else {
            $error_message = "Kullanıcı adı veya parolayı kontrol ediniz!";
        }
    } else {
        $error_message = "Kullanıcı adı veya parolayı kontrol ediniz!";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazar Giriş</title>
    <link rel="stylesheet" href="styles.css"> <!-- Burada stil dosyanızı eklemeyi unutmayın -->
    <style>/* Genel Stil Ayarları */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f1f1f1;
    margin: 0;
    padding: 0;
}

h2 {
    color: #275462;
    text-align: center;
    margin-bottom: 20px;
}

.login-container {
    width: 100%;
    max-width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-size: 1rem;
    color: #555;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
    font-size: 1rem;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #275462;
}

button {
    background-color: #275462;
    color: #fff;
    font-size: 1rem;
    padding: 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #1e4e61;
}

/* Hata Mesajı */
.error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    text-align: center;
    font-size: 1rem;
}

/* Responsive Tasarım */
@media screen and (max-width: 768px) {
    .login-container {
        padding: 20px;
        margin: 30px auto;
    }

    h2 {
        font-size: 1.5rem;
    }

    input[type="text"],
    input[type="password"] {
        font-size: 0.9rem;
        padding: 10px;
    }

    button {
        font-size: 0.9rem;
        padding: 10px;
    }
}
</style>
</head>
<body>

    <div class="login-container">
        <h2>Yazar Giriş</h2>
        
        <?php
        if (isset($error_message)) {
            echo "<div class='error-message'>$error_message</div>";
        }
        ?>
        
        <form action="yazi_kayiten.php" method="POST">
            <label for="yazaradi">Kullanıcı Adı:</label>
            <input type="text" id="yazaradi" name="yazaradi" required>
            
            <label for="parola">Parola:</label>
            <input type="password" id="parola" name="parola" required>
            
            <button type="submit">Giriş Yap</button>
        </form>
    </div>

</body>
</html>
