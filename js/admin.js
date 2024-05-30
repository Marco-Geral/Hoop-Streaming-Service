function update() {
  // Prevent default form submission behavior 
  event.preventDefault();

  // Gather form data and push to params if not null
  const params = {
    "action": "UpdateShow"
  };
  const title = document.getElementById("title").value;
  if (title) params.title = title;

  const director = document.getElementById("director").value;
  if (director) params.director = director;

  const rating = document.getElementById("rating").value;
  if (rating) params.rating = rating;

  const description = document.getElementById("description").value;
  if (description) params.description = description;

  const releaseDate = document.getElementById("release_date").value;
  if (releaseDate) params.release_date = releaseDate;

  const studio = document.getElementById("studio").value;
  if (studio) params.studio = studio;

  const genreType = document.getElementById("genre_type").value;
  if (genreType) params.genre_type = genreType;

  // Extract actor names from actor fields
  const actor = document.getElementById("actor").value;
  if (actor) params.actor_name = actor;  
  
  const review = document.getElementById("review").value;
  if (review) params.review = review;
  
  updateShow(params);
}

function updateShow(params) {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
  var images = [];

  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            alert("Content updated.")
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

  var load = JSON.stringify(params);
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);// send request
}

function add() {
  // Prevent default form submission behavior (optional, if not submitting)
  event.preventDefault();

  // Gather form data and push to params if not null
  const params = {
    "action": "AddShow"
  };
  const title = document.getElementById("titles").value;
  if (title) params.title = title;

  // Get the selected value from the type combobox
  const typeSelect = document.getElementById("types");
  const type = typeSelect ? typeSelect.value : "";
  if (type) params.type = type;

  const director = document.getElementById("directors").value;
  if (director) params.director = director;

  const rating = document.getElementById("ratings").value;
  if (rating) params.rating = rating;

  const description = document.getElementById("descriptions").value;
  if (description) params.description = description;

  const releaseDate = document.getElementById("release_dates").value;
  if (releaseDate) params.release_date = releaseDate;

  const studio = document.getElementById("studios").value;
  if (studio) params.studio = studio;

  const genreType = document.getElementById("genre_types").value;
  if (genreType) params.genre_type = genreType;

  // Get the actor name from the element with the ID set in the HTML
   const actors = [];
  const actorFields = document.getElementsByName("actor[]");
  for (const field of actorFields) {
    const actorName = field.value;
    if (actorName) actors.push(actorName);  // Push only if not null
  }
  if (actors.length > 0) params.actors = actors;

  const review = document.getElementById("reviews").value;
  if (review) params.review = review;

  // Handle file input (assuming server-side script can handle it)
  const imageInput = document.getElementById("image");
  if (imageInput.files && imageInput.files[0]) {
    params.image = imageInput.files[0].name;  // Just including filename for demo
  }
  
  addShow(params);
}



function addShow(params) {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
  var images = [];

  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            alert("Content added.");
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

  var load = JSON.stringify(params);
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);// send request
}

function deleter() {
  // Prevent default form submission behavior (optional, if not submitting)
  event.preventDefault();

  // Gather form data and push to params if not null
  const params = {
    "action": "DeleteShow"
  };
  const title = document.getElementById("stitle").value;
  if (title) params.title = title;

  const type = document.getElementById("stype").value;
  if (type) params.type = type;

  const director = document.getElementById("sdirector").value;
  if (director) params.director = director;
  
  deleteShow(params);
}

function deleteShow(params) {
  var req = new XMLHttpRequest();
  req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//make the api request
  var images = [];

  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      if (req.status == 200) {
        if (req.responseText) {
          try {
            alert("Content deleted.");
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

  var load = JSON.stringify(params);
  var basicAuth = btoa("u23584565:2023Tukkies2023");
  req.setRequestHeader("Authorization", "Basic " + basicAuth);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(load);// send request
}
