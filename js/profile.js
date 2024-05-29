function setDetails(){
	const email = localStorage.getItem("username");
	const name = localStorage.getItem("Name");
	const phone = localStorage.getItem("phone");
	
	document.getElementById("email").innerHTML = email;
	document.getElementById("name").innerHTML = name;
	document.getElementById("phone").innerHTML = phone;
}

function getFavourites(){
	var req = new XMLHttpRequest();
	req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
	var images = [];
	
	req.onreadystatechange = function () {
    if (req.readyState == 4) {
        if (req.status == 200) {
            if (req.responseText) {
                try {
                    images = JSON.parse(req.responseText);
                    processFavourites(images);
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
  		"action":"GetFavourites",
  		"return":"*",
  		"customerID": localStorage.getItem("ID")
	});
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);// send request
}
window.onload = function(){
	setDetails();
}