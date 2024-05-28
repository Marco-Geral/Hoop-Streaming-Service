
//--------------------Functionality for arrow scroll-----------------//
const arrows = document.querySelectorAll(".arrow")
const moviesrow = document.querySelectorAll(".row_posters")

arrows.forEach((arrow, i)=>{
    const itemNumber = moviesrow[i].querySelectorAll("img").length;
    let clickCounter= 0;
    arrow.addEventListener("click",()=>{
        clickCounter++;
        if(itemNumber - (4+clickCounter) >= 0) {
            moviesrow[i].style.transform = `translateX(${
                moviesrow[i].computedStyleMap().get("transform")[0].x.value - 400}px)`;
        } else{
            moviesrow[i].style.transform = "translateX(0)";
            clickCounter = 0;
        }
    });
    console.log(moviesrow[i].querySelectorAll("img").length)
});

//-----------------Admin add movie button form-----------------//
/*document.getElementById('addMovieButton').addEventListener('click', function() {
    var form = document.getElementById('movieForm');
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
});*/
 //for the add movie button form, there is no functionality implemented. so the form wont do much, thats on yall tho, hmu if you get confused

 //---------------filter functionality---------------//
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.button-value');
    const rows = document.querySelectorAll('[data-genre]');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const genre = this.textContent.toLowerCase();
            rows.forEach(row => {
                if (row.dataset.genre!== genre) {
                    row.style.display = 'none';
                } else {
                    row.style.display = '';
                }
            });
        });
    });
});

