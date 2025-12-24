<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Agrix is an innovative agritech company based in Dar es Salaam, Tanzania. We empower farmers and retailers with smart agricultural technologies, market access, and educational programs to enhance productivity, profitability, and sustainability in the agricultural sector.">
<meta name="keywords" content="Tanzania agritech, smart farming, sustainable agriculture, farmer support programs, agricultural education, market access, Dar es Salaam agriculture, agricultural innovation, farmer solutions, agri analytics, agribusiness development">
  <meta name="robots" content="index, follow">
  <link rel="icon" href="./pics/agrix.ico" type="image/x-icon">
    <title>Agrix Tanzania</title>
    <link rel="stylesheet" href="ourteam.css"> <!-- CSS dosyanızı buraya ekleyin -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Renova İzmir Psychologist</title>
</head>
<body>
<?php include 'navbar.php'; ?>

	
    
	
	
<div class="gallery">
	
	
	
	
	<div class="gallery-item">
        <img src="./pics/4.jpg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
	
	<div class="gallery-item">
        <img src="./pics/5.jpg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
	
	<div class="gallery-item">
        <img src="./pics/6.jpg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
	
	<div class="gallery-item">
        <img src="./pics/7.jpg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
	
	<div class="gallery-item">
        <img src="./pics/8.jpg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
	
	<div class="gallery-item">
        <img src="./pics/9.jpg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
	
	<div class="gallery-item">
        <img src="./pics/10.jpg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
	
	<div class="gallery-item">
        <img src="./pics/11.jpg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
	
	<div class="gallery-item">
        <img src="./pics/12.jpg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
	

	<div class="gallery-item">
        <img src="./pics/19.jpeg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
   
	<div class="gallery-item">
        <img src="./pics/20.jpeg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
	
	
	
	<div class="gallery-item">
        <img src="./pics/21.jpeg" alt="Agrix">
        <div class="title">Agrix</div>
    </div>
    
    <!-- İstediğiniz kadar fotoğraf ekleyin -->
</div>

<div class="fullscreen-viewer">
    <span class="arrow left">&#10094;</span>
    <img src="" alt="Tam Ekran Fotoğrafı">
    <div class="fullscreen-title"></div>
    <span class="arrow right">&#10095;</span>
    <span class="close">&times;</span>
</div>

<?php include('footer.php'); ?>

<script>
 const galleryItems = document.querySelectorAll('.gallery-item');
const fullscreenViewer = document.querySelector('.fullscreen-viewer');
const fullscreenImage = fullscreenViewer.querySelector('img');
const fullscreenTitle = fullscreenViewer.querySelector('.fullscreen-title');
const closeBtn = fullscreenViewer.querySelector('.close');
const leftArrow = fullscreenViewer.querySelector('.arrow.left');
const rightArrow = fullscreenViewer.querySelector('.arrow.right');

let currentIndex;

galleryItems.forEach((item, index) => {
    item.addEventListener('click', () => {
        fullscreenViewer.style.display = 'flex';
        fullscreenImage.src = item.querySelector('img').src;
        fullscreenTitle.textContent = item.querySelector('.title').textContent;
        currentIndex = index;
    });
});

function showImage(index) {
    if (index < 0) {
        currentIndex = galleryItems.length - 1;
    } else if (index >= galleryItems.length) {
        currentIndex = 0;
    } else {
        currentIndex = index;
    }
    fullscreenImage.src = galleryItems[currentIndex].querySelector('img').src;
    fullscreenTitle.textContent = galleryItems[currentIndex].querySelector('.title').textContent;
}

rightArrow.addEventListener('click', () => {
    showImage(currentIndex + 1);
});

leftArrow.addEventListener('click', () => {
    showImage(currentIndex - 1);
});

closeBtn.addEventListener('click', () => {
    fullscreenViewer.style.display = 'none';
});

// Ekranda fotoğraf dışındaki bir yere tıklanarak galeriye dönülmesi
fullscreenViewer.addEventListener('click', (e) => {
    // Eğer tıklama fotoğraf veya başlık dışında bir yere yapılırsa, galeriye dön
    if (e.target === fullscreenViewer) {
        fullscreenViewer.style.display = 'none';
    }
});

document.addEventListener('keydown', (e) => {
    if (fullscreenViewer.style.display === 'flex') {
        if (e.key === 'ArrowRight') {
            showImage(currentIndex + 1);
        } else if (e.key === 'ArrowLeft') {
            showImage(currentIndex - 1);
        } else if (e.key === 'Escape') {
            fullscreenViewer.style.display = 'none';
        }
    }
});


</script>
</body>
</html>