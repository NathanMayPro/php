<?php

require 'connection.php';
require 'functions.php';

if (isset($_POST["title"])) {
    $query_movie = "select * from movies where movies.title = '" . $_POST["title"] . "'";
    $movie_data = mysqli_fetch_row(mysqli_query($conn, $query_movie));
    $query_columns = "SELECT column_name FROM information_schema.columns WHERE table_name='movies'";
    $columns_data = mysqli_fetch_all(mysqli_query($conn, $query_columns));

    $result = reduceDimensionalityArray($columns_data);
    // Transforme un double array en un objet
    $result = array_combine($singleArray, $movie_data);
    //echo $result;
    echo json_encode($result);
}
