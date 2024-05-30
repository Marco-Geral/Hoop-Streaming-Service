function showModal(content) {
  var modal = document.getElementById('viewMovieModal');
  if (!modal) return;

  document.getElementById('viewMoviePoster').src = content.imgURL;
  document.getElementById('viewMovieTitle').textContent = content.title;
  document.getElementById('viewMovieDescription').textContent = content.description;
  document.getElementById('viewMovieRating').textContent = 'Rating: ' + content.rating;
  document.getElementById('viewMovieDate').textContent = 'Release Date: ' + content.release_date;
  document.getElementById('viewMovieActors').innerHTML = content.actor_name;

  var contentID = content.id;

  document.getElementById('addToFavoritesButton').onclick = function() {
    var req = new XMLHttpRequest();
    req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);

    req.onreadystatechange = function() {
      if (req.readyState == 4) {
        if (req.status == 200) {
          if (req.responseText) {
            try {
              alert("Added to favourites :)");
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
      "action": "AddToFavourites",
      "contentID": contentID,
      "customerID": localStorage.getItem("ID")
    });

    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);
  };

  modal.style.display = 'block';
}

function setCarousel() {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);
  var images = [];

  req.onreadystatechange = function() {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            images = JSON.parse(req.responseText);
            processCarousel(images);
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
    "action": "GetAllShows",
    "limit": 3,
    "return": "*"
  });
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);
}

function processCarousel(images) {
  var display = document.getElementsByClassName("d-block w-100");
  var names = document.getElementsByClassName("title");
  var descriptions = document.getElementsByClassName("des");
  var rating = document.getElementsByClassName("rating");
  var year = document.getElementsByClassName("year");
  var genre = document.getElementsByClassName("gen");

  for (var i = 0; i < display.length; i++) {
    display[i].src = images.data[i].imgURL;
    names[i].innerText = images.data[i].title;
    descriptions[i].innerText = images.data[i].description;
    rating[i].innerHTML = images.data[i].rating;
    year[i].innerHTML = images.data[i].release_date;
    genre[i].innerHTML = images.data[i].genres;
  }
}

function setTVShows() {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);
  var images = [];

  req.onreadystatechange = function() {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            images = JSON.parse(req.responseText);
            processShows(images);
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
    "action": "GetAllShows",
    "limit": 12,
    "return": "*",
    "filter": { "type": "Show" }
  });
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);
}

function processShows(images) {
  var display = document.getElementsByClassName("images");
  var names = document.getElementsByClassName("TVtitle");
  var rating = document.getElementsByClassName("TVrating");
  var genre = document.getElementsByClassName("tvgen");

  for (var i = 0; i < display.length; i++) {
    display[i].src = images.data[i].imgURL;
    names[i].innerText = images.data[i].title;
    rating[i].innerHTML = images.data[i].rating;
    genre[i].innerHTML = images.data[i].genres;

    display[i].onclick = (function(imageData) {
      return function() {
        showModal(imageData);
      };
    })(images.data[i]);
  }
}

function setMovies() {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);
  var images = [];

  req.onreadystatechange = function() {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            images = JSON.parse(req.responseText);
            processMovies(images);
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
    "action": "GetAllShows",
    "limit": 12,
    "return": "*",
    "filter": { "type": "Movie" }
  });
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);
}

function processMovies(images) {
  var display = document.getElementsByClassName("image");
  var names = document.getElementsByClassName("MOtitle");
  var rating = document.getElementsByClassName("MOrating");
  var genre = document.getElementsByClassName("movgen");

  for (var i = 0; i < display.length; i++) {
    display[i].src = images.data[i].imgURL;
    names[i].innerText = images.data[i].title;
    rating[i].innerHTML = images.data[i].rating;
    genre[i].innerHTML = images.data[i].genres;

    display[i].onclick = (function(imageData) {
      return function() {
        showModal(imageData);
      };
    })(images.data[i]);
  }
}

window.onload = function() {
  setCarousel();
  setTVShows();
  setMovies();
};