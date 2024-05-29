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
        if(isset($result['null values']))
        {
            return;
        }
        if(!$result) {
            http_response_code(500); // Internal Server Error
            header('Content-Type: application/json');
            die(json_encode(["status" => "error", "message" => "Failed to insert movie content"]));
        }

        $reviews = $result['reviews'];
        $contentID = $result['contentID'];
        $actors = $result['actors'];
        $genres = $result['genres'];

        $this->insertReviews($contentID, $reviews);
        $this->insertActors($actors, $contentID);//call the insertAssociated with function in this function
        $this->insertGenres($genres, $contentID);//call the insertAssociated with function in this function
 
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
    if(isset($result['null values']))
    {
        return;
    }
    if (!$result) {
        http_response_code(500); // Internal Server Error
        header('Content-Type: application/json');
        die(json_encode(["status" => "error", "message" => "Failed to insert movie content"]));
    }

    $reviews = $result['reviews'];
    $contentID = $result['contentID'];
    $actors = $result['actors'];
    $genres = $result['genres'];

    $this->insertReviews($contentID, $reviews);
    $this->insertActors($actors, $contentID);//call the insertAssociated with function in this function
    $this->insertGenres($genres, $contentID);//call the insertAssociated with function in this function

    $timestamp = microtime(true) * 1000; 
    $response = [
                "status" => "success",
                "timestamp" => $timestamp,
                "message" => "Movie data was successfully loaded"
    ];
    return json_encode($response);
}

    private function insertMovieContent($data)
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
                return false;
            };
        
        // Extracting relevant fields
            $title = isset($data['original_title']) ? $data['original_title'] : "Title not found"; 
            $description = isset($data['overview']) ? $data['overview'] : "In a world of unexpected challenges, a group of diverse individuals must navigate personal struggles and complex relationships. As they face unpredictable events, they discover the strength within themselves and the power of unity to overcome their greatest obstacles.";
            $DBrating = isset($data['popularity']) ? $data['popularity'] : 101;
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
            if(!isset($data['poster_path']))
            {
                $response = [
                    'null values' => true
                ];
                return $response;
            }
            $imgUrl = $data['poster_path'];
            $studio = isset($data['production_companies'][0]['name']) ? $data['production_companies'][0]['name'] : "";
            if (strlen($studio) > 50) {
                $studio = substr($studio, 0, 50);
            }
            // Finds first production company (studio)
            $release_date = isset($data['release_date']) ? $data['release_date'] : "1999-07-24";
        
        
        // Extracting the name of the director
        $director = "James Cameron";  
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
                    'contentID' => $contentID
                ];
                return $response;
            }
    }

    private function insertShowContent($data)
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
            return false;
        };
        
        // Extracting relevant fields
            $title = isset($data['name']) ? $data['name'] : "Title not found"; 
            $description = isset($data['overview']) ? $data['overview'] : "In a world of unexpected challenges, a group of diverse individuals must navigate personal struggles and complex relationships. As they face unpredictable events, they discover the strength within themselves and the power of unity to overcome their greatest obstacles.";
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
            if(!isset($data['poster_path']))
            {
                $response = [
                    'null values' => true
                ];
                return $response;
            }
            $imgUrl = $data['poster_path'];
            $studio = isset($data['production_companies'][0]['name']) ? $data['production_companies'][0]['name'] : "";
            if (strlen($studio) > 50) {
                $studio = substr($studio, 0, 50);
            }
             // Finds first production company (studio)
            $release_date = isset($data['first_air_date']) ? $data['first_air_date'] : "1999-07-24";
            //$director = "Alan Taylor";
            $director = isset($data['created_by'][0]['original_name']) ? $data['created_by'][0]['original_name'] : "John Patterson";
        

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
                    $reviews[] = $content;
                }
            }
        }
        
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
        
        
        // Print the extracted data -> debugging
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
                    'contentID' => $contentID
                ];
                return $response;
            }
    }

    private function insertReviews($contentID, $reviews)
    {
        // Prepare the insert statement
        $stmt = $this->mysqli->prepare("INSERT INTO reviews (contentID, review) VALUES (?, ?)");
        if (!$stmt) {
            echo "Error: Failed to prepare statement: " . $this->mysqli->error;
            return false;
        }
    
        // Check for errors in binding parameters
    
        // If $reviews is not an array, convert it to an array
        if (!is_array($reviews)) {
            $reviews = [$reviews];
        }
    
        // Insert each review
        foreach ($reviews as $review) {
            $stmt->bind_param("is", $contentID, $review);
            if ($stmt->errno) {
                echo "Error: Failed to bind parameters: " . $stmt->error;
                return false;
            }
            if (!$stmt->execute()) {
                echo "Error: Failed to execute statement: " . $stmt->error;
                return false;
            }
        }
    
        $stmt->close();
        echo "Reviews inserted successfully.";
        return true;
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


    foreach ($genres as $genre) {
        $genre_type = $genre;
        $stmt->bind_param("s", $genre_type);
        if ($stmt->errno) {
            return "Error: Failed to bind parameters: " . $stmt->error;
        }
        if (!$stmt->execute()) {
            return "Error: Failed to execute statement: " . $stmt->error;
        }

        $genreID = $stmt->insert_id;
        $result = $this->insertGenreAssociatedWith($genreID, $contentID);
        if ($result !== true) {
            return $result;
        }
    }

    $stmt->close();
    return true;
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

    // Insert each actor and retrieve the actorID
    foreach ($actors as $actor) {
        $actor_name = $actor;
        $stmt->bind_param("s", $actor_name);
        if ($stmt->errno) {
            return "Error: Failed to bind parameters: " . $stmt->error;
        }
        if (!$stmt->execute()) {
            return "Error: Failed to execute statement: " . $stmt->error;
        }

        $actorID = $stmt->insert_id;
        $result = $this->insertActorsAssociatedWith($actorID, $contentID);
        if ($result !== true) {
            return $result;
        }
    }

    $stmt->close();
    return true;
}

