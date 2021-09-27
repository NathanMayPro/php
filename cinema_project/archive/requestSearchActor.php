<?php
require "functions.php";

if (isset($_GET["actors"])) {
    require "connection.php";
    $query_search_movie = "SELECT production_company from movies where movies.production_company Like '" . $_GET["production_company"] . "%' limit 5";
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
