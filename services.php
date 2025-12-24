<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <meta name="robots" content="index, follow">
  <meta name="description" content="Agrix is an innovative agritech company based in Dar es Salaam, Tanzania. We empower farmers and retailers with smart agricultural technologies, market access, and educational programs to enhance productivity, profitability, and sustainability in the agricultural sector.">
<meta name="keywords" content="Tanzania agritech, smart farming, sustainable agriculture, farmer support programs, agricultural education, market access, Dar es Salaam agriculture, agricultural innovation, farmer solutions, agri analytics, agribusiness development">
  <meta name="robots" content="index, follow">
  <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
    <title>Agrix Tanzania</title>
    <link rel="stylesheet" href="hizmetlerimizen.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
   
</head>
<body>
<?php include 'navbar.php'; ?>
<section class="hizmetlerimiz-section">
    <div class="hizmetlerimiz-container">
        <h1 class="hizmetlerimiz-section-title">Our Services</h1>
        
        
        <div class="hizmetlerimiz-box">
            <h2 class="hizmetlerimiz-title">Transportation & Storage</h2>
            <p class="hizmetlerimiz-preview">Click here for more information.</p>
            <div class="hizmetlerimiz-detail">
                <p class="hizmetlerimiz-detail-text">Effective handling of crops to ensure freshness and quality for retailers.
                At Agrix, we prioritize the freshness and quality of crops by employing advanced transportation and storage methods. This service ensures that harvested produce is carefully handled, using temperature-controlled storage facilities and optimized logistics to prevent spoilage or quality loss. By maintaining the highest standards in crop preservation, we help retailers consistently deliver fresh, high-quality products to their customers, enhancing both trust and satisfaction.</p>
            </div>
        </div>

        <div class="hizmetlerimiz-box">
            <h2 class="hizmetlerimiz-title"> Direct Business Services</h2>
            <p class="hizmetlerimiz-preview">Click here for more information.</p>
            <div class="hizmetlerimiz-detail">
                <p class="hizmetlerimiz-detail-text">Continuous replenishment of stocks for retailers, ensuring they receive the freshest produce daily.
                Agrix's Direct Business Services provide retailers with a seamless supply chain solution. Through daily replenishments, we ensure that fresh produce reaches stores consistently, minimizing the risk of stock shortages. This service allows retailers to focus on serving their customers while we take care of the supply chain complexities, ensuring their shelves are always stocked with fresh and nutritious products.
                </p>
            </div>
        </div>

        <div class="hizmetlerimiz-box">
            <h2 class="hizmetlerimiz-title">Training & Capacity Building</h2>
            <p class="hizmetlerimiz-preview">Click here for more information.</p>
            <div class="hizmetlerimiz-detail">
                <p class="hizmetlerimiz-detail-text">Collaborating with NGOs to enhance farmers' skills in sustainable agricultural practices.
                We are committed to empowering farmers through education and training programs designed in collaboration with leading NGOs. These programs cover essential topics such as sustainable farming techniques, efficient resource management, and modern agricultural innovations. By equipping farmers with these skills, we enable them to increase productivity, reduce environmental impact, and secure better livelihoods for themselves and their communities.</p>
            </div>
        </div>


       




        <!-- Diğer hizmetler burada devam edebilir -->
    </div>
</section>
<?php include 'footer.php'; ?>
  <script>document.querySelectorAll('.hizmetlerimiz-box').forEach(box => {
    box.addEventListener('click', () => {
        box.classList.toggle('active');
    });
});
</script>
</body>
</html>