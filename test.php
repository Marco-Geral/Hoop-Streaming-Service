<?php
// Include api.php
require_once('api.php');

// Create an instance of the class containing getData() method
$api = new api();

// Call the getData() method
$result = $api->getMovies();
$result = $api->getShows();

// Output the result
echo $result;
?>
