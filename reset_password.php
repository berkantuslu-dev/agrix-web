<?php
include("baglanti.php");

$token_err = $password_err = $passwordrpt_err = $success_msg = "";

if (isset($_POST["reset"])) {
    $token = $_POST["token"];
    $password = $_POST["password"];
    $passwordrpt = $_POST["password-rpt"];

    if (empty($password)) {
        $password_err = "Nenosiri haliwezi kuwa tupu.";
    } elseif ($password !== $passwordrpt) {
        $passwordrpt_err = "Manenosiri hayafanani.";
    } else {
        $new_password = password_hash($password, PASSWORD_DEFAULT);

        // Validate the token
        $query = "SELECT * FROM password_reset_requests WHERE token='$token' AND expires >= " . date("U");
        $result = mysqli_query($baglanti, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];

            // Update the user's password
            $query = "UPDATE kullanicilar SET password='$new_password' WHERE email='$email'";
            mysqli_query($baglanti, $query);

            // Delete the token
            $query = "DELETE FROM password_reset_requests WHERE email='$email'";
            mysqli_query($baglanti, $query);

            $success_msg = "Nenosiri limewekwa upya kwa mafanikio. <a href='login.php'> INGIA </a>";
        } else {
            $token_err = "Kiungo hiki cha kurudisha nenosiri ni batili au kimekwisha muda wake.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Weka Upya Nenosiri</title>
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

        input[type="password"] {
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
        p.error-msg {
            color: #ff6b6b; /* Red error message color */
            font-size: 12px;
            margin-top: 5px;
        }

        /* Success message style */
        p.success-msg {
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
    <form action="reset_password.php" method="POST">
        <h1>Weka Upya Nenosiri</h1>
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET["token"]); ?>">
        <div>
            <label for="password">Nenosiri Jipya:</label>
            <input type="password" id="password" name="password">
            <?php if (!empty($password_err)) echo "<p class='error-msg'>$password_err</p>"; ?>
        </div>
        <div>
            <label for="password-rpt">Andika Tena Nenosiri Jipya:</label>
            <input type="password" id="password-rpt" name="password-rpt">
            <?php if (!empty($passwordrpt_err)) echo "<p class='error-msg'>$passwordrpt_err</p>"; ?>
        </div>
        <button type="submit" name="reset">Weka Upya Nenosiri</button>
        <?php if (!empty($token_err)) echo "<p class='error-msg'>$token_err</p>"; ?>
        <?php if (!empty($success_msg)) echo "<p class='success-msg'>$success_msg</p>"; ?>
    </form>
</body>
</html>
