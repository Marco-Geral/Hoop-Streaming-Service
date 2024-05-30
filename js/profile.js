function setDetails(){
	const email = localStorage.getItem("username");
	const name = localStorage.getItem("Name");
	const phone = localStorage.getItem("phone");
	
	document.getElementById("emails").innerHTML = email;
	document.getElementById("name").innerHTML = name;
	document.getElementById("phones").innerHTML = phone;
}

function logout(){
	localStorage.clear();
	window.location = "welcomePage.php";
}
function getFavourites() {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);

  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            var images = JSON.parse(req.responseText);
            populateFavourites(images);
          } catch (error) {
            console.error("Error parsing JSON:", error);
          }
        } else {
          console.error("Empty response from server");
        }
      } else {
        console.error("Error:", req.status);
      }
    }
  };

  var load = JSON.stringify({
    "action": "GetFavourites",
    "customerID": localStorage.getItem("ID")
  });

  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);
}

async function populateFavourites(images) {
  try {
    const movies = await Promise.all(images.favorites.map(id => getInfo(id)));
    populateMovies(movies);
  } catch (error) {
    console.error("Error populating favourites:", error);
  }
}

function getInfo(id) {
  return new Promise((resolve, reject) => {
    var req = new XMLHttpRequest();
    req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);

    req.onreadystatechange = function () {
      if (req.readyState == 4) {
        if (req.status == 200) {
          if (req.responseText) {
            try {
              var response = JSON.parse(req.responseText);
              resolve(response);
            } catch (error) {
              console.error("Error parsing JSON:", error);
              reject(error);
            }
          } else {
            console.error("Empty response from server");
            reject(new Error("Empty response from server"));
          }
        } else {
          console.error("Error:", req.status);
          reject(new Error("Request failed with status " + req.status));
        }
      }
    };

    var load = JSON.stringify({
      "action": "GetAllShows",
      "return": "*",
      "search": { "id": id }
    });

    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);
  });
}

function populateMovies(movies) {
  const movieContainer = document.querySelector('.row.spec_1.mt-4');
  movieContainer.innerHTML = '';  // Clear any existing content

  movies.forEach(movie => {
    const movieElement = document.createElement('div');
    movieElement.className = 'col-lg-2 pe-0 col-md-4';

    movieElement.innerHTML = `
      <div class="spec_1im clearfix position-relative">
        <div class="spec_1imi clearfix">
          <img src="${movie.data[0].imgURL}" class="w-100" alt="${movie.data[0].title}">
        </div>
        <div class="spec_1imi1 row m-0 w-100 h-100 clearfix position-absolute bg_col top-0">
          <div class="col-md-9 col-9 p-0">
            <div class="spec_1imi1l pt-2">
              <h6 class="mb-0 font_14 d-inline-block">
                <a class="bg-black d-block text-white" href="#">
                  <span class="pe-2 ps-2">1080p</span>
                  <span class="bg-white d-inline-block text-black span_2">HD</span>
                </a>
              </h6>
            </div>
          </div>
          <div class="col-md-3 col-3 p-0">
            <div class="spec_1imi1r">
              <h6 class="text-white">
                <span class="rating d-inline-block rounded-circle me-2 col_green">${movie.data[0].rating}</span>
              </h6>
            </div>
          </div>
        </div>
      </div>
      <div class="spec_1im1 clearfix">
        <h6 class="text-light fw-normal font_14 mt-3">150 min,
          <span class="col_red">${movie.data[0].genres}</span>
          <span class="span_1 pull-right d-inline-block">PG13</span>
        </h6>
        <h5 class="mb-0 fs-6">
          <a class="text-white" href="#">${movie.data[0].title}</a>
        </h5>
        <button class="custom-btn" id='${movie.data[0].id}'>Remove from Favourites</button>
      </div>
    `;

    movieContainer.appendChild(movieElement);

    // Add event listener to the remove button
    movieElement.querySelector('.custom-btn').addEventListener('click', () => {
      removeFromFavourites(movie.data[0].id);
    });
  });
}

function removeFromFavourites(movieId) {
    console.log(`Removing movie with ID: ${movieId}`);
    
    var req = new XMLHttpRequest();
    req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);

    req.onreadystatechange = function () {
        if (req.readyState === 4) {
            if (req.status === 200) {
                if (req.responseText) {
                    try {
                        var response = JSON.parse(req.responseText);
                        deleted(response);
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                } else {
                    console.error("Empty response from server");
                }
            } else {
                console.error("Error:", req.status, req.statusText);
            }
        }
    };

    var payload = {
        action: "DeleteFavourites",
        customerID: localStorage.getItem("ID"),
        movieId: movieId // Include movieId in the payload
    };

    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");

    req.send(JSON.stringify(payload));
}

function deleted(response) {
    // Handle the response from the server after a successful deletion
    console.log("Successfully deleted:", response);
    getFavourites();
}


function deleted(){
	if(deleted === 'Array'){
		console.log("success");
		getFavourites();
	} else {
		console.log('error');
	}
}

window.onload = function(){
	setDetails();
	getFavourites();
}