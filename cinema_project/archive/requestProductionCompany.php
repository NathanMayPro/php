<?php

require 'connection.php';
require 'functions.php';


if (isset($_POST["production_company"])) {
    $productionCompanyName = $_POST["production_company"];
    //echo json_encode($productionCompanyName);
    $query = sprintf(
        "select 
    _lastMovie.title,
    _count.number,
    _duration.totalProduce
    from (select title, year, production_company from movies 
    where production_company = '%s' 
    and year = (select max(year) from movies where production_company = '%s')
    order by year limit 1) as _lastMovie,
    (select count(title) as number from movies where production_company = '%s') as _count,
    (select sum(duration) as totalProduce from movies where production_company = '%s') as _duration",
        $productionCompanyName,
        $productionCompanyName,
        $productionCompanyName,
        $productionCompanyName
    );
    $result = reduceDimensionalityArray(mysqli_fetch_all(mysqli_query($conn, $query)));

    echo json_encode($result);
}
