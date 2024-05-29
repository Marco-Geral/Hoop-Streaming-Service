<?php
session_start();
// u23584565 - Marco Geral
require_once '221config.php';

class API {
    private static $instance = null;
    private $db;

    private function __construct() {
        $this->db = Database::getInstance(); 
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new API();
        }
        return self::$instance;
    }

    private function errorResponseRequest($message, $statusCode = 400) {
        // Prepare the error response array
        $response = [
            'status' => 'error',
            'timestamp' => time() * 1000, // Convert to milliseconds
            'data' => $message
        ];
    
        // Set the HTTP response code
        http_response_code($statusCode);
    
        // Return the JSON-encoded error response
        return json_encode($response);
    }

    public function processRequest() { //THIS IS WHERE API DETERMINES TYPE OF REQUEST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the request body
            $requestBody = json_decode(file_get_contents('php://input'), true);
            if (empty($requestBody)) {
                // Return an error response indicating that post parameters are missing
                return $this->errorResponseRequest('Post parameters are missing', 400);
            }
            // Check if request type is whatever
            if (isset($requestBody['action']) && $requestBody['action'] === 'Register') {
                return $this->registerUser($requestBody);
            } elseif(isset($requestBody['action']) && $requestBody['action'] === 'Login') {
                return $this->returnUser($requestBody);
            } //elseif(isset($requestBody['action']) && $requestBody['action'] === 'LoginAdmin') {
                //return $this->returnAdmin($requestBody);
            //} 
            elseif(isset($requestBody['action']) && $requestBody['action'] === 'GetAllShows') {
                return $this->getShow($requestBody);
            } elseif(isset($requestBody['action']) && $requestBody['action'] === 'AddShow') {
                return $this->AddShow($requestBody);
            } elseif(isset($requestBody['action']) && $requestBody['action'] === 'DeleteShow') {
                return $this->deleteShow($requestBody);
            } elseif(isset($requestBody['action']) && $requestBody['action'] === 'UpdateShow') {
                return $this->updateShow($requestBody);
            } elseif(isset($requestBody['action']) && $requestBody['action'] === 'AddReview') {
                return $this->addReview($requestBody);
            } elseif(isset($requestBody['action']) && $requestBody['action'] === 'AddToFavourites') {
                return $this->addToFavourites($requestBody);
            } elseif(isset($requestBody['action']) && $requestBody['action'] === 'DeleteFavourites') {
                return $this->deleteFromFavourites($requestBody);
            }
            return $this->errorResponse('Invalid request', 400);
        }
    }

//-------------------------------------------- FOR ADMIN LOGIN ------------------------------------------------------------
    private function returnAdmin($data) {  
        // server-side validation
        if (!$this->loginValidationAdmin($data)) {
            http_response_code(400);
            return $this->errorResponse('user does not exist');
        } else {
            // Prepare the SQL statement
            $stmt = $this->db->mysqli->prepare("SELECT email FROM `admin` WHERE email =?");
            if ($stmt === false) {
                die("Error in preparing statement: ". $this->db->mysqli->error);
            }
            
    
            // Bind the email parameter to the prepared statement
            $stmt->bind_param("s", $data['email']);
    
            // Execute the prepared statement
            if ($stmt->execute() === false) {
                die("Error in executing statement: ". $stmt->error);
            }
    
            // Fetch the result
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                http_response_code(404);
                return $this->errorResponse('Customer not found');
            }
    
            // Fetch the API key
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            $_SESSION['isAdmin'] = $row['isAdmin'];
            return $this->successResponse(['email' => $row['email']]);
        }
    }

    private function loginValidationAdmin($data) {
        // Check if required fields are not empty
        if (empty($data['action']) || empty($data['email']) || empty($data['password'])) {
            return false;
        }
        return true;
    }
//------------------------------------------------------------------------------------------------------------------------



