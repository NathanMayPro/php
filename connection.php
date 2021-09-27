<?php
$servername = "localhost";
$username = "nathan";
$password = "Samuel01$";
$dbname = "imdb_movies";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully\n";
