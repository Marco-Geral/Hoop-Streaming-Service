
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
	show();
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
        img.dataset.contentID = images.data[i].id;
        img.classList.add("movie_poster");
        img.onclick = function() {
          showModal(this.dataset.contentID); // Pass the content ID to the show function
        };
        div.appendChild(img);
    }
}

function setRecommended (){// function to make request to api to display recommended movies
	show();
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
    		"rating": 5,
    		"type": "Movie"
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
        img.dataset.contentID = images.data[i].id;
        img.src = images.data[i].imgURL;
        img.classList.add("movie_poster");
        img.onclick = function() {
          showModal(this.dataset.contentID); // Pass the content ID to the show function
        };
        div.appendChild(img);
    }
}

function setRated (){// function to make request to api to display top rated movies
	show();
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
    		"rating": 5,
    		"type": "Movie"
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
        img.dataset.contentID = images.data[i].id;
        img.classList.add("movie_poster");
        img.onclick = function() {
          showModal(this.dataset.contentID); // Pass the content ID to the show function
        };
        div.appendChild(img);
    }
}

function setAction (){// function to make request to api to display action movies
	show();
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
        img.dataset.contentID = images.data[i].id;
        img.classList.add("movie_poster");
        img.onclick = function() {
          showModal(this.dataset.contentID); // Pass the content ID to the show function
        };
        div.appendChild(img);
    }
}

function setComedy (){// function to make request to api to display comedy movies
	show();
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
        img.dataset.contentID = images.data[i].id;
        img.classList.add("movie_poster");
        img.onclick = function() {
          showModal(this.dataset.contentID); // Pass the content ID to the show function
        };
        div.appendChild(img);
    }
}

function setRomance (){// function to make request to api to display romance movies
	show();
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
    div.style.display = 'flex';
    div.innerHTML = '';
    
    for (var i = 0; i < images.data.length; i++) {
        var img = document.createElement("img");
        img.src = images.data[i].imgURL;
        img.dataset.contentID = images.data[i].id;
        img.classList.add("movie_poster");
        img.onclick = function() {
          showModal(this.dataset.contentID); // Pass the content ID to the show function
        };
        div.appendChild(img);
    }
}

function setSciFi (){// function to make request to api to display sci-fi movies
	show();
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
        img.dataset.contentID = images.data[i].id;
        img.classList.add("movie_poster");
        img.onclick = function() {
          showModal(this.dataset.contentID); // Pass the content ID to the show function
        };
        div.appendChild(img);
    }
}

function setHorror (){// function to make request to api to display horror movies
	show();
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
    div.style.display = "flex";
    div.innerHTML = '';
    
    for (var i = 0; i < images.data.length; i++) {
        var img = document.createElement("img");
        img.src = images.data[i].imgURL;
        img.dataset.contentID = images.data[i].id;
        img.classList.add("movie_poster");
        img.onclick = function() {
          showModal(this.dataset.contentID); // Pass the content ID to the show function
        };
        div.appendChild(img);
    }
}

function show(){
	var hide = document.getElementsByClassName("row_title");
	for(var i = 0; i < hide.length; i++)
		hide[i].style.display ='block';
		
	document.getElementsByClassName("recommended")[0].style.display = 'flex';
	document.getElementsByClassName("topRated")[0].style.display = 'flex';
	document.getElementsByClassName("action")[0].style.display = 'flex';
	document.getElementsByClassName("comedy")[0].style.display = 'flex';
	document.getElementsByClassName("romance")[0].style.display = 'flex';
	document.getElementsByClassName("scifi")[0].style.display = 'flex';
	document.getElementsByClassName("horror")[0].style.display ='flex';
}
var actions = false;
var comedy = false;

function getAction() {
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
    if (req.readyState == 4) {
        if (req.status == 200) {
            if (req.responseText) {
                try {
                    images = JSON.parse(req.responseText);
                    actionFilter(images);
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

function actionFilter (images) {
	actions = !actions;
	
	if(actions){
		
	
	var divs = document.getElementsByClassName("originals");
	document.getElementsByClassName("recommended")[0].style.display = 'none';
	document.getElementsByClassName("topRated")[0].style.display = 'none';
	document.getElementsByClassName("action")[0].style.display = 'none';
	document.getElementsByClassName("comedy")[0].style.display = 'none';
	document.getElementsByClassName("romance")[0].style.display = 'none';
	document.getElementsByClassName("scifi")[0].style.display = 'none';
	document.getElementsByClassName("horror")[0].style.display ='none';
	
	var hide = document.getElementsByClassName("row_title");
	for(var i = 0; i < hide.length; i++)
		hide[i].style.display ='none';
	
    if (divs.length === 0) return;  // check if there are no elements with the class "horror"
    
    var div = divs[0];  // get the first element in the collection
    div.innerHTML = '';
    
    for (var i = 0; i < images.data.length; i++) {
        var img = document.createElement("img");
        img.src = images.data[i].imgURL;
        img.dataset.contentID = images.data[i].id;
        img.classList.add("movie_poster");
        div.appendChild(img);
    }
    } else {
        setOriginals();
        setRecommended();
        setRated();
        setAction();
        setComedy();
        setRomance();
        setSciFi();
        setHorror();
	}
}

function getComedy() {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
  var images = [];

  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            images = JSON.parse(req.responseText);
            comedyFilter(images);
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
    "limit": 15,
    "return": "*",
    "filter": {
      "genre_type": "Comedy",
      "type": "Movie"
    }
  });
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);// send request
}

function comedyFilter(images) {
  comedy = !comedy;

  if (comedy) {
	var divs = document.getElementsByClassName("originals");
	document.getElementsByClassName("recommended")[0].style.display = 'none';
	document.getElementsByClassName("topRated")[0].style.display = 'none';
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
      img.dataset.contentID = images.data[i].id;
      img.classList.add("movie_poster");
      div.appendChild(img);
    }
  } else {
	setAction();
    setOriginals();
    setRecommended();
    setRated();
    setComedy(); 
    setRomance();
    setSciFi();
    setHorror();
  }
}

function getRomance() {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
  var images = [];

  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            images = JSON.parse(req.responseText);
            romanceFilter(images);
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
    "limit": 15,
    "return": "*",
    "filter": {
      "genre_type": "Romance",
      "type": "Movie"
    }
  });
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);// send request
}
var romances = false;
function romanceFilter(images) {
 	romances = !romances;

  if (romances) {
	var divs = document.getElementsByClassName("originals");
	document.getElementsByClassName("recommended")[0].style.display = 'none';
	document.getElementsByClassName("topRated")[0].style.display = 'none';
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
      img.dataset.contentID = images.data[i].id;
      img.classList.add("movie_poster");
      div.appendChild(img);
    }
  } else {
	setOriginals();
	setRecommended();
	setRated();
	setAction();
	setComedy();
	setRomance();
	setSciFi();
	setHorror();
  }
}

