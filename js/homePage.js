function setCarousel (){
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);
	var images = [];
	
	req.onreadystatechange = function () {
        if (req.readyState == 4 ){
		 if(req.status == 200) {
            images = JSON.parse(req.responseText);
            processImages(images);
        }
        } else {
            console.error("Error fetching data");
        }
    };
    var load = JSON.stringify({
  		"action":"GetAllShows",
  		"limit":100,
  		"return":"*"
	});
    req.send(load);
}

function processImages () {
	
}

function fetchListings() {
	const loaded = document.getElementById("load");
    var req = new XMLHttpRequest();
    req.open("POST", "https://wheatley.cs.up.ac.za/api/", true);//asynchronous so that user can view listings while others are still being rendered.
    var listings = [];
    req.onreadystatechange = function () {
        if (req.readyState == 4 ){
		loaded.style.display = "none";
		 if(req.status == 200) {
            listings = JSON.parse(req.responseText);
            processListings(listings, loaded);
        }
        } else {
            console.error("Error fetching data");
        }
    };
    var load = JSON.stringify({
        "studentnum": "u23533693",
        "type": "GetAllListings",
        "limit": 100,
        "apikey": "26b26b692f4b9e415a1e35a02b374944",
        "return": ["id","title","price","location","bedrooms","bathrooms", "type", "amenities", "description"]
    });
	loaded.style.display = "block";
    req.send(load);
}
document.addEventListener("DOMContentLoaded", function(){
	
});