public function insertActorsAssociatedWith($actorID, $contentID)
{
    $stmt = $this->mysqli->prepare("INSERT INTO actorsAssociatedWith (actorID, contentID) VALUES (?, ?)");

    if (!$stmt) {
        echo "Error: Failed to prepare statement: " . $this->mysqli->error;
    }

    // Bind parameters
    $stmt->bind_param("ii", $actorID, $contentID);
    if ($stmt->errno) {
        echo "Error: Failed to bind parameters: " . $stmt->error;
    }

    // Execute the statement to insert into actorAssociatedWith
    $result = $stmt->execute();

    // Check for errors in executing the statement
    if (!$stmt->execute()) {
        return "Error: Failed to execute statement: " . $stmt->error;
    }

    $stmt->close();
    return true;
}

public function insertGenreAssociatedWith($genreID, $contentID)
{
    $stmt = $this->mysqli->prepare("INSERT INTO genreAssociatedWith (genreID, contentID) VALUES (?, ?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        echo "Error: Failed to prepare statement: " . $this->mysqli->error;
    }

    // Bind parameters
    $stmt->bind_param("ii", $genreID, $contentID);
    if ($stmt->errno) {
        echo "Error: Failed to bind parameters: " . $stmt->error;
    }

    // Execute the statement to insert into genreAssociatedWith
    $result = $stmt->execute();
    if (!$result) {
        echo "Error: Failed to execute statement: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    return true;
}

    //Function to generate a unique ID for database insertion
    private function generateUniqueId($length = 11) {
        // Maximum value for a signed INT
        $maxValue = 2147483647;
        
        // Generate a random integer within the specified range
        $randomInteger = random_int(0, $maxValue);
    
        // Convert the random integer to a string
        $randomIntegerString = str_pad($randomInteger, $length, '0', STR_PAD_LEFT);
    
        return $randomIntegerString;
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