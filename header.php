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
	<link href="css/header.css" rel="stylesheet">
	<!--<link href="css/global.css" rel="stylesheet">-->
	<!--<link href="css/index.css" rel="stylesheet">-->
	<link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
	<script src="js/bootstrap.bundle.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>-->
</head>
<header>
<div class="main_1 clearfix position-absolute top-0 w-100">
<section id="header">
	<nav class="navbar navbar-expand-md navbar-light" id="navbar_sticky">
  <div class="container-xl">
	<a class="navbar-brand fs-2 p-0 fw-bold text-white m-0 me-5" href="homePage.php">
		<img src="img\hoopLogo.png" alt="Logo" width="180" height="150">
	</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	   <ul class="navbar-nav mb-0">
	    
        <li class="nav-item">
			<a class="nav-link active" aria-current="page" href="homePage.php">Home</a>
		  </li>
		  
		  <li class="nav-item">
			<a class="nav-link" href="movies.php">Movies </a>
		  </li>

		  <li class="nav-item">
			<a class="nav-link" href="tvshows.php">TV Shows </a>
		  </li>
		
		</ul>

      <ul class="navbar-nav mb-0 ms-auto">

		<!-- search starts -->
	      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle dropdown_search" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
            <i class="fa fa-search"></i>
          </a>
          <ul class="dropdown-menu drop_1 drop_o p-3" aria-labelledby="navbarDropdown" data-bs-popper="none">
            <li>
			  <div class="input-group p-2">
				<input   id="searchInput" type="text" class="form-control border-0" placeholder="Search Here">
				<span class="input-group-btn">
					<button class="btn btn-primary bg-transparent border-0 fs-5" type="button">
						<i class="fa fa-search col_red"></i> </button>
				</span>
		</div>
			</li>
          </ul>
        </li>

		<!-- search ends -->
	<!-- search ends -->

		<!-- profileButton starts -->
		<li class="nav-item">
			<a class="nav-link" href="profile.php"><i class="fa fa-user fs-4 align-middle me-1 lh-1 col_red"></i> My Profile </a>
		  </li>
		  <!-- profileButton ends -->

      </ul>
    </div>
  </div>
	</nav>
	</section>
 </div>


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
</header>
</html> 