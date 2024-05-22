<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('config.php');

class api {
    
    // private $password;
    // private $email;
    // private $name;
    // private $surname;
    //private $apiKey = "bfd6b676c3cd3c77cb82b27a90623d80";
    
    // private $SQLquery;
    private static $instance = null;

    private $conn;
    
    
    public static function getInstance() {
        if(self::$instance == null)
            self::$instance = new api();
        
            return self::$instance;
    }

    public function __construct() {        
        $this->conn = Database::getInstance();

    }
    
    public function __destruct() { /* Disconnect from the database */
        self::$instance = null;
    }
    
    //TASK 1: REGISTER 
    public function getMovies() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Method Not Allowed
            header('Content-Type: application/json');
            die(json_encode(["status" => "error", "message" => "Only GET requests are allowed"]));
            //return;
        }
    
        $curl = curl_init(); // Initialize cURL handle outside the loop
        for ($i = 2000; $i < 6000; $i++) {
    //  CURLOPT_URL => "https://api.themoviedb.org/3/tv/6?language=en-US",

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.themoviedb.org/3/movie/" . $i . "?api_key=bfd6b676c3cd3c77cb82b27a90623d80&language=en-US&append_to_response=credits,reviews",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "accept: application/json"
                ],
            ]);
    
            $response = curl_exec($curl);
            $err = curl_error($curl);
    
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $message = [
                    "status" => "success",
                    "message" => "inserted movie " . $i
                ];
                echo json_encode($message);
            }
    
            // Check if response is valid JSON
            $decodedResponse = json_decode($response, true);
            if ($decodedResponse && isset($decodedResponse['credits']) && isset($decodedResponse['reviews'])) {
                // Call loadMovieData only if 'credits' index exists
                $codedResponse = $this->conn->loadMovieData($decodedResponse);
            }
        }
        curl_close($curl); // Close cURL handle outside the loop
        if (isset($codedResponse)) {
            return $codedResponse;
        }
    }

    
    public function getShows() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Method Not Allowed
            header('Content-Type: application/json');
            die(json_encode(["status" => "error", "message" => "Only GET requests are allowed"]));
            //return;
        }
    
        $curl = curl_init(); // Initialize cURL handle outside the loop
        for ($i = 6000; $i < 1000; $i++) {

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.themoviedb.org/3/tv/" . $i . "?api_key=bfd6b676c3cd3c77cb82b27a90623d80&language=en-US&append_to_response=credits,reviews",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "accept: application/json"
                ],
            ]);
    
            $response = curl_exec($curl);
            $err = curl_error($curl);
    
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $message = [
                    "status" => "success",
                    "message" => "inserted show " . $i
                ];
                echo json_encode($message);
            }
    
            // Check if response is valid JSON
            $decodedResponse = json_decode($response, true);
            if ($decodedResponse && isset($decodedResponse['credits']) && isset($decodedResponse['reviews'])) {
                // Call loadMovieData only if 'credits' index exists
                $codedResponse = $this->conn->loadShowData($decodedResponse);
            }
        }
        curl_close($curl); // Close cURL handle outside the loop
        if (isset($codedResponse)) {
            return $codedResponse;
        }
    }
    
    
      
}

$api = api::getInstance();

?>
