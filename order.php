<?php

include("baglanti.php");
session_start();

if (isset($_POST["order"])) {

// SESSION'dan $username değişkenini alma
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  
} else {
  echo "Kullanıcı adı bulunamadı.";
}
$seller_number =  $_POST["sellerNumber"];;
$product_name = $_POST["productName"]; 
$product_quantity = $_POST["productQuantity"]; 
$seller_region = $_POST["sellerRegion"];  
$seller_address = $_POST["sellerAddress"]; 


if ((isset($seller_number) && isset($product_name)&& isset($product_quantity)&& isset($seller_region)&& isset($seller_address))) {
  
  $add="INSERT INTO orders(username, phoneNumber, productName, productQuantity, sellerRegion, sellerAddress) VALUES('$username','$seller_number','$product_name','$product_quantity','$seller_region','$seller_address')";
  $calistirekle= mysqli_query($baglanti, $add);

  if ($calistirekle) {//kullanici ekleme islemi basariliysa succes box'unu yazdir dedik
    echo '<div class="successAlert" role="alert">
    Oda yako imepokelewa.Utataarifiwa
  </div>';
} else {// aksi durumda ise error box'unu yazdir dedik
  echo '<div class="alert alert-danger" role="alert">
Mauzo yako haiwezi kusindikizwa.
</div>';
}
mysqli_close($baglanti);
}

}








?>


<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrix Portal Profile</title>
    <meta name="description" content="Agrix ni kampuni ya kiteknolojia ya kilimo inayobuni na kuleta mabadiliko, iko jijini Dar es Salaam, Tanzania. Tunawaimarisha wakulima na wafanyabiashara kwa kutumia teknolojia za kisasa za kilimo, upatikanaji wa soko, na programu za kielimu ili kuongeza tija, faida, na uendelevu katika sekta ya kilimo.">
<meta name="keywords" content="Teknolojia ya Kilimo Tanzania, kilimo cha kisasa, kilimo endelevu, mipango ya kusaidia wakulima, elimu ya kilimo, upatikanaji wa soko, kilimo Dar es Salaam, ubunifu wa kilimo, suluhisho kwa wakulima, uchambuzi wa kilimo, maendeleo ya biashara ya kilimo.">
  <meta name="robots" content="index, follow">
  <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./sellorder.css">
    
    <script src="https://kit.fontawesome.com/947531a5fc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
</head>
    
</head>
<body>
<section class="profile">   
  <div class="sidebar-container">
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
      <div class="sidebar">
        <header>  <?php
          
           if (isset($_SESSION["username"])) {
           echo "<h3> KARIBU:"." ".$_SESSION["username"]."</h3>";
         
           }else {
            header("Location: login.php");
           }
       ?></header>
      <a href="./profile.php" >
        <i class="fas fa-qrcode"></i>
        <span>Dashibodi</span>
      </a>
      <a href="./sell.php" >
      <i class="fa-solid fa-shop"></i>
        <span>Uza</span>
      </a>
      <a href="./order.php" class="active" >
      <i class="fa-solid fa-basket-shopping"></i>
        <span>Oda</span>
      </a>
      <?php
            
            if (isset($_SESSION["email"])) {
            echo "<a href ='cikis.php'><i class='fa-solid fa-right-from-bracket'></i>
            <span>Toka</span></a>";
            }else {
            echo "Huna ruhusa ya kufikia ukurasa huu";
            }
        ?>
    </div>
    </div>
    <div class="container">
    <!-- FORM START----------------------------------------------------------------------- -->
    <form action="order.php" method="POST">
    <h1 style="color:black;">Oda Mazao</h1>
        <div class="form-group">
            <label for="sellerName">Nambari ya Simu</label>
            <input type="text" id="sellerName" name="sellerNumber" required>
        </div>
        <div class="form-group">
            <label for="productName">Mazao</label>
            <input type="text" id="productName" name="productName" required>
        </div>
        <div class="form-group">
            <label for="productQuantity">Kiasi (kg):</label>
            <input type="number" id="productQuantity" name="productQuantity" min="0" step="0.1" required>
        </div>
        <div class="form-group">
            <label for="productName">Eneo Lako</label>
            <input type="text" id="productName" name="sellerRegion" required>
        </div>
        <div class="form-group">
            <label for="productName">Anwani Kamili</label>
            <input type="text" id="productName" name="sellerAddress" required>
        </div>
        <button type="submit" name="order">Oda Mazao</button>
        <img src="./photos/agrital.png" alt="">
    </form>
<!-- FORM END----------------------------------------------------------------------- -->

<!-- WELCOME MOBILE START----------------------------------------------------------------------- -->
    <div class="welcome">
    <?php
           
           if (isset($_SESSION["username"])) {
            echo "<h3> KARIBU"."<br> ".$_SESSION["username"]."</h3>";
          
            }else {
            echo "Huna ruhusa ya kufikia ukurasa huu.";
            }
       ?>
    </div>
    <!-- WELCOME MOBILE END----------------------------------------------------------------------- -->
     <div class="agritalAd">
      <h1>AGRIX</h1>
      <h2>FANYA BIASHARA BILA STRESS</h2>
      <p>
Karibu kwa Agrix!  

Agrix, tunaziba pengo kati ya wakulima na wauzaji rejareja, na kufanya iwe rahisi kwako kuunganishwa na kufanya biashara. Wakulima wanaweza kujisajili kwenye tovuti yetu kwa ajılı ya kuuza mazao zao, wakati wauzaji rejareja wanaweza kujisajili ili kununua mazao yenye ubora kutoka moja kwa moja shambani. Uratibu wetu nı rahisi na wa uhakika,ada nı nafuu, na huduma nı ya uhakıa. Jiunge nasi leo na unafaike na kilimo pamoja na bishara ya mazao ya bustani na mali mbichi</p>
     </div>
</div>
</section>
</body>
</html>