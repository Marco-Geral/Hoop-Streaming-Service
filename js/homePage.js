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

window.onload = function() {
    setCarousel();
};
