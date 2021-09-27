<?php
require "functions.php";

if (isset($_GET["data"])) {
    require "connection.php";
    $query = "SELECT distinct(production_company) from movies where movies.production_company Like '" . $_GET["data"] . "%' limit 5";
    // $result = mysqli_query($conn, $query);
    // while ($row = mysqli_fetch_row($result)) {
    //     echo $row;
    // }
    $result = mysqli_fetch_all(mysqli_query($conn, $query));
    $result = reduceDimensionalityArray($result);
    //$result = array_slice($result, 0, 5);
    //   $result = array_slice($result,0, )

    if ($result != "")
        echo json_encode($result);
}