//------------------------------------------ FOR CUSTOMER/ADMIN LOGIN ----------------------------------------------------------
    private function returnUser($data) {
        // server-side validation
        if (!$this->loginValidation($data)) {
            http_response_code(400);
            return $this->errorResponse('user does not exist');
        } else {
            // Prepare the SQL statement
            $stmt = $this->db->mysqli->prepare("SELECT * FROM `customer` WHERE email =?");
            if ($stmt === false) {
                die("Error in preparing statement: ". $this->db->mysqli->error);
            }
            
    
            // Bind the email parameter to the prepared statement
            $stmt->bind_param("s", $data['email']);
    
            // Execute the prepared statement
            if ($stmt->execute() === false) {
                die("Error in executing statement: ". $stmt->error);
            }
    
            // Fetch the result
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                http_response_code(404); 
                return $this->errorResponse('Customer not found');
            }
    
            // Fetch the API key
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['isAdmin'] = $row['isAdmin'];
            return $this->successResponse(['email' => $row['email'], "id" => $row['id'], "F_name" => $row['F_name'], "L_Name" => $row['L_Name'], "isAdmin" => $row['isAdmin'], "phone" => $row['phone']]);
        }
    }
    
    private function loginValidation($data) {
        // Check if required fields are not empty
        if (empty($data['action']) || empty($data['email']) || empty($data['password'])) {
            return false;
        }
        // Retrieve the stored hashed password for the given email

        $storedHashedPassword = $this->db->getHashedPasswordForEmail($data['email']);
        // Verify the provided password against the stored hash using Argon2
        if ($this->verifyPassword($data['password'], $storedHashedPassword)) {
            return true;
        }
        return false;
    }

    private function verifyPassword($password, $storedHash) {
        // Use PHP's built-in password_verify function to verify the password
        return password_verify($password, $storedHash);
    }
//------------------------------------------------------------------------------------------------------------------------



//------------------------------------------- FOR REGISTER CUSTOMER ------------------------------------------------------
    private function registerUser($data) {
        // server-side validation
        if (!$this->validateInput($data)) {
            // Return error response with status code 400 (Bad Request)
            http_response_code(400);
            return $this->errorResponse('Invalid input');
        }
        
        // Check if user already exists
        if ($this->db->userExists($data['email'])) {
            // Return error response with status code 409 (Conflict)
            http_response_code(409);
            return $this->errorResponse('User already exists');
        }

        // Generate an API key
        //$apiKey = bin2hex(random_bytes(10)); // Generate a unique API key
        //echo $apiKey;

        // Insert the new user into the database
        $result = $this->db->insertUser($data['email'], $data['phone'], $data['F_name'],$data['L_Name'], $data['password']);
        //echo $result;
        //echo '/result here';        
        if ($result) {
            $email = $data['email'];
            // Return success response with status code 201 (Created)
            http_response_code(201);
            return $this->successResponse(['email' => $email]);
        } else {
            // Return error response with status code 500 (Internal Server Error)
            http_response_code(500);
            return $this->errorResponse('Failed to register user');
        }
    }

	private function validateInput($data) {
		// Check if required fields are not empty
		if (empty($data['F_name']) || empty($data['L_Name']) || empty($data['email']) || empty($data['password']) || empty($data['phone'])) {
			return false;
		}

		// Validate email format using regex
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			return false;
		}

		// Validate password using regex
		// Password must be at least 8 characters long, contain upper and lower case letters, at least one digit, and one symbol
		$passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
		if (!preg_match($passwordPattern, $data['password'])) {
			return false;
		}

		return true;
	}
//------------------------------------------------------------------------------------------------------------------------



//----------------------------------------- BASIC SUCCESS/ERROR RESPONSE -------------------------------------------------
    private function successResponse($data) {
        // Return a success response with the provided data
        return json_encode(['status' => 'success', 'timestamp' => time() * 1000, 'data' => $data]);
    }

    private function errorResponse($message, $statusCode = 400) {
        // Return an error response with the provided message and status code
        http_response_code($statusCode);
        return json_encode(['status' => 'error', 'message' => $message]);
    }
