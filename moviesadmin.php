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

<div class="row_container">

<button id="addMovieButton">Add Movie/Show</button>
    <form id="movieForm" style="display: none;">
        <label for="movieName">Movie Name:</label><br>
        <input type="text" id="movieName" name="movieName"><br>
        <label for="directors">Directors:</label><br>
        <input type="text" id="directors" name="directors"><br>
        <label for="actors">Actors:</label><br>
        <input type="text" id="actors" name="actors"><br>
        <label for="posterURL">Poster URL:</label><br>
        <input type="text" id="posterURL" name="posterURL"><br>
        <label for="featured">Featured Film:</label><br>
        <input type="checkbox" id="featured" name="featured"><br>
        <input type="submit" value="Submit">
    </form>
    <script src="movies.js"></script>

    <div class="row">
        <h1 class="row_title">HOOP ORIGINALS</h1>
        <div class="row_posters">
                <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
                <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    <!--Trending Now-->
    <div class="row">
        <h1 class="row_title">TRENDING NOW</h1>
        <div class="row_posters">
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    <!--TOP RATED-->
    <div class="row">
        <h1 class="row_title">TOP RATED</h1>
        <div class="row_posters">
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div>
    <!--ACTION MOVIES-->
    <div class="row">
        <h1 class="row_title">ACTION</h1>
        <div class="row_posters">
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    <!--COMEDY-->
    <div class="row">
        <h1 class="row_title">COMEDY</h1>
        <div class="row_posters">
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div>  
    <!--Romance-->
    <div class="row">
        <h1 class="row_title">ROMANCE</h1>
        <div class="row_posters">
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    <!--Science Fiction-->
    <div class="row">
        <h1 class="row_title">SCI-FI</h1>
        <div class="row_posters">
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    <!--Horror-->
    <div class="row">
        <h1 class="row_title">HORROR</h1>
        <div class="row_posters">
            <img src="img/large-movie1.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie2.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie3.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie4.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie5.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie6.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie7.jpg" alt="movie poster" class="movie_poster" />
            <img src="img/large-movie8.jpg" alt="movie poster" class="movie_poster" />
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </div> 
    <!--Documentaries-->
</div>
<script src="js/movies.js"></script>
</body>
</html>
