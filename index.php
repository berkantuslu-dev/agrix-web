<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <meta charset="UTF-8">
    <meta name="description" content="Agrix is an innovative agritech company based in Dar es Salaam, Tanzania. We empower farmers and retailers with smart agricultural technologies, market access, and educational programs to enhance productivity, profitability, and sustainability in the agricultural sector.">
<meta name="keywords" content="Tanzania agritech, smart farming, sustainable agriculture, farmer support programs, agricultural education, market access, Dar es Salaam agriculture, agricultural innovation, farmer solutions, agri analytics, agribusiness development">
  <meta name="robots" content="index, follow">
  <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
    <title>Agrix Tanzania</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<section class="hero">
	<div class="shade">
	
	</div>
        <h1>Empowering Horticulture Farmers and Retailers in Tanzania</h1>
        <p>Discover how Agrix transforms the horticulture landscape, providing innovative solutions to enhance productivity and profitability for stakeholders across the industry.</p>
        <button><a style="color: white; text-decoration: none;" href="about.php">Learn More</a> </button>
    </section>

    <section class="about">
        <h2>About Us</h2>
        <p> 
            Agrix is dedicated to revolutionizing the horticulture industry in Tanzania. With over 4.5 million people employed in this sector, our mission is to empower small-scale farmers, particularly women and youth, by addressing critical challenges and creating sustainable solutions that benefit everyone involved. <br> <br>
            At Agrix, we believe in a future where every farmer and retailer has access to the resources, information, and market opportunities needed to thrive. Our vision is to build a more sustainable horticultural sector that empowers individuals and fosters economic growth.
        </p>
    </section>


  

<section class="key-activities">
        <h2>Key Activities</h2>
        <div class="card-container">
            <div class="card">
                <h3>Transportation & Storage</h3>
                <p>Effective handling of crops to ensure freshness and quality for retailers.</p>
            </div>
            <div class="card">
                <h3>Direct Business Services</h3>
                <p>Continuous replenishment of stocks for retailers, ensuring they receive the freshest produce daily.</p>
            </div>
            <div class="card">
                <h3>Training & Capacity Building</h3>
                <p>Collaborating with NGOs to enhance farmers' skills in sustainable agricultural practices.</p>
            </div>
        </div>
    </section>
    <section class="partners">
    <h2>Our Partners</h2>
    <div class="slider-container">
        <div class="slider" id="slider">
            <div class="slider-item">
                <img src="./pics/partner.png" alt="Partner 1">
                
            </div>
            <div class="slider-item">
                <img src="./pics/qu.png" alt="Partner 2">
                
            </div>
			 <div class="slider-item">
                <img src="./pics/master.png" alt="Partner 2">
                
            </div>
        </div>
    </div>
    <button class="slider-arrow arrow-left" id="arrow-left">&#8592;</button>
    <button class="slider-arrow arrow-right" id="arrow-right">&#8594;</button>
</section>

	
	 <section class="partners">
    <h2>Sustainable Development Goals We Support</h2>
    <div class="slider-container">
        <div class="slider" id="slider">
            <div class="slider-item">
                <img src="./pics/sd1.jpeg" alt="Partner 1">
                
            </div>
            <div class="slider-item">
                <img src="./pics/sd2.jpeg" alt="Partner 2">
                
            </div>
			 <div class="slider-item">
                <img src="./pics/sd3.jpeg" alt="Partner 3">
                
            </div>
			<div class="slider-item">
                <img src="./pics/sd4.jpeg" alt="Partner 4">
                
            </div>
			<div class="slider-item">
                <img src="./pics/sd5.jpeg" alt="Partner 5">
                
            </div>
			<div class="slider-item">
                <img src="./pics/sd6.jpeg" alt="Partner 6">
                
            </div>
			<div class="slider-item">
                <img src="./pics/sd7.jpeg" alt="Partner 7">
                
            </div>
        </div>
    </div>
    <button class="slider-arrow arrow-left" id="arrow-left">&#8592;</button>
    <button class="slider-arrow arrow-right" id="arrow-right">&#8594;</button>
</section>

<?php include 'footer.php'; ?>
<script>
    const slider = document.getElementById('slider');
    const arrowLeft = document.getElementById('arrow-left');
    const arrowRight = document.getElementById('arrow-right');

    let currentIndex = 0;

    arrowLeft.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            slider.style.transform = `translateX(-${currentIndex * 270}px)`;
        }
    });

    arrowRight.addEventListener('click', () => {
        if (currentIndex < slider.children.length - 1) {
            currentIndex++;
            slider.style.transform = `translateX(-${currentIndex * 270}px)`;
        }
    });
</script>
</body>
</html>