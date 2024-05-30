function update() {
  // Prevent default form submission behavior 
  event.preventDefault();

  // Gather form data and push to params if not null
  const params = {
    "action": "UpdateShow"
  };
  const title = document.getElementById("title").value;
  if (title) params.title = title;
  // Clear title field after reading value
  document.getElementById("title").value = "";

  const director = document.getElementById("director").value;
  if (director) params.director = director;
  // Clear director field after reading value
  document.getElementById("director").value = "";

  const rating = document.getElementById("rating").value;
  if (rating) params.rating = rating;
  // Clear rating field after reading value
  document.getElementById("rating").value = "";

  const description = document.getElementById("description").value;
  if (description) params.description = description;
  // Clear description field after reading value
  document.getElementById("description").value = "";

  const releaseDate = document.getElementById("release_date").value;
  if (releaseDate) params.release_date = releaseDate;
  // Clear releaseDate field after reading value
  document.getElementById("release_date").value = "";

  const studio = document.getElementById("studio").value;
  if (studio) params.studio = studio;
  // Clear studio field after reading value
  document.getElementById("studio").value = "";

  const genreType = document.getElementById("genre_type").value;
  if (genreType) params.genre_type = genreType;
  // Clear genreType field after reading value
  document.getElementById("genre_type").value = "";

  // Extract actor names from actor fields
  const actor = document.getElementById("actor").value;
  if (actor) params.actor_name = actor;  
  // Clear actor field after reading value (assuming single actor field)
  document.getElementById("actor").value = "";

  const review = document.getElementById("review").value;
  if (review) params.review = review;
  // Clear review field after reading value
  document.getElementById("review").value = "";
  
  updateShow(params);
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
  // Clear title field after reading value
  document.getElementById("titles").value = "";

  // Get the selected value from the type combobox
  const typeSelect = document.getElementById("types");
  const type = typeSelect ? typeSelect.value : "";
  if (type) params.type = type;
  // Clear type combobox selection after reading value
  if (typeSelect) {
    typeSelect.selectedIndex = 0; // Assuming the first item (index 0) is empty
  }

  const director = document.getElementById("directors").value;
  if (director) params.director = director;
  // Clear director field after reading value
  document.getElementById("directors").value = "";

  const rating = document.getElementById("ratings").value;
  if (rating) params.rating = rating;
  // Clear rating field after reading value
  document.getElementById("ratings").value = "";

  const description = document.getElementById("descriptions").value;
  if (description) params.description = description;
  // Clear description field after reading value
  document.getElementById("descriptions").value = "";

  const releaseDate = document.getElementById("release_dates").value;
  if (releaseDate) params.release_date = releaseDate;
  // Clear releaseDate field after reading value
  document.getElementById("release_dates").value = "";

  const studio = document.getElementById("studios").value;
  if (studio) params.studio = studio;
  // Clear studio field after reading value
  document.getElementById("studios").value = "";

  const genreType = document.getElementById("genre_types").value;
  if (genreType) params.genre_type = genreType;
  // Clear genreType field
  document.getElementById("genre_types").value = "";
  
  // Extract actor names from actor fields
  const actor = document.getElementById("addActor").value;
  if (actor) params.actor_names = actor;  
  // Clear actor field after reading value (assuming single actor field)
  document.getElementById("addActor").value = "";

  const review = document.getElementById("reviews").value;
  if (review) params.review = review;
  // Clear review field after reading value
  document.getElementById("reviews").value = "";
  
  const image = document.getElementById("image").value;
  if (image) params.imgURL = "/qLgkw20BhWnMiK6Dj12z8ObOXlU.jpg";
  // Clear review field after reading value
  document.getElementById("image").value = "";
  
  addShow(params);
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
  // Clear title field after reading value
  document.getElementById("stitle").value = "";

  const type = document.getElementById("stype").value;
  if (type) params.type = type;
  // Clear type field after reading value
  document.getElementById("stype").value = "";

  const director = document.getElementById("sdirector").value;
  if (director) params.director = director;
  // Clear director field after reading value
  document.getElementById("sdirector").value = "";
  
  deleteShow(params);
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