//------------------------------------------------------------------------------------------------------------------------



//---------------------------------------- FOR GET ALL SHOWS -------------------------------------------------------------
    private function getShow($data) {
        // Initialize variables for building the query
        $query = "SELECT 
                        c.id, 
                        c.type, 
                        c.title, 
                        c.director, 
                        c.rating, 
                        c.description, 
                        c.release_date, 
                        c.studio, 
                        CONCAT('https://image.tmdb.org/t/p/original', c.imgURL) AS imgURL, 
                        GROUP_CONCAT(DISTINCT CONCAT(a.actor_name, ', ') SEPARATOR '; ') AS actors,
                        GROUP_CONCAT(DISTINCT g.genre_type) AS genres,
                        GROUP_CONCAT(r.review SEPARATOR '; ') AS reviews
                FROM 
                        content c
                LEFT JOIN 
                        genreAssociatedWith gaw ON c.id = gaw.contentID
                LEFT JOIN 
                        genre g ON gaw.genreID = g.genreID
                LEFT JOIN 
                        actorsAssociatedWith aa ON c.id = aa.contentID
                LEFT JOIN 
                        actors a ON aa.actorID = a.actorID
                LEFT JOIN 
                        reviews r ON c.id = r.contentID";

        $whereClauses = [];
        $orderBy = '';
        $limit = '';

        // Construct the WHERE clause based on search criteria
        if (isset($data['search']) &&!empty($data['search'])) {
            foreach ($data['search'] as $key => $value) {
                // Convert both the search term and the column values to lowercase for case-insensitive matching
                $lowercaseValue = strtolower($value);
                $lowercaseColumn = strtolower($key);
                
                // Use '%' wildcard around the search term to allow partial matches
                $whereClauses[] = "$lowercaseColumn LIKE '%$lowercaseValue%'";
            }
        }

        // Construct the WHERE clause based on filter criteria
        if (isset($data['filter']) &&!empty($data['filter'])) {
            foreach ($data['filter'] as $key => $value) {
                if($key == "type") {
                    $whereClauses[] = "c.$key = '$value'";
                } else if($key == "genre_type"){
                    $whereClauses[] = "g.$key = '$value'";
                } else {
                    $whereClauses[] = "c.$key = $value";
                }   
            }
        }

        // Construct the ORDER BY clause based on sort criteria
        if (isset($data['sort'])) {
            $orderBy = "\nORDER BY $data[sort]";
        }

        // Apply LIMIT based on the limit parameter
        if (isset($data['limit'])) {
            $limit = "LIMIT ". intval($data['limit']);
        }

        // Conditionally append dynamic parts to the query
        if (!empty($whereClauses)) {
            $query.= "\nWHERE ". implode(" AND ", $whereClauses);
        }
        $query.= "\nGROUP BY c.id";
        if (!empty($orderBy)) {
            $query.= " ". $orderBy;
        }
        $query.= "\n". $limit .";";

        //echo $query. "\n";

        // Prepare and execute the query
        $stmt = $this->db->queryShows($query,...array_values($whereClauses));
        $results = $this->db->fetchShows($stmt);

        // Call the successResponseShows function to format and return the data
        return $this->successResponseShows($results);
    }

    private function successResponseShows($data) {
        // Prepare the response array
        $response = [
            'status' => 'success',
            'timestamp' => time() * 1000, // Convert to milliseconds
            'data' => $data
        ];
    
        // Return the JSON-encoded response
        return json_encode($response);
    }
//------------------------------------------------------------------------------------------------------------------------



