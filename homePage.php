<?php include 'header.php'; ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HOOP</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" >
	<link href="css/font-awesome.min.css" rel="stylesheet" >
	<link href="css/global.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
	<script src="js/bootstrap.bundle.min.js"></script>

</head>
<body>

<div class="main clearfix position-relative">
 <!-- header was here -->
 <div class="main_2 clearfix">

 <!-- carousel section starts -->
   <section id="center" class="center_home">
 <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
	<!-- buttons to slide through the carousel -->
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <!-- the actual images wihtin the carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-md-block">
		<!-- main title of carousel, doesnt need to be changed or made dynamic -->
         <h5 class="text-white-50 release ps-2 fs-6">NEW RELEASES</h5>
		 <!-- the title of the show/ movie -->
        <h1 class="font_80 mt-4">The Rise Of <br> The Show</h1>
		<!-- the ratings and short description block, we can remove this if the descriptions we get from the api are too long -->
		<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">6.1</span> <span class="col_green">IMDB SCORE</span> <span class="mx-3">2022</span> <span class="col_red">Romance, Action</span></h6>
		 <p class="mt-4">Certain but she but shyness why cottage. Guy the put instrument sir entreaties affronting.</p>
		 <!-- watch trailer button for aestheics. Don't need to implement -->
		<h5 class="mb-0 mt-4 text-uppercase"><a class="button" href="#"> Watch Trailer</a></h5>
      </div>
    </div>
	<!-- second carousel item starts here. Its the exact same structure as the above carousel item -->
    <div class="carousel-item">
      <img src="img/2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-md-block">
         <h5 class="text-white-50 release ps-2 fs-6">NEW RELEASES</h5>
        <h1 class="font_80 mt-4">Detail Of Popular<br>  New Show</h1>
		<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">7.3</span> <span class="col_green">IMDB SCORE</span> <span class="mx-3">2022</span> <span class="col_red">Romance, Action</span></h6>
		 <p class="mt-4">Certain but she but shyness why cottage. Guy the put instrument sir entreaties affronting.</p>
		<h5 class="mb-0 mt-4 text-uppercase"><a class="button" href="#"> Play Movie</a></h5>
      </div>
    </div>
	<!-- third carousel item -->
    <div class="carousel-item">
      <img src="img/3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-md-block">
         <h5 class="text-white-50 release ps-2 fs-6">NEW RELEASES</h5>
        <h1 class="font_80 mt-4">Lorem Ipsum <br> Sit Dolor</h1>
		<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">8.2</span> <span class="col_green">IMDB SCORE</span> <span class="mx-3">2022</span> <span class="col_red">Romance, Action</span></h6>
		 <p class="mt-4">Certain but she but shyness why cottage. Guy the put instrument sir entreaties affronting.</p>
		<h5 class="mb-0 mt-4 text-uppercase"><a class="button" href="#"> Watch Trailer</a></h5>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
	</div>
	</section>
	<!-- carousel section ends -->
 </div>
 
	</div>
			<!-- tv show section starts -->
			<section id="spec" class="p_3 bg_dark">
			<div class="container-xl">
			<div class="row stream_1 text-center">
			<div class="col-md-12">
			<h1 class="mb-0 text-white font_50"> TV Shows For You</h1>
			</div>
			</div>

			  <!-- First movie listing -->
			<div class="row spec_1 mt-4">
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
					<!-- Movie image -->
				<div class="spec_1imi clearfix">
					<img src="img/10.jpg" class="w-100" alt="abc">
				</div>
				 <!-- Movie details -->
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
						<!-- Video quality -->
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					   <!-- Rating -->
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">5.9</span></h6>
					</div>
					</div>
				</div>
				</div>
				<!-- Movie title and genre -->
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Ce Of Entro</a></h5>
				</div>
				</div>
				<!-- end of the first listing -->




				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/9.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">6.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">White Panther</a></h5>
				</div>
				</div>

				<!-- next listing begins -->

				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/11.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">7.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">160 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Coming Soon</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/12.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">8.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Handmaiden</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/13.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">6.9</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">The Silence</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/14.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">8.4</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Monospaced</a></h5>
				</div>
				</div>
			</div>
			<div class="row spec_1 mt-4">
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/15.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">5.9</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Ce Of Entro</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/16.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">6.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">White Panther</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/17.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">7.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">160 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Coming Soon</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/18.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">8.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Handmaiden</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/19.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">6.9</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">The Silence</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/20.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">8.4</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Monospaced</a></h5>
				</div>
				</div>
			</div>
			<div class="row spec_1 text-center mt-5">
			<div class="col-md-12">
			<h5 class="mb-0 text-uppercase"><a class="button" href="#"> BROWSE ALL TV SHOWS</a></h5>
			</div>
			</div>
			</div>
			</section>
		<!-- TV show sections ends -->


			<br>
			<br>

			<!-- movie section starts -->
			<section id="spec" class="p_3 bg_dark">
			<div class="container-xl">
			<div class="row stream_1 text-center">
			<div class="col-md-12">
			<h1 class="mb-0 text-white font_50"> Movies For You</h1>
			</div>
			</div>
			<div class="row spec_1 mt-4">
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/10.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">5.9</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Ce Of Entro</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/9.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">6.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">White Panther</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/11.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">7.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">160 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Coming Soon</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/12.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">8.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Handmaiden</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/13.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">6.9</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">The Silence</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/14.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">8.4</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Monospaced</a></h5>
				</div>
				</div>
			</div>
			<div class="row spec_1 mt-4">
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/15.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">5.9</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Ce Of Entro</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/16.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">6.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">White Panther</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/17.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">7.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">160 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Coming Soon</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/18.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">8.1</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Handmaiden</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/19.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">6.9</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">The Silence</a></h5>
				</div>
				</div>
				<div class="col-lg-2 pe-0 col-md-4">
				<div class="spec_1im clearfix position-relative">
				<div class="spec_1imi clearfix">
					<img src="img/20.jpg" class="w-100" alt="abc">
				</div>
					<div class="spec_1imi1 row  m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
					<div class="col-md-9 col-9 p-0">
					<div class="spec_1imi1l pt-2">
						<h6 class="mb-0 font_14 d-inline-block"><a class="bg-black d-block text-white"  href="#"> <span class="pe-2 ps-2">1080</span>  <span class="bg-white  d-inline-block text-black span_2"> HD</span></a></h6>
					</div>
					</div>
					<div class="col-md-3 col-3 p-0">
					<div class="spec_1imi1r">
						<h6 class="text-white"><span class="rating d-inline-block rounded-circle me-2 col_green">8.4</span></h6>
					</div>
					</div>
				</div>
				</div>
				<div class="spec_1im1 clearfix">
				<h6 class="text-light fw-normal font_14 mt-3">180 min,
			<span class="col_red">Action</span>
			<span class="span_1 pull-right d-inline-block">PG13</span></h6>
				<h5 class="mb-0 fs-6"><a class="text-white" href="#">Monospaced</a></h5>
				</div>
				</div>
			</div>
			<div class="row spec_1 text-center mt-5">
			<div class="col-md-12">
			<h5 class="mb-0 text-uppercase"><a class="button" href="#"> BROWSE ALL MOVIES</a></h5>
			</div>
			</div>
			</div>
			</section>
	<!-- movie section ends -->



<!-- js so that the header is sticky.  -->
<script>
window.onscroll = function() {myFunction()};

var navbar_sticky = document.getElementById("navbar_sticky");
var sticky = navbar_sticky.offsetTop;
var navbar_height = document.querySelector('.navbar').offsetHeight;

function myFunction() {
  if (window.pageYOffset >= sticky + navbar_height) {
    navbar_sticky.classList.add("sticky")
	document.body.style.paddingTop = navbar_height + 'px';
  } else {
    navbar_sticky.classList.remove("sticky");
	document.body.style.paddingTop = '0'
  }
}
</script>

</body>

</html>

<?php include 'footer.php'; ?>