function getSciFi() {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
  var images = [];

  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            images = JSON.parse(req.responseText);
            scifiFilter(images);
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
    "limit": 15,
    "return": "*",
    "filter": {
      "genre_type": "Science Fiction",
      "type": "Movie"
    }
  });
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);// send request
}

var scifi = false;
function scifiFilter(images) {
  scifi = !scifi;

  if (scifi) {
	var divs = document.getElementsByClassName("originals");
	document.getElementsByClassName("recommended")[0].style.display = 'none';
	document.getElementsByClassName("topRated")[0].style.display = 'none';
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
        img.dataset.contentID = images.data[i].id;
      img.classList.add("movie_poster");
      div.appendChild(img);
    }
  } else {
	setOriginals();
	setRecommended();
	setRated();
	setAction();
	setComedy();
	setRomance();
	setSciFi();
	setHorror();
  }
}

document.addEventListener("DOMContentLoaded", function() {
    // Convert HTMLCollection to an array for movie posters
    var moviePosters = Array.from(document.getElementsByClassName('movie_poster'));

    // Add click event listener to each movie poster
    moviePosters.forEach(function(moviePoster) {
        moviePoster.addEventListener('click', function() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('movie-info').style.display = 'block';
        });
    });

    // Get all elements with class 'close' and convert to array
    var closeButtons = Array.from(document.getElementsByClassName('close'));

    // Add click event listener to each close button
    closeButtons.forEach(function(closeButton) {
        closeButton.addEventListener('click', function() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('movie-info').style.display = 'none';
        });
    });

    // Add click event listener to overlay to close it
    document.getElementById('overlay').addEventListener('click', function() {
        document.getElementById('overlay').style.display = 'none';
        document.getElementById('movie-info').style.display = 'none';
    });
});


function search() {
  searched = document.getElementById("searchInput").value;
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
  var images = [];

  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            images = JSON.parse(req.responseText);
            processSearch(images);
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
    "limit": 15,
    "return": "*",
    "search":{
    "title": searched
  	},
  	"filter": {
      "type": "Movie"
    },
  	"sort":"title"
  });
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);// send request
}

function processSearch(images) {
	
	var divs = document.getElementsByClassName("originals");
	document.getElementsByClassName("recommended")[0].style.display = 'none';
	document.getElementsByClassName("topRated")[0].style.display = 'none';
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
        img.dataset.contentID = images.data[i].id;
      img.classList.add("movie_poster");
      div.appendChild(img);
    }
 } 

function getHorror() {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
  var images = [];

  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            images = JSON.parse(req.responseText);
            horrorFilter(images);
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
    "limit": 15,
    "return": "*",
    "filter": {
      "genre_type": "Horror",
      "type": "Movie"
    }
  });
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);// send request
}

var horror = false;
function horrorFilter(images) {
  horror = !horror;

  if (horror) {
	var divs = document.getElementsByClassName("originals");
	document.getElementsByClassName("recommended")[0].style.display = 'none';
	document.getElementsByClassName("topRated")[0].style.display = 'none';
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
        img.dataset.contentID = images.data[i].id;
      img.classList.add("movie_poster");
      div.appendChild(img);
    }
  } else {
    setOriginals();
	setRecommended();
	setRated();
	setAction();
	setComedy();
	setRomance();
	setSciFi();
	setHorror();
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

/*---------View Page-----------*/


function showModal(contentID) {
  // Check if the modal exists before showing it
  var modal = document.getElementById('viewMovieModal');
  if (!modal) return;

  // Populate the modal with dummy data based on contentID
  document.getElementById('viewMovieTitle').textContent = 'Title Placeholder'; // Ensure this ID exists
  document.getElementById('viewMovieDescription').textContent = 'Description Placeholder'; // Ensure this ID exists
  document.getElementById('viewMovieRating').textContent = 'Rating: 5'; // Ensure this ID exists
  document.getElementById('viewMovieDate').textContent = 'Release Date: 2024-05-29'; // Ensure this ID exists
  document.getElementById('viewMovieActors').innerHTML = '<ul><li>Actor 1</li><li>Actor 2</li></ul>'; // Ensure this ID exists
  document.getElementById('viewMoviePoster').src = ''; // Set the poster image URL here

  // Show the modal
  modal.style.display = 'block';
}

// Function to close the modal
document.getElementById('closeViewMovie').onclick = function() {
  document.getElementById('viewMovieModal').style.display = 'none';
}