//----------------------------------------- ADD SHOW ---------------------------------------------------------------------
    public function addShow($requestBody) {
        // Extract data from the request body
        $type = $requestBody['type'];
        $title = $requestBody['title'];
        $director = $requestBody['director'];
        $rating = $requestBody['rating'];
        $description = $requestBody['description'];
        $release_date = $requestBody['release_date'];
        $studio = $requestBody['studio'];
        $imgURL = $requestBody['imgURL'];
        $genre_type = $requestBody['genre_type'];
        $actor_names = $requestBody['actor_name'];
        $review = $requestBody['review'];
        $contentID = $this->generateUniqueId();

        // Check if the ID already exists in the database
        while ($this->isIdExists($contentID, 'content', 'id')) {
            $contentID = $this->generateUniqueId();
        }       

        // Start transaction to ensure data integrity
        $this->db->mysqli->begin_transaction();

        try {
            // Insert content into the content table
            $insertContentSql = "INSERT INTO content (id, type, title, director, rating, description, release_date, studio, imgURL) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $this->db->query($insertContentSql, [$contentID, $type, $title, $director, $rating, $description, $release_date, $studio, $imgURL]);
            //$contentId = $stmt->insert_id; // Get the ID of the newly inserted content

            // Insert genre into the genres table
            $insertGenreSql = "INSERT INTO genre (genre_type) VALUES (?)";
            $genreStmt = $this->db->query($insertGenreSql, [$genre_type]);
            $genreId = $genreStmt->insert_id; // Get the ID of the newly inserted genre

            // Associate genre with content
            $insertGenreAssocSql = "INSERT INTO genreAssociatedWith (genreID, contentID) VALUES (?,?)";
            $this->db->query($insertGenreAssocSql, [$genreId, $contentID]);

            // Insert actors into the actors table
            foreach ($actor_names as $actorName) {
                $insertActorSql = "INSERT INTO actors (actor_name) VALUES (?)";
                $actorStmt = $this->db->query($insertActorSql, [$actorName]);
                $actorId = $actorStmt->insert_id; // Get the ID of the newly inserted actor

                // Associate actor with content
                $insertActorAssocSql = "INSERT INTO actorsAssociatedWith (actorID, contentID) VALUES (?,?)";
                $this->db->query($insertActorAssocSql, [$actorId, $contentID]);
            }

            // Insert review
            if(isset($review)) {
                $insertReviewSql = "INSERT INTO reviews (contentID, review) VALUES (?,?)";
                $this->db->query($insertReviewSql, [$contentID, $review]);
            }

            // Commit the transaction
            $this->db->mysqli->commit();

            // Return success response
            return ['success' => true, 'message' => 'Show added successfully'];
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            $this->db->mysqli->rollback();
            // Return error response
            return $this->errorResponseRequest('An error occurred while adding the show.', 500);
        }
    }

    public function generateUniqueId($length = 11) {
        // Maximum value for a signed INT
        $maxValue = 2147483647;
        
        // Generate a random integer within the specified range
        $randomInteger = random_int(0, $maxValue);
    
        // Convert the random integer to a string
        $randomIntegerString = str_pad($randomInteger, $length, '0', STR_PAD_LEFT);
    
        return $randomIntegerString;
    }

    function isIdExists($id, $table, $column) {
        try {
            // Prepare SQL statement
            $sqlQuery = "SELECT COUNT(*) FROM $table WHERE $column = ?";
            $stmt = $this->db->mysqli->prepare($sqlQuery);
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $this->db->mysqli->error);
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
//------------------------------------------------------------------------------------------------------------------------



//----------------------------------------- UPDATE SHOW ------------------------------------------------------------------
    public function updateShow($requestBody) {
        // Check if the title is set
        if (empty($requestBody['title'])) {
            return $this->errorResponse("Error: 'title' is a required field and must be provided.", 400);
        }

        // Extract fields from the request body
        $title = $requestBody['title'];
        $type = isset($requestBody['type']) ? $requestBody['type'] : null;
        $director = isset($requestBody['director']) ? $requestBody['director'] : null;
        $rating = isset($requestBody['rating']) ? $requestBody['rating'] : null;
        $description = isset($requestBody['description']) ? $requestBody['description'] : null;
        $release_date = isset($requestBody['release_date']) ? $requestBody['release_date'] : null;
        $studio = isset($requestBody['studio']) ? $requestBody['studio'] : null;
        $imgURL = isset($requestBody['imgURL']) ? $requestBody['imgURL'] : null;
        $genre_type = isset($requestBody['genre_type']) ? $requestBody['genre_type'] : null;
        $actor_names = isset($requestBody['actor_name']) ? $requestBody['actor_name'] : null;
        $review = isset($requestBody['review']) ? $requestBody['review'] : null; // dont forget this guy

        // Check if the show exists in the content table
        $sql = "SELECT id FROM content WHERE title = ?";
        $stmt = $this->db->querySingleValue($sql, $title);
        $result = $stmt->get_result();
        $contentID = $result->fetch_assoc()['id'];

        // Prepare the update statement
        $sql = "UPDATE content SET ";
        $params = [];
        $fields = [];

        if ($type !== null) {
            $fields[] = "type = ?";
            $params[] = $type;
        }
        if ($director !== null) {
            $fields[] = "director = ?";
            $params[] = $director;
        }
        if ($rating !== null) {
            $fields[] = "rating = ?";
            $params[] = $rating;
        }
        if ($description !== null) {
            $fields[] = "description = ?";
            $params[] = $description;
        }
        if ($release_date !== null) {
            $fields[] = "release_date = ?";
            $params[] = $release_date;
        }
        if ($studio !== null) {
            $fields[] = "studio = ?";
            $params[] = $studio;
        }
        if ($imgURL !== null) {
            $fields[] = "imgURL = ?";
            $params[] = $imgURL;
        }

        // If there are fields to update
        if (!empty($fields)) {
            $sql .= implode(", ", $fields) . " WHERE id = ?";
            $params[] = $contentID;
            $this->db->query($sql, $params);
        }

        // Update genre associations
        if ($genre_type !== null) {
            if (!is_array($genre_type)) {
                $genre_type = [$genre_type];
            }
        
            if (is_array($genre_type)) {

                // Insert new associations
                foreach ($genre_type as $genre) {
                    $genreID = $this->getOrInsertGenre($genre);
                    $sql = "INSERT INTO genreAssociatedWith (genreID, contentID) VALUES (?, ?)";
                    $this->db->query($sql, [$contentID, $genreID]);
                }
            }
        }

        // Update actor associations
        if ($actor_names !== null) {
            if (!is_array($actor_names)) {
                $actor_names = [$actor_names];
            }
        
            if (is_array($actor_names)) {

                // Insert new associations
                foreach ($actor_names as $actor) {
                    $actorID = $this->getOrInsertActor($actor);
                    $sql = "INSERT INTO actorAssociatedWith (actorID, contentID) VALUES (?, ?)";
                    $this->db->query($sql, [$contentID, $actorID]);
                }
            }
        }

        if ($review !== null) {
            if (!is_array($review)) {
                $review = [$review];
            }
            foreach($review as $rev)
            {
                $sql = "INSERT INTO reviews (contentID, review) VALUES (?, ?)";
                $this->db->query($sql, [$contentID, $rev]);
            }
        }

        return ['success' => true, 'message' => 'Show updated successfully'];
    }

    private function getOrInsertGenre($genre) {
        //to be honest this isn't how our database works but we can deal with that later 
        //at the moment how it works: we insert genres/actors without considering whether
        //or not they already exist in the DB so either this function can be removed from 
        //here or i can change how it works on my side

        // Check if the genre exists
        $sql = "SELECT genreID FROM genre WHERE genre_type = ?";
        $stmt = $this->db->querySingleValue($sql, $genre);
        $row = $this->db->fetch($stmt);

        if ($row) {
            return $row['genreID'];
        }

        // Insert the new genre
        $sql = "INSERT INTO genre (name) VALUES (?)";
        $this->db->query($sql, [$genre]);
        return $this->db->mysqli->insert_id;
    }

    private function getOrInsertActor($actor) {
        // Check if the actor exists
        $sql = "SELECT actorID FROM actors WHERE actor_name = ?";
        $stmt = $this->db->querySingleValue($sql, $actor);
        $row = $this->db->fetch($stmt);

        if ($row) {
            return $row['actorID'];
        }

        // Insert the new actor
        $sql = "INSERT INTO actors (actor_name) VALUES (?)";
        $this->db->query($sql, [$actor]);
        return $this->db->mysqli->insert_id;
    }
//------------------------------------------------------------------------------------------------------------------------



//----------------------------------------- DELETE SHOW ------------------------------------------------------------------
    public function deleteShow($requestBody) {
        // Extract data from the request body
        $action = $requestBody['action'];
        $title = $requestBody['title'];

        // Check if the action is valid
        if ($action !== "DeleteShow") {
            return ['success' => false, 'message' => 'Invalid action'];
        }

        // Start transaction to ensure data integrity
        $this->db->mysqli->begin_transaction();

        try {
            // Find the content ID of the movie to be deleted
            $findContentSql = "SELECT id FROM `content` WHERE title =?";
            $stmt = $this->db->querySingleValue($findContentSql, $title);
            
            // Execute the query
            if (!$stmt->execute()) {
                die("Error in query execution: ". $stmt->error);
            }
            $contentRow = $this->db->fetch($stmt);
            echo "CONTENT ROW " .$contentRow['id'];
            
            if (!$contentRow) {
                throw new \Exception("No content found with title '$title'");
            }
            $contentId = $contentRow['id']; // Now correctly accesses the 'id' column
            
            // Delete actors
            $deleteActorsSql = "DELETE FROM actors WHERE actorID IN (SELECT actorID FROM actorsAssociatedWith WHERE contentID =?)";
            $this->db->querySingleValue($deleteActorsSql, $contentId);

            // Delete actor associations
            $deleteActorAssocSql = "DELETE FROM actorsAssociatedWith WHERE contentID =?";
            $this->db->querySingleValue($deleteActorAssocSql, $contentId);

            // Delete genres
            $deleteGenresSql = "DELETE FROM genre WHERE genreID IN (SELECT genreID FROM genreAssociatedWith WHERE contentID =?)";
            $this->db->querySingleValue($deleteGenresSql, $contentId);

            // Delete genre associations
            $deleteGenreAssocSql = "DELETE FROM genreAssociatedWith WHERE contentID =?";
            $this->db->querySingleValue($deleteGenreAssocSql, $contentId);            

            // Delete reviews
            $deleteReviewsSql = "DELETE FROM reviews WHERE contentID =?";
            $this->db->querySingleValue($deleteReviewsSql, $contentId);

            // Delete content from the content table
            $deleteContentSql = "DELETE FROM content WHERE id =?";
            $this->db->querySingleValue($deleteContentSql, $contentId);

            // Commit the transaction
            $this->db->mysqli->commit();

            // Return success response
            return ['success' => true, 'message' => 'Show deleted successfully'];
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            $this->db->mysqli->rollback();
            // Return error response
            return $this->errorResponseRequest('An error occurred while deleting the show.', 500);
        }
    }
//------------------------------------------------------------------------------------------------------------------------



//----------------------------------------- ADD REVIEW -------------------------------------------------------------------
    public function addReview($requestBody) {
        // Extract data from the request body
        $action = $requestBody['action'];
        $contentId = $requestBody['id'];
        $reviewText = $requestBody['review'];

        // Check if the action is valid
        if ($action!== "AddReview") {
            return ['success' => false, 'message' => 'Invalid action'];
        }

        // Start transaction to ensure data integrity (optional)
        // $this->db->mysqli->begin_transaction();

        try {
            // Prepare the SQL statement to insert the review
            $insertReviewSql = "INSERT INTO reviews (contentID, review) VALUES (?,?)";

            // Prepare the statement
            $stmt = $this->db->query($insertReviewSql, [$contentId, $reviewText]);

            // Execute the query
            if (!$stmt->execute()) {
                die("Error in query execution: ". $stmt->error);
            }

            // Optionally, commit the transaction if started
            // $this->db->mysqli->commit();

            // Return success response
            return ['success' => true, 'message' => 'Review added successfully'];
        } catch (\Exception $e) {
            // Rollback the transaction in case of error (optional)
            // $this->db->mysqli->rollback();

            // Return error response
            return $this->errorResponseRequest('An error occurred while adding the review.', 500);
        }
    }
//------------------------------------------------------------------------------------------------------------------------



//----------------------------------------- ADD TO FAVOURITES ------------------------------------------------------------
    public function addToFavourites($requestBody) {
        // Extract data from the request body
        $action = $requestBody['action'];
        $customerId = $requestBody['customerID'];
        $contentId = $requestBody['contentID'];

        // Check if the action is valid
        if ($action!== "AddToFavourites") {
            return ['success' => false, 'message' => 'Invalid action'];
        }

        // Start transaction to ensure data integrity
        $this->db->mysqli->begin_transaction();

        try {
            
            // Step 1: Insert a new record into the profiles table
            $insertProfileSql = "INSERT INTO profiles (customerID) VALUES (?)";
            $stmt = $this->db->querySingleValueFav($insertProfileSql, $customerId);

            // Execute the query
            //if (!$stmt->execute()) {
                //die("Error in inserting profile: ". $stmt->error);
            //}
            $lastInsertedId = $stmt->insert_id;

            // Commit the transaction after the first insert
            $this->db->mysqli->commit();

            // Now proceed with the second insert
            // Step 3: Insert a new record into the profile_favourites table
            $insertFavouriteSql = "INSERT INTO profile_favourites (profileID, contentID) VALUES (?,?)";
            $favouriteStmt = $this->db->queryFav($insertFavouriteSql, [$lastInsertedId, $contentId]);

            // Execute the query
            if (!$favouriteStmt->execute()) {
                die("Error in inserting favourite: ". $favouriteStmt->error);
            }

            // Optionally, commit again if needed, but usually not necessary
            $this->db->mysqli->commit();

            // Return success response
            return ['success' => true, 'message' => 'Added to favourites successfully'];
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            $this->db->mysqli->rollback();

            // Return error response
            return $this->errorResponseRequest('An error occurred while adding to favourites.', 500);
        }
    }
//------------------------------------------------------------------------------------------------------------------------



//----------------------------------------- DELETE FROM FAVOURITES -------------------------------------------------------
    public function deleteFromFavourites($requestBody) {
        // Extract data from the request body
        $action = $requestBody['action'];
        $contentID = $requestBody['contentID'];

        // Check if the action is valid
        if ($action!== "DeleteFavourites") {
            return ['success' => false, 'message' => 'Invalid action'];
        }

        // Start transaction to ensure data integrity
        $this->db->mysqli->begin_transaction();

        try {
            // Step 1: Prepare and execute the subquery to find profile ID associated with the contentID
            $selectProfileIdSql = "SELECT p.id FROM profiles p JOIN profile_favourites pf ON p.id = pf.profileID WHERE pf.contentID =?";
            $selectProfileIdResult = $this->db->querySingleValueFav($selectProfileIdSql, $contentID);

            $result = $selectProfileIdResult->get_result();
            $profileId = $result->fetch_assoc()['id']; // Get the profile ID from the result set

            // Step 2: Prepare and execute the DELETE query using the profile ID obtained from the subquery
            $deleteProfilesSql = "DELETE FROM profiles WHERE id =?";
            //$deleteProfilesParams = [$profileId];
            $deleteProfilesResult = $this->db->querySingleValueFav($deleteProfilesSql, $profileId);
            $deleteProfilesResult->execute();
            // Commit the transaction
            $this->db->mysqli->commit();

            // Return success response
            return ['success' => true, 'message' => 'Deleted from favourites successfully'];
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            $this->db->mysqli->rollback();

            // Return error response
            return $this->errorResponseRequest('An error occurred while deleting from favourites.', 500);
        }
    }
//------------------------------------------------------------------------------------------------------------------------

}
// Instantiate the API class and process the request
$api = API::getInstance();
echo $api->processRequest();
?>