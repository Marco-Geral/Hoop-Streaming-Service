<?php

class Database
{
    private static $instance = null;
    private $host = 'wheatley.cs.up.ac.za';
    private $db_name = 'u23533693_hoop';
    private $db_password = '2FBI3TIZRLEGOFBROXV3X6C6FKAIDSDQ';
    private $student_num = 'u23533693';
    public $mysqli;
    
    public static function instance()
    {
        if(self::$instance == null)
        {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    private function __construct()
    {
        $this->mysqli = new mysqli($this->host, $this->student_num, $this->db_password, $this->db_name);
        // Check connection
        if ($this->mysqli->connect_error) 
        {
            header('Content-Type: application/json');
            die(json_encode(["Connection failed: " . $this->mysqli->connect_error]));
        }
        else
        {
            header('Content-Type: application/json');
        }
            
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function connectToDatabase()
    {
        return $this->mysqli;
    }
    
    public function __destruct() {
        if ($this->mysqli) {
            $this->mysqli->close();
        }
    }
    private function __clone() {}

    private function __wakeup() {}


    public function loadMovieData($data)
    {
        if(!$data || !isset($data))
        {
            http_response_code(400); // Bad Request
    		header('Content-Type: application/json');
    		die(json_encode((["status" => "error","message" => "Data not found"])));
        }

        $result = $this->insertMovieContent($data);
        $reviews = $result['reviews'];
        $contentID = $result['contetntID'];
        $actors = $result['actors'];
        $genres = $result['genres'];

        $this->insertReviews($contentID, $reviews);

        $actorsResponse = $this->insertActors($actors, $contentID);//call the insertAssociated with function in this function
        $genresResponse = $this->insertGenres($genres, $contentID);//call the insertAssociated with function in this function


        
 
        $timestamp = microtime(true) * 1000; 
        $response = [
                    "status" => "success",
                    "timestamp" => $timestamp,
                    "message" => "Movie data was successfully loaded"
        ];
        return json_encode($response);

}
public function loadShowData($data)//change functions to work for shows
{
    if(!$data || !isset($data))
    {
        http_response_code(400); // Bad Request
        header('Content-Type: application/json');
        die(json_encode((["status" => "error","message" => "Data not found"])));
    }

    $result = $this->insertShowContent($data);


    $reviews = $result['reviews'];
    $contentID = $result['contetntID'];
    $actors = $result['actors'];
    $genres = $result['genres'];

    $this->insertReviews($contentID, $reviews);

    $actorsResponse = $this->insertActors($actors, $contentID);//call the insertAssociated with function in this function
    $genresResponse = $this->insertGenres($genres, $contentID);//call the insertAssociated with function in this function


    

    $timestamp = microtime(true) * 1000; 
    $response = [
                "status" => "success",
                "timestamp" => $timestamp,
                "message" => "Show data was successfully loaded"
    ];
    return json_encode($response);
}

    private function insertMovieContent($data)//this works fine in theory
    {
        $contentID = $this->generateUniqueId();

        // Check if the ID already exists in the database
        while ($this->isIdExists($contentID, 'content', 'id')) {
            $contentID = $this->generateUniqueId();
        }

        $sql = "INSERT INTO content (id, type, title, director, rating, description, release_date, studio, imgUrl) VALUES (?,?,?,?,?,?,?,?,?)";
        //echo json_encode($data);

        // Prepare statement 
            $stmt = $this->mysqli->prepare($sql);
            if(!$stmt){
                header('Content-Type: application/json');
                //echo json_encode($data);
                die(json_encode(["status" => "error", "message" => "Prepare failed: " . htmlspecialchars($this->mysqli->error)]));
            };
        
        // Extracting relevant fields
            $title = isset($data['original_title']) ? $data['original_title'] : "Title not found"; 
            $description = isset($data['overview']) ? $data['overview'] : "Description not found";
            $DBrating = isset($data['popularity']) ? $data['popularity'] : 101; //if not set give it a value of 4
            //get relevant rating
            if($DBrating < 20)
            {
                $rating = 1;
            }
            else if($DBrating > 20 && $DBrating < 50)
            {
                $rating = 2;
            }
            else if($DBrating > 50 && $DBrating < 100)
            {
                $rating = 3;
            }
            else if($DBrating > 100 && $DBrating < 150)
            {
                $rating = 4;
            }
            else
            {
                $rating = 5;
            }
            $imgUrl = isset($data['poster_path']) ? $data['poster_path'] : "https://uploads.dailydot.com/2023/12/crying-cat-meme.jpg?q=65&auto=format&w=800&ar=2:1&fit=crop";
            $studio = isset($data['production_companies'][0]['name']) ? $data['production_companies'][0]['name'] : ""; // Finds first production company (studio)
            $release_date = isset($data['release_date']) ? $data['release_date'] : "1999-07-24";
        
        
        // Extracting the name of the director
        $director = "";
        if(isset($data['credits']) && isset($data['credits']['cast'])) {
            $directors = array_filter($data['credits']['cast'], function($v) {
                return $v['known_for_department'] === 'Directing';
            });
            $directorNames = array_column($directors, 'name');
            $director = implode(", ", $directorNames);
        }
        else
        {
            $director = "Martin Scorsese";
        }

        //extract 3 genres
        $genres = [];

        if (isset($data['genres']) && is_array($data['genres']) && !empty($data['genres'])) {
            // Loop through the genres array and get up to 3 genre names
            foreach ($data['genres'] as $genre) {
                $genres[] = $genre['name'];
                if (count($genres) == 3) {
                    break;
                }
            }
        } else {
            // Set default genres if 'genres' is not set or empty
            $genres = ['Action', 'Comedy', 'Adventure'];
        }
        
        
        // Extract 3 actors
        if(isset($data['credits']['cast'])) {
            $filteredCast = array_filter($data['credits']['cast'], function($castMember) {
                return $castMember['known_for_department'] === 'Acting';
            });
            // Use array_slice to get the first 3 actors
            $actors = array_map(function($castMember) {
                return $castMember['name'];
            }, array_slice($filteredCast, 0, 3));
        } 
        else{
            $actors = ['Martin Freeman', 'Jennifer Lawrence', 'Keanu Reeves']; // Initialize $actors as empty array if $data->credits->cast does not exist
        }

        //extract reviews
        $reviews = [];
        if (isset($data['reviews']['results']) && is_array($data['reviews']['results']) && !empty($data['reviews']['results'])) {
            // Loop through the results
            foreach ($data['reviews']['results'] as $result) {
                if (isset($result['content'])) {
                    $content = $result['content'];
                    // Trim the content if it's more than 250 characters
                    if (strlen($content) > 250) {
                        $content = substr($content, 0, 250);
                    }
                    // Add the trimmed or original content to the array
                    $reviews[] = $content;
                }
            }
        }
        // If reviews are not available or not in the expected format, provide default reviews
        // if (empty($reviews)) {
        //     $reviews[] = "This film offers an engaging story with compelling characters and stunning visuals. The direction is solid, and the performances are commendable. While it may not break new ground, it provides an enjoyable and entertaining experience for audiences of all ages.";
        //     $reviews[] = "Alright, so I just caught this movie, and let me tell you, it's a total blast! You've got action, drama, and some seriously funny moments. The cast really brings it, and the visuals are pretty darn impressive. It's not gonna blow your mind, but it's definitely a fun ride worth checking out for a good time.";
        // }

        //error checking before insertion:
            if (!isset($actors)) {
                $errorMessage = 'actors';
            } elseif (!isset($genres)) {
                $errorMessage = 'genres';
            } elseif (!isset($reviews)) {
                $errorMessage = 'reviews';
            } elseif (!isset($contentID)) {
                $errorMessage = 'contentID';
            }
            
            if (isset($errorMessage)) {
                // If any field value isn't set, return an error response with the missing field
                die(json_encode(["status" => "error", "message" => "Data missing: $errorMessage"]));
            }
        
        
        // Print the extracted data
        // echo "Genres: " . implode(', ', $genres) . "\n";
        // echo "Actors: " . implode(', ', $actors) . "\n";
        // echo "Reviews: " . implode(', ', $reviews) . "\n";

            $type = 'Movie';
            $stmt->bind_param("isssissss", $contentID, $type, $title, $director, $rating, $description, $release_date, $studio, $imgUrl);
            if (!$stmt->execute()) {
                echo "Error: ". $stmt->error;
                return false;
            }
            else
            {
                //must return the actors that need to be inserted as well as the genre and contetntID

                $response = [
                    'actors' =>$actors,
                    'genres' => $genres,
                    'reviews' => $reviews,
                    'contetntID' => $contentID
                ];
                return $response;
            }
    }

    private function insertShowContent($data)//this works fine in theory
    {
        $contentID = $this->generateUniqueId();

        // Check if the ID already exists in the database
        while ($this->isIdExists($contentID, 'content', 'id')) {
            $contentID = $this->generateUniqueId();
        }

        $sql = "INSERT INTO content (id, type, title, director, rating, description, release_date, studio, imgUrl) VALUES (?,?,?,?,?,?,?,?,?)";
        //echo json_encode($data);

        // Prepare statement 
            $stmt = $this->mysqli->prepare($sql);
            if(!$stmt){
                header('Content-Type: application/json');
                //echo json_encode($data);
                die(json_encode(["status" => "error", "message" => "Prepare failed: " . htmlspecialchars($this->mysqli->error)]));
            };
        
        // Extracting relevant fields
            $title = isset($data['name']) ? $data['name'] : "Title not found"; 
            $description = isset($data['overview']) ? $data['overview'] : "Description not found";
            $DBrating = isset($data['popularity']) ? $data['popularity'] : 101; //if not set give it a value of 4
            //get relevant rating
            if($DBrating < 20)
            {
                $rating = 1;
            }
            else if($DBrating > 20 && $DBrating < 50)
            {
                $rating = 2;
            }
            else if($DBrating > 50 && $DBrating < 100)
            {
                $rating = 3;
            }
            else if($DBrating > 100 && $DBrating < 150)
            {
                $rating = 4;
            }
            else
            {
                $rating = 5;
            }
            $imgUrl = isset($data['poster_path']) ? $data['poster_path'] : "https://uploads.dailydot.com/2023/12/crying-cat-meme.jpg?q=65&auto=format&w=800&ar=2:1&fit=crop";
            $studio = isset($data['production_companies'][0]['name']) ? $data['production_companies'][0]['name'] : ""; // Finds first production company (studio)
            $release_date = isset($data['first_air_date']) ? $data['first_air_date'] : "1999-07-24";
            $director = isset($data['created_by'][0]['original_name']) ? $data['created_by'][0]['original_name'] : "Martin Scorsese";
        

        //extract 3 genres
        $genres = [];

        if (isset($data['genres']) && is_array($data['genres']) && !empty($data['genres'])) {
            // Loop through the genres array and get up to 3 genre names
            foreach ($data['genres'] as $genre) {
                $genres[] = $genre['name'];
                if (count($genres) == 3) {
                    break;
                }
            }
        } else {
            // Set default genres if 'genres' is not set or empty
            $genres = ['Action', 'Comedy', 'Adventure'];
        }
        
        
        // Extract 3 actors
        if(isset($data['credits']['cast'])) {
            $filteredCast = array_filter($data['credits']['cast'], function($castMember) {
                return $castMember['known_for_department'] === 'Acting';
            });
            // Use array_slice to get the first 3 actors
            $actors = array_map(function($castMember) {
                return $castMember['name'];
            }, array_slice($filteredCast, 0, 3));
        } 
        else{
            $actors = ['Martin Freeman', 'Jennifer Lawrence', 'Keanu Reeves']; // Initialize $actors as empty array if $data->credits->cast does not exist
        }

        //extract reviews
        $reviews = [];

        if (isset($data['reviews']['results']) && is_array($data['reviews']['results']) && !empty($data['reviews']['results'])) {
            // Loop through the results
            foreach ($data['reviews']['results'] as $result) {
                if (isset($result['content'])) {
                    $content = $result['content'];
                    // Trim the content if it's more than 250 characters
                    if (strlen($content) > 250) {
                        $content = substr($content, 0, 250);
                    }
                    // Add the trimmed or original content to the array
                    $reviews[] = $content;
                }
            }
        }
        
        // If reviews are not available or not in the expected format, provide default reviews
        // if (empty($reviews)) {
        //     $reviews[] = "This film offers an engaging story with compelling characters and stunning visuals. The direction is solid, and the performances are commendable. While it may not break new ground, it provides an enjoyable and entertaining experience for audiences of all ages.";
        //     $reviews[] = "Alright, so I just caught this movie, and let me tell you, it's a total blast! You've got action, drama, and some seriously funny moments. The cast really brings it, and the visuals are pretty darn impressive. It's not gonna blow your mind, but it's definitely a fun ride worth checking out for a good time.";
        // }
        

        //error checking before insertion:
            if (!isset($actors)) {
                $errorMessage = 'actors';
            } elseif (!isset($genres)) {
                $errorMessage = 'genres';
            } elseif (!isset($reviews)) {
                $errorMessage = 'reviews';
            } elseif (!isset($contentID)) {
                $errorMessage = 'contentID';
            }
            
            if (isset($errorMessage)) {
                // If any field value isn't set, return an error response with the missing field
                die(json_encode(["status" => "error", "message" => "Data missing: $errorMessage"]));
            }
        
        
        // Print the extracted data
        //echo "Genres: " . implode(', ', $genres) . "\n";
        //echo "Actors: " . implode(', ', $actors) . "\n";

            $type = 'Show';
            $stmt->bind_param("isssissss", $contentID, $type, $title, $director, $rating, $description, $release_date, $studio, $imgUrl);
            if (!$stmt->execute()) {
                echo "Error: ". $stmt->error;
                return false;
            }
            else
            {
                //must return the actors that need to be inserted as well as the genre and contetntID

                $response = [
                    'actors' =>$actors,
                    'genres' => $genres,
                    'reviews' => $reviews,
                    'contetntID' => $contentID
                ];
                return $response;
            }
    }


    private function insertReviews($contentID, $reviews)
    {
        // Prepare the insert statement
        $stmt = $this->mysqli->prepare("INSERT INTO reviews (contentID, review) VALUES (?, ?)");
        if (!$stmt) {
            return "Error: Failed to prepare statement: " . $this->mysqli->error;
        }
    
        // Check for errors in binding parameters
        $stmt->bind_param("is", $contentID, $review);
        if ($stmt->errno) {
            return "Error: Failed to bind parameters: " . $stmt->error;
        }
    
        // If $reviews is not an array, convert it to an array
        if (!is_array($reviews)) {
            $reviews = [$reviews];
        }
    
        // Insert each review
        foreach ($reviews as $review) {
            // Execute the statement for each review
            $result = $stmt->execute();
    
            // Check for errors in executing the statement
            if (!$result) {
                return "Error: Failed to execute statement: " . $stmt->error;
            }
        }
    
        // Close the prepared statement
        $stmt->close();
    
        // Return success message
        return "Reviews inserted successfully.";
    }
    

private function insertGenres($genres, $contentID)
{

    if (!is_array($genres)) {
        $genres = [$genres];
    }

    $stmt = $this->mysqli->prepare("INSERT INTO genre (genre_type) VALUES (?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        return "Error: Failed to prepare statement: " . $this->mysqli->error;
    }

    // Bind parameter
    $stmt->bind_param("s", $genre_type);

    // Check for errors in binding parameters
    if ($stmt->errno) {
        return "Error: Failed to bind parameters: " . $stmt->error;
    }

    // Insert each genre and retrieve the genreID
    foreach ($genres as $genre) {
        $genre_type = $genre;

        // Execute the statement to insert the genre
        $result = $stmt->execute();

        // Check for errors in executing the statement
        if (!$result) {
            return "Error: Failed to execute statement: " . $stmt->error;
        }

        // Retrieve the auto-generated ID for the inserted genre
        $genreID = $stmt->insert_id;

        // Call the function to insert into genreAssociatedWith table
        $result = $this->insertGenreAssociatedWith($genreID, $contentID);

        // Check for errors in inserting into genreAssociatedWith table
        if ($result !== true) {
            return $result; // Return the error message
        }
    }

    // Close the statement
    $stmt->close();
}

private function insertActors($actors, $contentID)
{

    if (!is_array($actors)) {
        $actors = [$actors];
    }

    $stmt = $this->mysqli->prepare("INSERT INTO actors (actor_name) VALUES (?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        return "Error: Failed to prepare statement: " . $this->mysqli->error;
    }

    // Bind parameter
    $stmt->bind_param("s", $actor_name);

    // Check for errors in binding parameters
    if ($stmt->errno) {
        return "Error: Failed to bind parameters: " . $stmt->error;
    }

    // Insert each actor and retrieve the actorID
    foreach ($actors as $actor) {
        // Set the actor name
        $actor_name = $actor;

        // Execute the statement to insert the actor
        $result = $stmt->execute();

        // Check for errors in executing the statement
        if (!$result) {
            return "Error: Failed to execute statement: " . $stmt->error;
        }

        // Retrieve the auto-generated ID for the inserted actor
        $actorID = $stmt->insert_id;

        // Call the function to insert into actorsAssociatedWith table
        $result = $this->insertActorsAssociatedWith($actorID, $contentID);

        // Check for errors in inserting into actorsAssociatedWith table
        if ($result !== true) {
            return $result; // Return the error message
        }
    }

    // Close the statement
    $stmt->close();
}

public function insertActorsAssociatedWith($actorID, $contentID)
{
    $stmt = $this->mysqli->prepare("INSERT INTO actorsAssociatedWith (actorID, contentID) VALUES (?, ?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        return "Error: Failed to prepare statement: " . $this->mysqli->error;
    }

    // Bind parameters
    $stmt->bind_param("ii", $actorID, $contentID);

    // Check for errors in binding parameters
    if ($stmt->errno) {
        return "Error: Failed to bind parameters: " . $stmt->error;
    }

    // Execute the statement to insert into actorAssociatedWith
    $result = $stmt->execute();

    // Check for errors in executing the statement
    if (!$result) {
        return "Error: Failed to execute statement: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    return true;
}

public function insertGenreAssociatedWith($genreID, $contentID)
{
    $stmt = $this->mysqli->prepare("INSERT INTO genreAssociatedWith (genreID, contentID) VALUES (?, ?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        return "Error: Failed to prepare statement: " . $this->mysqli->error;
    }

    // Bind parameters
    $stmt->bind_param("ii", $genreID, $contentID);

    // Check for errors in binding parameters
    if ($stmt->errno) {
        return "Error: Failed to bind parameters: " . $stmt->error;
    }

    // Execute the statement to insert into genreAssociatedWith
    $result = $stmt->execute();

    // Check for errors in executing the statement
    if (!$result) {
        return "Error: Failed to execute statement: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    return true;
}

    private function generateUniqueId($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    private function isIdExists($id, $table, $column) {
        try {
            // Prepare SQL statement
            $sqlQuery = "SELECT COUNT(*) FROM $table WHERE $column = ?";
            $stmt = $this->mysqli->prepare($sqlQuery);
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $this->mysqli->error);
            } 
            // Bind parameter
            $stmt->bind_param("s", $id); 
            // Execute statement
            if (!$stmt->execute()) {
                throw new Exception("Execution of statement failed: " . $stmt->error);
            }
            // Bind result
            $stmt->bind_result($count);
            // Fetch result
            $stmt->fetch();
            // Close statement
            $stmt->close();
            // Return whether the count is greater than 0
            return $count > 0;
        } catch (Exception $e) {
            // Handle exception
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
   

   
}

?>