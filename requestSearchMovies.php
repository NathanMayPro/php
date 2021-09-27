<?php
require "functions.php";

if (isset($_GET["data"]) === true && empty($_GET["data"]) === false) {
    require "connection.php";
    $query_search_movie = "SELECT movies.title from movies where movies.title Like '" . mysqli_real_escape_string($conn, trim($_GET["data"])) . "%' limit 5";
    // $result = mysqli_query($conn, $query);
    // while ($row = mysqli_fetch_row($result)) {
    //     echo $row;
    // }
    $result = mysqli_fetch_all(mysqli_query($conn, $query_search_movie));
    $result = reduceDimensionalityArray($result);
    //$result = array_slice($result, 0, 5);
    //   $result = array_slice($result,0, )

    if ($result != "")
        echo json_encode($result);
}
