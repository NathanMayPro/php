<?php
function initTable($dbname, $table_name, $schema_of_table)
{
    require 'connection.php';

    $sql_check_if_exists = "SELECT EXISTS(
        SELECT *
    FROM information_schema.tables
    WHERE table_schema = '%s' 
        AND table_name = '%s')";

    $sql_drop_table = "DROP TABLE %s";

    $sql_create_table  = "CREATE TABLE %s (%s)";

    $exist = mysqli_fetch_array(mysqli_query($conn, sprintf($sql_check_if_exists, $dbname, $table_name)))[0];
    if ($exist == 1) {
        echo "\nTable exists\n";
        mysqli_query($conn, sprintf($sql_drop_table, $table_name));
        echo "\nTable drop\n";
    }
    if (mysqli_query($conn, sprintf($sql_create_table, $table_name, $schema_of_table))) {
        echo "\nTABLE CREATE successfully\n";
    } else {
        echo "\nTable not created for " . mysqli_error($conn) . "\n";
    }
}

// Transforme un array de multiple dimensions en un array d'une dimension
function reduceDimensionalityArray($multiDimArray)
{
    $singleArray = [];
    foreach ($multiDimArray as $childArray) {
        foreach ($childArray as $value) {
            $singleArray[] = $value;
        };
    }
    return $singleArray;
}