function setOriginals (){// function to make request to api to display hoop originals
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
    if (req.readyState == 4) {
        if (req.status == 200) {
            if (req.responseText) {
                try {
                    images = JSON.parse(req.responseText);
                    processOriginals(images);
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
  		"limit":15,
  		"return":"*",
  		"filter": {"type":"Movie"}
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processOriginals(images) {
    // function to put data from api into original section
    var divs = document.getElementsByClassName("originals");
    if (divs.length === 0) return;  // check if there are no elements with the class "originals"
    
    var div = divs[0];  // get the first element in the collection
    div.innerHTML = '';
    
    for (var i = 0; i < images.data.length; i++) {
        var img = document.createElement("img");
        img.src = images.data[i].imgURL;
        img.classList.add("movie_poster");
        div.appendChild(img);
    }
}

function setRecommended (){// function to make request to api to display recommended movies
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
    if (req.readyState == 4) {
        if (req.status == 200) {
            if (req.responseText) {
                try {
                    images = JSON.parse(req.responseText);
                    processRecommended(images);
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
  		"limit":15,
  		"return":"*",
  		"filter":{
    		"rating": 5
  		}
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processRecommended(images) {
    // function to put data from api into recommended section
    var divs = document.getElementsByClassName("recommended");
    if (divs.length === 0) return;  // check if there are no elements with the class "recommended"
    
    var div = divs[0];  // get the first element in the collection
    div.innerHTML = '';
    
    for (var i = 0; i < images.data.length; i++) {
        var img = document.createElement("img");
        img.src = images.data[i].imgURL;
        img.classList.add("movie_poster");
        div.appendChild(img);
    }
}

function setRated (){// function to make request to api to display top rated movies
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
    if (req.readyState == 4) {
        if (req.status == 200) {
            if (req.responseText) {
                try {
                    images = JSON.parse(req.responseText);
                    processRated(images);
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
  		"limit":15,
  		"return":"*",
  		"filter":{
    		"rating": 5
  		}
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processRated(images) {
    // function to put data from api into topRated section
    var divs = document.getElementsByClassName("topRated");
    if (divs.length === 0) return;  // check if there are no elements with the class "rated"
    
    var div = divs[0];  // get the first element in the collection
    div.innerHTML = '';
    
    for (var i = 0; i < images.data.length; i++) {
        var img = document.createElement("img");
        img.src = images.data[i].imgURL;
        img.classList.add("movie_poster");
        div.appendChild(img);
    }
}

function setAction (){// function to make request to api to display action movies
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
    if (req.readyState == 4) {
        if (req.status == 200) {
            if (req.responseText) {
                try {
                    images = JSON.parse(req.responseText);
                    processAction(images);
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
  		"limit":15,
  		"return":"*",
  		"filter":{
    		"genre_type": "Action",
    		"type": "Movie"
  		}
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processAction(images) {
    // function to put data from api into action section
    var divs = document.getElementsByClassName("action");
    if (divs.length === 0) return;  // check if there are no elements with the class "action"
    
    var div = divs[0];  // get the first element in the collection
    div.innerHTML = '';
    
    for (var i = 0; i < images.data.length; i++) {
        var img = document.createElement("img");
        img.src = images.data[i].imgURL;
        img.classList.add("movie_poster");
        div.appendChild(img);
    }
}

function setComedy (){// function to make request to api to display comedy movies
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
    if (req.readyState == 4) {
        if (req.status == 200) {
            if (req.responseText) {
                try {
                    images = JSON.parse(req.responseText);
                    processComedy(images);
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
  		"limit":15,
  		"return":"*",
  		"filter":{
    		"genre_type": "Comedy",
    		"type": "Movie"
  		}
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processComedy(images) {
    // function to put data from api into comedy section
    var divs = document.getElementsByClassName("comedy");
    if (divs.length === 0) return;  // check if there are no elements with the class "comedy"
    
    var div = divs[0];  // get the first element in the collection
    div.innerHTML = '';
    
    for (var i = 0; i < images.data.length; i++) {
        var img = document.createElement("img");
        img.src = images.data[i].imgURL;
        img.classList.add("movie_poster");
        div.appendChild(img);
    }
}

function setRomance (){// function to make request to api to display romance movies
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
    if (req.readyState == 4) {
        if (req.status == 200) {
            if (req.responseText) {
                try {
                    images = JSON.parse(req.responseText);
                    processRomance(images);
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
  		"limit":15,
  		"return":"*",
  		"filter":{
    		"genre_type": "Romance",
    		"type": "Movie"
  		}
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processRomance(images) {
    // function to put data from api into romance section
    var divs = document.getElementsByClassName("romance");
    if (divs.length === 0) return;  // check if there are no elements with the class "romance"
    
    var div = divs[0];  // get the first element in the collection
    div.innerHTML = '';
    
    for (var i = 0; i < images.data.length; i++) {
        var img = document.createElement("img");
        img.src = images.data[i].imgURL;
        img.classList.add("movie_poster");
        div.appendChild(img);
    }
}

function setSciFi (){// function to make request to api to display sci-fi movies
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
    if (req.readyState == 4) {
        if (req.status == 200) {
            if (req.responseText) {
                try {
                    images = JSON.parse(req.responseText);
                    processSciFi(images);
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
  		"limit":15,
  		"return":"*",
  		"filter":{
    		"genre_type": "Science Fiction",
    		"type": "Movie"
  		}
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processSciFi(images) {
    // function to put data from api into sci-fi section
    var divs = document.getElementsByClassName("scifi");
    if (divs.length === 0) return;  // check if there are no elements with the class "scifi"
    
    var div = divs[0];  // get the first element in the collection
    div.innerHTML = '';
    
    for (var i = 0; i < images.data.length; i++) {
        var img = document.createElement("img");
        img.src = images.data[i].imgURL;
        img.classList.add("movie_poster");
        div.appendChild(img);
    }
}

function setHorror (){// function to make request to api to display horror movies
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
    if (req.readyState == 4) {
        if (req.status == 200) {
            if (req.responseText) {
                try {
                    images = JSON.parse(req.responseText);
                    processHorror(images);
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
  		"limit":15,
  		"return":"*",
  		"filter":{
    		"genre_type": "Horror",
    		"type": "Movie"
  		}
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}

function processHorror(images) {
    // function to put data from api into action section
    var divs = document.getElementsByClassName("horror");
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


window.onload = function () {
	setOriginals();
	setRecommended();
	setRated();
	setAction();
	setComedy();
	setRomance();
	setSciFi();
	setHorror();
}