<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
include("baglanti.php");

$email_err = $success_msg = "";

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    
    if (empty($email)) {
        $email_err = "Barua pepe haiwezi kuwa tupu.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Umbizo wa barua pepe si sahihi.";
    } else {
        // Check if the email exists in the database
        $query = "SELECT * FROM kullanicilar WHERE email = ?";
        $stmt = mysqli_prepare($baglanti, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Generate a unique token
            $token = bin2hex(random_bytes(25)); // 25 karakterlik rastgele bir token oluşturuluyor
            $expires = time() + 1800; // Token 30 dakika (1800 saniye) geçerli olacak

            // Delete any existing tokens for this user
            $query = "DELETE FROM password_reset_requests WHERE email=?";
            $stmt = mysqli_prepare($baglanti, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            // Insert the new token into the password_reset_requests table
            $query = "INSERT INTO password_reset_requests (email, token, expires) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($baglanti, $query);
            mysqli_stmt_bind_param($stmt, "ssi", $email, $token, $expires);
            mysqli_stmt_execute($stmt);

            // Create the reset password link
            $reset_link = "http://agrixtz.com/reset_password.php?token=$token";

            // Send the email using PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Outlook SMTP Ayarları
                  $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'agrixtzreset@gmail.com'; // Gmail adresini gir
            $mail->Password   = 'zcad hfnq pzwr ibom'; // Gmail uygulama şifresini gir
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
            $mail->Port       = 587; // Port 587


                // Email ayarları
                $mail->setFrom('no-reply@agrixtz.com', 'Agrix');
                $mail->addAddress($email);
                $mail->Subject = 'Ombi la Kurudisha Nenosiri';
                $mail->Body    = "Bofya kwenye kiungo kifuatacho ili kurudisha nenosiri lako: $reset_link";
                
                $mail->send();
                $success_msg = "Kiungo cha kurudisha nenosiri kimepelekwa kwenye barua pepe yako.";
            } catch (Exception $e) {
                $email_err = "Imeshindikana kutuma barua pepe ya kurudisha nenosiri. Hitilafu ya Mtoa Huduma wa Barua: {$mail->ErrorInfo}";
            }
        } else {
            $email_err = "Hakuna mtumiaji aliyepatikana kwa anwani hii ya barua pepe.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
	 <style>
        /* General page style */
        body {
            font-family: "Open Sans", sans-serif;
            background-color: #2c2c2c; /* Dark background color */
            color: #ffffff; /* White text color */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0 20px; /* Padding from the edges */
        }

        /* Form card */
        form {
            background-color: #3b3b3b; /* Lighter dark card color */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        /* Title style */
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50; /* Green title color */
        }

        /* Form elements style */
        label {
            display: block;
            margin-bottom: 5px;
            color: #ffffff; /* White label color */
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #5c5c5c; /* Gray input background color */
            color: #ffffff; /* White input text color */
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50; /* Green button color */
            color: #ffffff; /* White button text color */
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049; /* Darker green hover color */
        }

        /* Error messages style */
        .invalid-feedback {
            color: #ff6b6b; /* Red error message color */
            font-size: 12px;
            margin-top: 5px;
        }

        /* Success message style */
        .success-msg {
            color: #4CAF50; /* Green success message color */
            font-size: 14px;
            margin-top: 10px;
        }

        /* Link style */
        a {
            color: #4CAF50; /* Green link color */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            body {
                padding: 0 10px; /* Smaller padding on mobile */
            }

            form {
                padding: 15px; /* Smaller form padding on mobile */
            }
        }
    </style>
</head>
<body>
    <form action="forgot_password.php" method="POST">
        <h1>Umesahau Nenosiri</h1>
        <div>
            <label for="email">Barua Pepe</label>
            <input type="text" id="email" name="email">
            <div>
                <?php echo $email_err; ?>
            </div>
            <?php if (!empty($success_msg)) echo "<p>$success_msg</p>"; ?>
        </div>
        <button type="submit" name="submit">Wasilisha</button>
    </form>
</body>
</html>  
