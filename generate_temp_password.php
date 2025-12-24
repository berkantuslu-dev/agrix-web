<?php
include("baglanti.php");

$email_err = "";

if (isset($_POST["generate"])) {
    if (empty($_POST["email"])) {
        $email_err = "E-mail can not be empty";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format";
    } else {
        $email = $_POST["email"];
    }

    if (isset($email)) {
        $query = "SELECT * FROM kullanicilar WHERE email = '$email'";
        $result = mysqli_query($baglanti, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $temp_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
            $hashed_temp_password = password_hash($temp_password, PASSWORD_DEFAULT);
            
            $update_query = "UPDATE kullanicilar SET password = '$hashed_temp_password' WHERE email = '$email'";
            $update_result = mysqli_query($baglanti, $update_query);

            if ($update_result) {
                echo '<div class="alert alert-success" role="alert">Your temporary password is: ' . $temp_password . '. Please log in and change your password.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Failed to generate temporary password. Please try again.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">User not found.</div>';
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generate Temporary Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container p-5">
    <div class="card p-5">
        <form action="generate_temp_password.php" method="POST">
            <h1>Generate Temporary Password</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="text" class="form-control <?php if (!empty($email_err)) { echo "is-invalid"; } ?>" id="exampleInputEmail1" name="email">
                <div class="invalid-feedback">
                    <?php echo $email_err; ?>
                </div>
            </div>
            <button type="submit" name="generate" class="btn btn-primary">Generate Temporary Password</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
