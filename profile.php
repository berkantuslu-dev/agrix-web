<?php
include("baglanti.php");
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrix Portal Profile</title>
    <meta name="description" content="Agrix ni kampuni ya teknolojia ya kilimo inayovumbua iliyoko Dar es Salaam, Tanzania. Tunawapa wakulima na wauzaji nguvu kupitia teknolojia za kisasa za kilimo, ufikiaji wa masoko, na programu za kielimu ili kuboresha uzalishaji, faida, na uendelevu katika sekta ya kilimo." >
<meta name="keywords" content="Kilimo cha teknolojia Tanzania, kilimo cha kisasa, kilimo endelevu, mipango ya msaada kwa wakulima, elimu ya kilimo, ufikiaji wa masoko, kilimo cha Dar es Salaam, uvumbuzi wa kilimo, suluhu za wakulima, uchambuzi wa kilimo, maendeleo ya biashara ya kilimo.">
  <meta name="robots" content="index, follow">
  <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
    <link rel="stylesheet" href="./dashboard.css">
    <script src="https://kit.fontawesome.com/947531a5fc.js" crossorigin="anonymous"></script>
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
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
        <header>  
          <?php
          if (isset($_SESSION["username"])) {
            echo "<h3> KARIBU:"." ".$_SESSION["username"]."</h3>";
          } else {
            header("Location: login.php");
          }
          ?>
        </header>
        <a href="./profile.php" class="active">
          <i class="fas fa-qrcode"></i>
          <span>Dashibodi</span>
        </a>
        <a href="./sell.php" >
          <i class="fa-solid fa-shop"></i>
          <span>Uza</span>
        </a>
        <a href="./order.php">
          <i class="fa-solid fa-basket-shopping"></i>
          <span>Oda</span>
        </a>
        <?php
        if (isset($_SESSION["email"])) {
          echo "<a href='cikis.php'><i class='fa-solid fa-right-from-bracket'></i><span>TOKA</span></a>";
        } else {
          header("Location: login.php");
        }
        ?>
      </div>
  </div>
  <div class="container">
    <!-- YOUR ORDERS -->
    <form class="sell">
      <h1 style="color:black;">ODA YAKO</h1>
      <?php
      $query = "SELECT productName, productQuantity, sellDate, isCompleted FROM orders WHERE username=?";
      $stmt = $baglanti->prepare($query);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Jina la Bidhaa.</th><th>Kiasi cha Bidhaa.<br>(kg)</th><th>Tarehe ya Uuzaji.</th><th>Hali.</th></tr>";
        while ($row = $result->fetch_assoc()) {
          $statusColor = $row['isCompleted'] == 1 ? 'green' : 'red';
          $sellDate = new DateTime($row['sellDate']);
          echo "<tr class='$statusColor'><td>{$row['productName']}</td><td>{$row['productQuantity']}</td><td>" . $sellDate->format('d M Y') . "</td><td>" . ($row['isCompleted'] == 1 ? 'Completed' : 'Pending') . "</td></tr>";
        }
        echo "</table>";
      } else {
        echo "Bado hujaweka oda yako";
      }

      $stmt->close();
      ?>
      <img src="./photos/agrital.png" alt="">
    </form>

    <!-- YOUR SELLS -->
    <form class="sell">
      <h1 style="color:black;">MAUZO YAKO</h1>
      <?php
      $query = "SELECT productName, productQuantity, sellDate, isCompleted FROM sellers WHERE username=?";
      $stmt = $baglanti->prepare($query);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Jina la Mazao</th><th>Kiasi cha Mazao.<br>(kg)</th><th>Tarehe ya Uuzaji.</th><th>Matokeo</th></tr>";
        while ($row = $result->fetch_assoc()) {
          $statusColor = $row['isCompleted'] == 1 ? 'green' : 'red';
          $sellDate = new DateTime($row['sellDate']);
          echo "<tr class='$statusColor'><td>{$row['productName']}</td><td>{$row['productQuantity']}</td><td>" . $sellDate->format('d M Y') . "</td><td>" . ($row['isCompleted'] == 1 ? 'Completed' : 'Pending') . "</td></tr>";
        }
        echo "</table>";
      } else {
        echo "Bado haujauza chochote.";
      }

      $stmt->close();
      ?>
      <img src="./photos/agrital.png" alt="">
    </form>

    <!-- WELCOME MOBILE START----------------------------------------------------------------------- -->
    <div class="welcome">
      <?php
      if (isset($_SESSION["username"])) {
        echo "<h3> KARIBU<br> ".$_SESSION["username"]."</h3>";
      } else {
        echo "Huna ruhusa ya kufikia ukurasa huu.";
      }
      ?>
    </div>
    <!-- WELCOME MOBILE END----------------------------------------------------------------------- -->
  </div>
</section>
</body>
</html>


