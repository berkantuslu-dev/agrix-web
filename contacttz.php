<!DOCTYPE html>
<html lang="sw">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Agrix ni kampuni ya agritech inayoanzishwa katika Dar es Salaam, Tanzania. Tunawezesha wakulima na wauzaji kwa teknolojia za kilimo za kisasa, ufikiaji wa soko, na programu za elimu ili kuboresha uzalishaji, faida, na uendelevu katika sekta ya kilimo.">
<meta name="keywords" content="Tanzania agritech, kilimo cha kisasa, kilimo endelevu, programu za msaada kwa wakulima, elimu ya kilimo, ufikiaji wa soko, kilimo cha Dar es Salaam, uvumbuzi wa kilimo, suluhisho za wakulima, uchanganuzi wa kilimo, maendeleo ya biashara ya kilimo">
  <meta name="robots" content="index, follow">
  <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
   <title>Agrix Tanzania</title>
  <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="contact.css"> <!-- CSS dosyanızı buraya ekleyin -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
</head>
<body>

    <?php include 'navbartz.php'; ?> <!-- Varsayılan navbar -->

    <!-- Ijumaa ya Mawasiliano -->
    <section class="contact-section">
        <h1 class="contact-title">Wasiliana Nasi</h1>
        <p class="contact-description">Unaweza kutufikia kupitia simu, WhatsApp, barua pepe, au kupitia fomu ya mawasiliano hapa chini.</p>

        <!-- Viungo vya Mawasiliano -->
        <div class="contact-links">
            <a href="tel:+255754006972" class="contact-link">
                <img src="./pics/phone-icon.png" alt="izmir psychologist" class="icon"> Piga Simu
            </a>
            <a href="https://wa.me/905439019135" class="contact-link" target="_blank">
                <img src="./pics/whatsapp-icon.png" alt="izmir psychologist" class="icon"> Wasiliana kupitia WhatsApp
            </a>
            <a href="mailto:info@ornek.com" class="contact-link">
                <img src="./pics/email-icon.png" alt="izmir psychologist" class="icon"> contact@agrixtz.com
            </a>
       
        </div>
    </section>

    <div class="form-container">
  <?php
  $message="";
  if (isset($_GET['error'])) {
    $message = "Tafadhali jaza sehemu iliyo wazi";
    echo '<div>'.$message.'</div>';
  }  

  if (isset($_GET['success'])) {
    $message = "Ujumbe wako umepokelewa";
    echo '<div>'.$message.'</div>';
  }
  ?>
  
</div>

<?php include('footertz.php'); ?>

</body>
</html>
