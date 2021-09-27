<?php

require 'connection.php';
require 'functions.php';


if (isset($_POST["title"]) === true && empty($_POST["title"]) === false) {

    $query_movie = "select * from movies where movies.title = '" . mysqli_real_escape_string($conn, trim($_POST["title"])) . "'";
    $movie_data = mysqli_fetch_row(mysqli_query($conn, $query_movie));
    $query_columns = "SELECT column_name FROM information_schema.columns WHERE table_name='movies'";
    $columns_data = mysqli_fetch_all(mysqli_query($conn, $query_columns));
    $columns_data = reduceDimensionalityArray($columns_data);
    // Transforme un double array en un objet
    $result = array_combine($columns_data, $movie_data);
    //echo $result;
    echo json_encode($result);
}
