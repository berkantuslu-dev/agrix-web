<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Agrix is an innovative agritech company based in Dar es Salaam, Tanzania. We empower farmers and retailers with smart agricultural technologies, market access, and educational programs to enhance productivity, profitability, and sustainability in the agricultural sector.">
<meta name="keywords" content="Tanzania agritech, smart farming, sustainable agriculture, farmer support programs, agricultural education, market access, Dar es Salaam agriculture, agricultural innovation, farmer solutions, agri analytics, agribusiness development">
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

    <?php include 'navbar.php'; ?> <!-- Varsayılan navbar -->

    <!-- İletişim Başlık ve Açıklama -->
    <section class="contact-section">
        <h1 class="contact-title">Contact Us</h1>
        <p class="contact-description">You can reach us via phone, WhatsApp, email, or through the contact form below.</p>

        <!-- İletişim Bağlantıları -->
        <div class="contact-links">
            <a href="tel:+255754006972" class="contact-link">
                <img src="./pics/phone-icon.png" alt="izmir psychologist" class="icon"> Call Us
            </a>
            <a href="https://wa.me/905439019135" class="contact-link" target="_blank">
                <img src="./pics/whatsapp-icon.png" alt="izmir psychologist" class="icon"> Contact via WhatsApp
            </a>
            <a href="mailto:info@ornek.com" class="contact-link">
                <img src="./pics/email-icon.png" alt="izmir psychologist" class="icon"> contact@agrixtz.com
            </a>
       
        </div>
    </section>



    <div class="form-container" >
  <?php
  $message="";
  if (isset($_GET['error'])) {
    $message = "Please fill in the blank";
    echo '<div>'.$message.'</div>';
  }  

  if (isset($_GET['success'])) {
    $message = "Your message has been sent";
    echo '<div>'.$message.'</div>';
  }
  ?>
  
</div>




<?php include('footer.php'); ?>

</body>
</html>
