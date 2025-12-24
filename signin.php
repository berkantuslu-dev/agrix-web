<?php
include("baglanti.php"); // Include your database connection file

// Initialize error variables
$username_err = "";
$email_err = "";
$password_err = "";
$passwordrpt_err = "";
$phone_err = "";

// Check if login button is clicked
if (isset($_POST["loggin"])) {
    header("Location: login.php"); // Redirect to login page
    exit; // Ensure script stops executing after redirect
}

// Check if signup button is clicked
if (isset($_POST["signup"])) {

    // Validate username
    if (empty($_POST["username"])) {
        $username_err = "Jina la mtumiaji haliwezi kuwa tupu.";
    } elseif (strlen($_POST["username"]) < 3) {
        $username_err = "Jina lako la mtumiaji linapaswa kuwa na herufi zaidi ya 3.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST["username"])) {
        $username_err = "Jina lako la mtumiaji haliwezi kuwa na herufi maalum.";
    } else {
        // Prepare username for database insertion
        $username = mysqli_real_escape_string($baglanti, $_POST["username"]);

        // Check if username already exists
        $check_username_query = "SELECT * FROM kullanicilar WHERE user_name = '$username'";
        $check_username_result = mysqli_query($baglanti, $check_username_query);
        if (mysqli_num_rows($check_username_result) > 0) {
            $username_err = "Jina la mtumiaji tayari lipo.";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $email_err = "Barua pepe haiwezi kuwa tupu.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Muundo wa barua pepe si sahihi.";
    } else {
        // Prepare email for database insertion
        $email = mysqli_real_escape_string($baglanti, $_POST["email"]);

        // Check if email already exists
        $check_email_query = "SELECT * FROM kullanicilar WHERE email = '$email'";
        $check_email_result = mysqli_query($baglanti, $check_email_query);
        if (mysqli_num_rows($check_email_result) > 0) {
            $email_err = "Barua pepe tayari ipo.";
        }
    }


 

        // Validate phone
        if (empty($_POST["phone"])) {
            $phone_err = "Nambari ya simu haiwezi kuwa tupu";
        } elseif (!preg_match('/^[0-9]{10,15}$/', $_POST["phone"])) {
            $phone_err = "Nambari ya simu inapaswa kuwa na tarakimu pekee na kuwa na urefu wa herufi 10 hadi 15";
        } else {
            // Prepare phone for database insertion
            $phone = mysqli_real_escape_string($baglanti, $_POST["phone"]);
    
            // Check if phone already exists
            $check_phone_query = "SELECT * FROM kullanicilar WHERE phone = '$phone'";
            $check_phone_result = mysqli_query($baglanti, $check_phone_query);
            if (mysqli_num_rows($check_phone_result) > 0) {
                $phone_err = "Nambari hii ya simu tayari imesajiliwa.";
            }
        }
    
    
    // Validate password
    if (empty($_POST["password"])) {
        $password_err = "Nywila haiwezi kuwa tupu.";
    }

    // Validate password repeat
    if (empty($_POST["password-rpt"])) {
        $passwordrpt_err = "Tafadhali ingiza tena nywila yako";
    } elseif ($_POST["password"] != $_POST["password-rpt"]) {
        $passwordrpt_err = "Passwords are not matching";
    }

    // If no errors, proceed with registration
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($passwordrpt_err)) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password

        // Insert user into database
        $add = "INSERT INTO kullanicilar(user_name, email, phone, password) VALUES('$username','$email', '$phone','$password')";
        $calistirekle = mysqli_query($baglanti, $add);

        // Check if insertion was successful
        // Ekleme başarılı olduysa mesajı gösterin
        if ($calistirekle) {
            $success_message = '<div style="background-color: #4CAF50; color: white; padding: 10px; border-radius: 5px; margin-top: 10px;">
                                   Usajili wako umekamilika kwa mafanikio.
                                </div>';
                                echo $success_message;
        } else {
            // Veritabanı hatası varsa hata mesajını gösterin
            $error_message = '<div style="background-color: #f44336; color: white; padding: 10px; border-radius: 5px; margin-top: 10px;">
                                Kusajili kumeshindikana kutokana na hitilafu ya msingi wa data.
                            </div>';
                            echo $error_message;
        }

        mysqli_close($baglanti); // Close database connection
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agrix Portal</title>
	<meta name="description" content="Agrix ni kampuni ya teknolojia ya kilimo inayovumbua iliyoko Dar es Salaam, Tanzania. Tunawapa wakulima na wauzaji nguvu kupitia teknolojia za kisasa za kilimo, ufikiaji wa masoko, na programu za kielimu ili kuboresha uzalishaji, faida, na uendelevu katika sekta ya kilimo.">
<meta name="keywords" content="Kilimo cha teknolojia Tanzania, kilimo cha kisasa, kilimo endelevu, mipango ya msaada kwa wakulima, elimu ya kilimo, ufikiaji wa masoko, kilimo cha Dar es Salaam, uvumbuzi wa kilimo, suluhu za wakulima, uchambuzi wa kilimo, maendeleo ya biashara ya kilimo.">
  <meta name="robots" content="index, follow">
  <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>
        /* Genel sayfa stili */
        body {
            font-family: "Open Sans", sans-serif;
            background-color: #2c2c2c; /* Açık siyah arka plan rengi */
            color: #ffffff; /* Beyaz yazı rengi */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: fit-content;
            margin: 0;
            padding: 0 20px; /* Kenarlardan boşluk */
        }

        /* Giriş formu kartı */
        .card {
            background-color: #3b3b3b; /* Daha açık siyah kart rengi */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 500px; /* Kart genişliği biraz daha genişletildi */
            height:fit-content;
            box-sizing: border-box;
            
            margin-top:50px;
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
            padding: 5px;
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
            margin-bottom:7px;
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
                width: 250px;
            }
        }

        /* Resim stili */
        .form-logo {
            display: block;
            margin: 0 auto 20px auto; /* Resmi ortala ve alt boşluk ekle */
            max-width: 200px; /* Maksimum genişlik ayarla */
            height: 170px;
        }
    </style>
</head>
<body>
<div class="container p-5">
    <div class="card p-5">
        <form action="signin.php" method="POST">
            <img src="./photos/agrital.png" alt="Logo" class="form-logo">
            <h1>JISAJILI.</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Jina la mtumiaji.</label>
                <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="exampleInputEmail1" name="username">
                <div class="invalid-feedback">
                    <?php echo $username_err; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Anwani ya barua pepe.</label>
                <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" id="exampleInputEmail1" name="email">
                <div class="invalid-feedback">
                    <?php echo $email_err; ?>
                </div>
            </div>

            <div class="mb-3">
    <label for="phoneInput" class="form-label">Nambari ya Simu.</label>
    <input type="text" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" id="phoneInput" name="phone">
    <div class="invalid-feedback">
        <?php echo $phone_err; ?>
    </div>
</div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nywila.</label>
                <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="exampleInputPassword1" name="password">
                <div class="invalid-feedback">
                    <?php echo $password_err; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Ingiza tena nywila.</label>
                <input type="password" class="form-control <?php echo (!empty($passwordrpt_err)) ? 'is-invalid' : ''; ?>" id="exampleInputPassword1" name="password-rpt">
                <div class="invalid-feedback">
                    <?php echo $passwordrpt_err; ?>
                </div>
            </div>
            <button type="submit" name="signup" class="btn btn-primary">Jisajili.</button>
            <button type="submit" name="loggin" class="btn btn-primary">Ingia.</button>
        </form>
    </div>
</div>
</body>
</html>