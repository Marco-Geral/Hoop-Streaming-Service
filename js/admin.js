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
