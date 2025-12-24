<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <meta charset="UTF-8">
    <meta name="description" content="Agrix ni kampuni ya teknolojia ya kilimo yenye ubunifu iliyoko Dar es Salaam, Tanzania. Tunawawezesha wakulima na wauzaji kwa teknolojia bora za kilimo, upatikanaji wa masoko, na programu za elimu ili kuongeza uzalishaji, faida, na uendelevu katika sekta ya kilimo.">
    <meta name="keywords" content="Tanzania agritech, kilimo cha kisasa, kilimo endelevu, programu za msaada kwa wakulima, elimu ya kilimo, upatikanaji wa soko, kilimo Dar es Salaam, uvumbuzi wa kilimo, suluhisho za wakulima, uchambuzi wa kilimo, maendeleo ya biashara ya kilimo">
    <meta name="robots" content="index, follow">
    <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
    <title>Agrix Tanzania</title>
</head>
<body>
<?php include 'navbartz.php'; ?>
	<section class="hero">
	<div class="shade">
	
	</div>
        <h1>Kuwainua Wakulima wa Bustani na Wauzaji Tanzania</h1>
         <p>Gundua jinsi Agrix inavyobadilisha sekta ya kilimo cha bustani, ikitoa suluhisho bunifu ili kuongeza uzalishaji na faida kwa wadau wote.</p>
        <button><a style="color: white; text-decoration: none;" href="about.php">Jifunze Zaidi</a> </button>
    </section>


<section class="about">
        <h2>Kuhusu Sisi</h2>
        <p>
            Agrix imejitolea kubadilisha sekta ya kilimo cha bustani Tanzania. Zaidi ya watu milioni 4.5 wameajiriwa katika sekta hii, na dhamira yetu ni kuwawezesha wakulima wadogo wadogo, hususan wanawake na vijana, kwa kushughulikia changamoto muhimu na kuunda suluhisho endelevu kwa kila mtu aliyehusika. <br> <br>
            Katika Agrix, tunaamini katika siku zijazo ambapo kila mkulima na muuzaji atapata rasilimali, taarifa, na fursa za soko wanazohitaji ili kustawi. Dira yetu ni kujenga sekta ya kilimo cha bustani iliyo endelevu zaidi inayowawezesha watu binafsi na kukuza uchumi.
        </p>
</section>

<section class="key-activities">
        <h2>Shughuli Muhimu</h2>
        <div class="card-container">
            <div class="card">
                <h3>Usafirishaji na Uhifadhi</h3>
                <p>Ushughulikiaji mzuri wa mazao ili kuhakikisha ubora na usafi kwa wauzaji.</p>
            </div>
            <div class="card">
                <h3>Huduma za Moja kwa Moja kwa Biashara</h3>
                <p>Uhakikisho wa upatikanaji wa bidhaa mpya kwa wauzaji, kuhakikisha wanapokea mazao safi kila siku.</p>
            </div>
            <div class="card">
                <h3>Mafunzo na Ujenzi wa Uwezo</h3>
                <p>Kushirikiana na NGOs ili kuboresha ujuzi wa wakulima katika kilimo endelevu.</p>
            </div>
        </div>
</section>

<section class="partners">
    <h2>Wadau Wetu</h2>
    <div class="slider-container">
        <div class="slider" id="slider">
             <div class="slider-item">
                <img src="./pics/partner.png" alt="Mshirika 2">
                
            </div>
            <div class="slider-item">
                <img src="./pics/qu.png" alt="Mshirika 2">
                
            </div>
            <div class="slider-item">
                <img src="./pics/master.png" alt="Mshirika 3">
                
            </div>
            
        </div>
    </div>
    <button class="slider-arrow arrow-left" id="arrow-left">&#8592;</button>
    <button class="slider-arrow arrow-right" id="arrow-right">&#8594;</button>
</section>

<?php include 'footertz.php'; ?>
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