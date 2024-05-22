<?php
// u23584565 - Marco Geral

class Database {
    private $host = 'wheatley.cs.up.ac.za';
    private $db_name = 'u23533693_hoop';
    private $password = '2FBI3TIZRLEGOFBROXV3X6C6FKAIDSDQ';
    private $username = 'u23533693';
    public $mysqli;
    private static $instance = null;

    private function __construct() {
        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->mysqli->connect_errno) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /*-------------------------THIS IS ALL THE FUNCTIONS THAT DIRECTLY AFFECT THE DATABASE---------------------------------*/ 
    
    public function userExists($email) {
        $stmt = $this->mysqli->prepare("SELECT * FROM customer WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function insertUser($email, $phone, $name, $surname, $password) {
        $stmt = $this->mysqli->prepare("INSERT INTO customer (email, phone, F_name, L_Name, password) VALUES (?, ?, ?, ?, ?)");

        $hashedPassword = password_hash($password, PASSWORD_ARGON2I); // Hashing the password using ARGON

        if(!mysqli_stmt_bind_param($stmt, "sssss", $email, $phone, $name, $surname, $hashedPassword)) { 
            echo "Error:" . $this->mysqli->error;
        }
        return $stmt->execute();
    }

    public function query($sql, $params = []) {
        echo "SQL Query: $sql\n"; // Debugging
        echo "Parameters: ". implode(', ', $params). "\n"; // Debugging
    
        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error in query preparation: ". $this->mysqli->error);
        }
    
        // Calculate the number of parameters manually
        $parameterCount = preg_match_all('/\?/', $sql);
    
        if (!empty($params)) {
            $types = str_repeat('s', $parameterCount); // Assuming all parameters are strings
            if ($stmt === false) {
                die("Error in parameter binding: ". $stmt->error);
            }
            $stmt->bind_param($types,...$params);
        }
    
        echo "Executing query: $sql with parameters: ". implode(', ', $params). "\n"; // Debugging
    
        if (!$stmt->execute()) {
            die("Error in query execution: ". $stmt->error);
        }
    
        echo "Query executed successfully. Statement object: ". print_r($stmt, true). "\n"; // Debugging
        return $stmt;
    }

    public function queryFav($sql, $params = []) {
        echo "SQL Query: $sql\n"; // Debugging
        echo "Parameters: ". implode(', ', $params). "\n"; // Debugging
    
        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error in query preparation: ". $this->mysqli->error);
        }
    
        // Calculate the number of parameters manually
        $parameterCount = preg_match_all('/\?/', $sql);
    
        if (!empty($params)) {
            $types = str_repeat('i', $parameterCount); // Assuming all parameters are strings
            if ($stmt === false) {
                die("Error in parameter binding: ". $stmt->error);
            }
            $stmt->bind_param($types,...$params);
        }
    
        echo "Executing query: $sql with parameters: ". implode(', ', $params). "\n"; // Debugging
    
        if (!$stmt->execute()) {
            die("Error in query execution: ". $stmt->error);
        }
    
        echo "Query executed successfully. Statement object: ". print_r($stmt, true). "\n"; // Debugging
        return $stmt;
    }

    public function querySingleValue($sql, $param) {
        echo "SQL Query: $sql\n"; // Debugging
        echo "Parameter: $param\n"; // Debugging
    
        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error in query preparation: ". $this->mysqli->error);
        }
    
        // Bind the single parameter
        $stmt->bind_param('s', $param); // Assuming the parameter is a string
    
        echo "Executing query: $sql with parameter: $param\n"; // Debugging
    
        if (!$stmt->execute()) {
            die("Error in query execution: ". $stmt->error);
        }
    
        echo "Query executed successfully. Statement object: ". print_r($stmt, true). "\n"; // Debugging
        return $stmt;
    }

    public function querySingleValueFav($sql, $param) {
        echo "SQL Query: $sql\n"; // Debugging
        echo "Parameter: $param\n"; // Debugging
    
        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error in query preparation: ". $this->mysqli->error);
        }
    
        // Bind the single parameter
        $stmt->bind_param('i', $param); // Assuming the parameter is a string
    
        echo "Executing query: $sql with parameter: $param\n"; // Debugging
    
        if (!$stmt->execute()) {
            die("Error in query execution: ". $stmt->error);
        }
    
        echo "Query executed successfully. Statement object: ". print_r($stmt, true). "\n"; // Debugging
        return $stmt;
    }
    
    public function fetch($stmt) {
        $result = $stmt->get_result();
        if ($result === false) {
            die("Error in fetching results: ". $stmt->error);
        }
    
        // Fetch the first row as an associative array
        $row = $result->fetch_assoc();
        return $row;
    }

    public function getHashedPasswordForEmail($email) {
        // Prepare the SQL statement
        $state = $this->mysqli->prepare("SELECT password FROM `customer` WHERE email =?");
        if ($state === false) {
            echo "Failed to prepare statement: ". $this->mysqli->error;
        }

        // Bind the email parameter to the prepared statement
        $state->bind_param("s", $email);
        // Execute the prepared statement
        if ($state->execute() === false) {
            die("Error in executing statement: ". $state->error);
        }
    
        // Fetch the result
        $result = $state->get_result();
        if ($result->num_rows === 0) {
            // No user found with the given email
            return null;
        }
        // Fetch the hashed password
        $row = $result->fetch_assoc();
        return $row['password'];
    }

    public function getHashedPasswordForAdmin($email) {
        // Prepare the SQL statement
        $state = $this->mysqli->prepare("SELECT password FROM 'admin' WHERE email =?");
        if ($state === false) {
            echo "Failed to prepare statement: ". $this->mysqli->error;
        }

        // Bind the email parameter to the prepared statement
        $state->bind_param("s", $email);
        // Execute the prepared statement
        if ($state->execute() === false) {
            die("Error in executing statement: ". $state->error);
        }
    
        // Fetch the result
        $result = $state->get_result();
        if ($result->num_rows === 0) {
            // No user found with the given email
            return null;
        }
        // Fetch the hashed password
        $row = $result->fetch_assoc();
        return $row['password'];
    }

    public function queryShows($sql,...$params) {
        // Prepare the SQL statement
        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error in query preparation: ". $this->mysqli->error);
        }
    
        // Determine the number of parameters
        $numParams = count($params);
    
        // Adjust types based on actual parameters
        // Use 's' for strings and 'i' for integers
        $types = str_repeat('si', $numParams); // Default to string types for simplicity
    
        // Manually bind parameters
        for ($i = 0; $i < $numParams; ++$i) {
            $types[$i] = isset($params[$i])? gettype($params[$i]) : 's'; // Determine the type of each parameter
        }
    
        // Bind parameters
        if ($stmt === false) {
            die("Error in parameter binding: ". $stmt->error);
        }
        $stmt->bind_param($types,...$params);
    
        // Execute the query
        if (!$stmt->execute()) {
            die("Error in query execution: ". $stmt->error);
        }
    
        // Return the statement object for fetching results
        return $stmt;
    }

    public function fetchShows($stmt) {
        $result = $stmt->get_result();
        if ($result === false) {
            die("Error in fetching results: ". $stmt->error);
        }
    
        // Fetch all rows as an associative array
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    
        return $rows;
    }
    
    
}
?>