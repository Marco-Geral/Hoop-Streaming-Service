<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <script type="text/javascript" src="js/admin.js"></script>
</head>
<body>


    <div class="title"> 
        <h1>Admin Panel</h1>
    </div>
    <div class="forms-container">
        <form action="/update-show" method="post" class="form">
            <h2>Update</h2>

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <br>
            <label for="director">Director:</label>
            <input type="text" id="director" name="director">

            <br>
            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" min="1" max="5">

            <br>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description">

            <br>
            <label for="release_date">Release Date:</label>
            <input type="date" id="release_date" name="release_date">

            <br>
            <label for="studio">Studio:</label>
            <input type="text" id="studio" name="studio">

            <br>
            <label for="genre_type">Genre:</label>
            <input type="text" id="genre_type" name="genre_type">

            <br>
            <div id="actors-container">
                <div class="actor-field">
                    <input id="actor" type="text" placeholder="Actor Name" name="actors[]">
                </div>
            </div>
            <button type="button" onclick="addActorField()">Add Actor</button>

            <br>
            <label for="review">Review:</label>
            <input type="text" id="review" name="review">

            <button type="submit" class="form-submit-button" onclick="update()">Update</button>
        </form>

        <form action="/add-show" method="post" class="form">
            <h2>Add</h2>
            <label for="title">Title:</label>
            <input type="text" id="titles" name="title" required>

            <br>
            <label for="type">Type:</label>
            <select id="types" name="type" required>
                <option value="movie">Movie</option>
                <option value="show">TV Show</option>
            </select>

            <br>
            <label for="director">Director:</label>
            <input type="text" id="directors" name="director"  required>

            <br>
            <label for="rating">Rating:</label>
            <input type="number" id="ratings" name="rating" min="1" max="5"  required>

            <br>
            <label for="description">Description:</label>
            <input type="text" id="descriptions" name="description"  required>

            <br>
            <label for="release_date">Release Date:</label>
            <input type="date" id="release_dates" name="release_date" required>

            <br>
            <label for="studio">Studio:</label>
            <input type="text" id="studios" name="studio" required>

            <br>
            <label for="genre_type">Genre:</label>
            <input type="text" id="genre_types" name="genre_type" required>

            <br>
            <div id="actors-container">
                <div class="actor-field">
                    <input type="text" class="input" placeholder="Actor Name" name="actor[]" id="addActor" required>
                </div>
            </div>
            <button type="button" onclick="addActorField()">Add Actor</button>

            <br>
            <label for="review">Review:</label>
            <input type="text" id="reviews" name="reviews" required>
            
            <br>
            <input type="file" id="image" accept = image/*>

			<br>
            <button type="submit" class="form-submit-button" onclick="add()">Add</button>
        </form>

        <form action="/delete-show" method="post" class="form">
            <h2>Delete</h2>
            <label for="stitle">Title:</label>
            <input type="text" id="stitle" name="title" required>

            <br>
            <label for="type">Type:</label>
            <select id="stype" name="type" required>
                <option value="movie">Movie</option>
                <option value="show">TV Show</option>
            </select>

            <br>
            <label for="sdirector">Director:</label>
            <input type="text" id="sdirector" name="director" required>
            <button type="submit" class="form-submit-button" onclick="deleter()">Delete</button>
        </form>

    </div>


<script>
function addActorField() {
    // Create a new div element for each actor
    var newDiv = document.createElement('div');
    newDiv.className = 'actor-field';
    
    // Create a new input element
    var newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.placeholder = 'Actor Name';
    newInput.name = 'actors[]';
    newInput.required = true;
    
    // Append the new input to the new div
    newDiv.appendChild(newInput);
    
    // Get the existing actors container
    var actorsContainer = document.getElementById('actors-container');
    
    // Append the new div to the actors container
    actorsContainer.appendChild(newDiv);
}
</script>

</body>
</html>
