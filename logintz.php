<?php
include("baglanti.php"); //BAGLANTI PHP DOSYASINI INDEX PHP DOSYAMIZA BAGLADIK

$username_err = "";
$email_err = "";
$password_err = "";
$passwordrpt_err = "";

if (isset($_POST["signnup"])) {
    header("Location: signintz.php");
}

//FORMDA BULUNAN signup, username, email "name" degerlerini verdigimiz elementlere $ ile php degeri verdik
if (isset($_POST["login"])) {

//EMAIL SORGULAMA-----------------------------------------------------------------------------
if (empty($_POST["email"])) {
    $email_err = "E-mail can not be empty";
} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $email_err = "Invalid email format";
} else {
    $email = $_POST["email"];
}

//PAROLA SORGULAMA-----------------------------------------------------------------------------
if (empty($_POST["password"])) {
    $password_err = "Password can not be empty";
} else {
    $password = $_POST["password"];
}

if (isset($email) && isset($password)) {
    $secim = "SELECT * FROM kullanicilar WHERE email = '$email'";
    $calistir = mysqli_query($baglanti, $secim);
    $kayitsayisi = mysqli_num_rows($calistir);

    if ($kayitsayisi > 0) {
        $userprofile = mysqli_fetch_assoc($calistir);
        $hashpassword = $userprofile["password"];

        if (password_verify($password, $hashpassword)) {
            session_start();
            $_SESSION["username"] = $userprofile["user_name"];
            $_SESSION["email"] = $userprofile["email"];
            header("location:profile.php");
        } else {
            echo '<div class="alert alert-danger" role="alert">Password is not correct</div>'; 
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">E-mail is not exist in system. Please Sign Up</div>';
    }
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agrix Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	  <meta name="description" content="Agrix is an innovative agritech company based in Dar es Salaam, Tanzania. We empower farmers and retailers with smart agricultural technologies, market access, and educational programs to enhance productivity, profitability, and sustainability in the agricultural sector.">
<meta name="keywords" content="Tanzania agritech, smart farming, sustainable agriculture, farmer support programs, agricultural education, market access, Dar es Salaam agriculture, agricultural innovation, farmer solutions, agri analytics, agribusiness development">
  <meta name="robots" content="index, follow">
  <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>/* Genel sayfa stili */
body {
    font-family: "Open Sans", sans-serif;
    background-color: #2c2c2c; /* Açık siyah arka plan rengi */
    color: #ffffff; /* Beyaz yazı rengi */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    padding: 0 20px; /* Kenarlardan boşluk */
}

/* Giriş formu kartı */
.card {
    background-color: #3b3b3b; /* Daha açık siyah kart rengi */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 500px;
    box-sizing: border-box;
    display: flex;
    align-items:center;
    justify-content:center;
}

img{
    width: 150px;
    height:150px;
    padding-left:20px;
    
}

/* Başlık stili */
h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #4CAF50; /* Koyu yeşil başlık rengi */
}

/* Form elemanları stili */
label {
    display: block;
    margin-bottom: 5px;
    color: #ffffff; /* Beyaz etiket rengi */
}

input[type="text"], input[type="email"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: none;
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #5c5c5c; /* Gri input arka plan rengi */
    color: #ffffff; /* Beyaz input yazı rengi */
}

button[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50; /* Koyu yeşil buton rengi */
    color: #ffffff; /* Beyaz buton yazı rengi */
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #45a049; /* Daha koyu yeşil hover rengi */
}

/* Hata mesajları stili */
.invalid-feedback {
    color: #ff6b6b; /* Kırmızı hata mesajı rengi */
    font-size: 12px;
}

/* Alt metin ve link stili */
p {
    text-align: center;
    margin-top: 10px;
}

a {
    color: #4CAF50; /* Koyu yeşil link rengi */
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Mobil cihazlar için uyarlamalar */
@media (max-width: 600px) {
    body {
        padding: 0 10px; /* Mobilde daha küçük kenar boşluğu */
    }

    .card {
        padding: 15px; /* Mobilde daha küçük form padding */
        width: 260px;
        height:740px;
    }
}
</style>
  </head>
  <body>
    <div class="container p-5">
        <div class="card p-5">
        <!--T-->
        <form action="login.php" method="POST">
      <img src="./photos/agrital.png" alt="">      
    <h1>LOG IN</h1>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="text" class="form-control <?php if (!empty($email_err)) { echo "is-invalid"; } ?>" id="exampleInputEmail1" name="email">
        <div class="invalid-feedback">
            <?php echo $email_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control <?php if (!empty($password_err)) { echo "is-invalid"; } ?>" id="exampleInputPassword1" name="password">
        <div class="invalid-feedback">
            <?php echo $password_err; ?>
        </div>
    </div>
    <div >
            <div style="display:flex;"><button type="submit" name="login" class="btn btn-primary">Log in</button>    
            <button style="margin-left:5px; margin-right:5px" type="submit" name="signnup" class="btn btn-primary">Sign up</button></div>
            <div><span style="font-size:15px; margin-top:10px;"><a href="forgot_password.php">Forgot Password?</a></span></div>
            
        </div>
    </div>
</form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>