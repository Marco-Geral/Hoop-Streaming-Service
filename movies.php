<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="css/movies.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

<!-- filter begins -->
<div id="buttons">
		<button class="button-value" onclick="getAction()"> Action </button>
		<button class="button-value" onclick="getComedy()"> Comedy </button>
		<button class="button-value" onclick="getRomance()"> Romance </button>
		<button class="button-value" onclick="getSciFi()"> Sci-fi </button>
		<button class="button-value" onclick="getHorror()"> Horror </button>
</div>


<div class="row_container">
    <div class="row">
        <h1 class="row_title">HOOP ORIGINALS</h1>
        <div class="row_posters originals">
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    <!--Trending Now-->
    <div class="row">
        <h1 class="row_title">RECOMMENDED FOR YOU</h1>
        <div class="row_posters recommended">
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    <!--TOP RATED-->
    <div class="row">
        <h1 class="row_title">TOP RATED</h1>
        <div class="row_posters topRated">
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div>
    <!--ACTION MOVIES-->
    <div class="row">
    <div class="row" data-genre="action">
        <h1 class="row_title">ACTION</h1>
        <div class="row_posters action">
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
   </div>
    <!--COMEDY-->
    <div class="row">
        <div class="row" data-genre="comedy">
        <h1 class="row_title">COMEDY</h1>
        <div class="row_posters comedy">
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div>  
    </div>
    <!--Romance-->
    <div class="row">
        <div class="row" data-genre="romance">
        <h1 class="row_title">ROMANCE</h1>
        <div class="row_posters romance">
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    </div>
    <!--Science Fiction-->
    <div class="row">
    <div class="row" data-genre="sci-fi">
        <h1 class="row_title">SCI-FI</h1>
        <div class="row_posters  scifi">
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    </div>
    <!--Horror-->
    <div class="row">
    <div class="row" data-genre="horror">
        <h1 class="row_title">HORROR</h1>
        <div class="row_posters horror">
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    </div>
    
    <!--Documentaries-->
</div>
<!--<script>
    /*code for filter (show filter buttons on filter icon click)
document.addEventListener('DOMContentLoaded', function() {
    const filterIcon = document.getElementById('filterIcon');
    const filterButtons = document.querySelector('.filterButtons');

    filterIcon.addEventListener('click', function() {
        filterButtons.style.display = filterButtons.style.display === 'none'? '' : 'none';
    });
});*/
</script> -->

<!-- Overlay -->
<div id="overlay" class="modal-overlay"></div>

<!-- Modal Content -->
<div id="movie-info" class="modal-content">
    <span class="close">&times;</span>
    <img src="img/large-movie1.jpg" alt="Movie Poster" class="movie_poster">
    <h1>Title of the Movie</h1>
    <p>Description of the movie...</p>
    <p>Rating: 3</p>
    <p>Release Date: 2024-01-03</p>
    <ul>
        <li>Actor 1</li>
        <li>Actor 2</li>
    </ul>
    <!--<div class="info-poster-container">
    <div class="info-content">
         Informational content goes here 
        <h2>Title of the Movie</h2>
        <p>Description of the movie...</p>
        <p>Rating: 4/5</p>
        <p>Release Date: 2024-01-01</p>
        <ul>
            <li>Actor 1</li>
            <li>Actor 2</li>
             More actors 
        </ul>
    </div>
    <div class="movie-poster">
        <img src="img/large-movie1.jpg" alt="Movie Poster">
    </div>
    </div>-->

    <!-- Play button or any other controls can be added here -->
</div>


<script> document.querySelectorAll('.movie_poster').forEach(function(moviePoster) {
    moviePoster.addEventListener('click', function() {
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('movie-info').style.display = 'block';
    });
});

document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('movie-info').style.display = 'none';
});

document.getElementById('overlay').addEventListener('click', function() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('movie-info').style.display = 'none';
});
 </script>
<script src="js/movies.js"></script>


</body>
</html>
