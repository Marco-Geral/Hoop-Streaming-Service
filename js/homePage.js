function setCarousel (){// function to make request to api to change image carousel
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
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
  		"action":"GetAllShows",
  		"limit":3,
  		"return":"*"
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processCarousel(images) {//function to put data from api into image carousel
	var display = document.getElementsByClassName("d-block w-100");
	var names = document.getElementsByClassName("title");
	var descriptions = document.getElementsByClassName("des");
	var rating = document.getElementsByClassName("rating");
	var year = document.getElementsByClassName("year");
	
	for(var i = 0; i < display.length; i++) {
   		display[i].src = images.data[i].imgURL;
   		names[i].innerText = images.data[i].title; 
   		descriptions[i].innerText = images.data[i].description; 
   		rating[i].innerHTML = images.data[i].rating;
   		year[i].innerHTML = images.data[i].release_date;
	}

}

function setTVShows (){// function to make request to api to change tv shows
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
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
  		"action":"GetAllShows",
  		"limit":12,
  		"return":"*",
  		"filter": {"type":"Show"}
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processShows(images) {//function to put data from api into tv shows
	var display = document.getElementsByClassName("images");
	var names = document.getElementsByClassName("TVtitle");
	var rating = document.getElementsByClassName("TVrating");
	
	for(var i = 0; i < display.length; i++) {
   		display[i].src = images.data[i].imgURL;
   		names[i].innerText = images.data[i].title; 
   		rating[i].innerHTML = images.data[i].rating;
	}

}

function setMovies (){// function to make request to api to change tv shows
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
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
  		"action":"GetAllShows",
  		"limit":12,
  		"return":"*","filter": {"type":"Movie"}
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processMovies(images) {//function to put data from api into tv shows
	var display = document.getElementsByClassName("image");
	var names = document.getElementsByClassName("MOtitle");
	var rating = document.getElementsByClassName("MOrating");
	
	for(var i = 0; i < display.length; i++) {
   		display[i].src = images.data[i].imgURL;
   		names[i].innerText = images.data[i].title; 
   		rating[i].innerHTML = images.data[i].rating;
	}

}

function processSearch(images) {
	
	var divs = document.getElementsByClassName("topRated");
	document.getElementsByClassName("action")[0].style.display = 'none';
	document.getElementsByClassName("comedy")[0].style.display = 'none';
	document.getElementsByClassName("romance")[0].style.display = 'none';
	document.getElementsByClassName("scifi")[0].style.display = 'none';
	document.getElementsByClassName("horror")[0].style.display ='none';

    var hide = document.getElementsByClassName("row_title");
    for (var i = 0; i < hide.length; i++)
      hide[i].style.display = 'none';

    if (divs.length === 0) return;  // check if there are no elements with the class "horror"

    var div = divs[0];  // get the first element in the collection
    div.innerHTML = '';

    for (var i = 0; i < images.data.length; i++) {
      var img = document.createElement("img");
      img.src = images.data[i].imgURL;
      img.classList.add("movie_poster");
      div.appendChild(img);
    }
 } 
window.onload = function() {
    setCarousel();
    setTVShows();
    setMovies();
};
