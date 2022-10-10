<?php
    //Connect to database
    require 'database.php';
    $returnData = array();

    //Get all data from tests
    $result = $mysqli_conection->query("SELECT * FROM tests");

    //Bind data to return array
    while ($row = $result->fetch_assoc())
        $returnData[] = $row;

    $result -> free_result();
    $mysqli_conection -> close();
        
    //Encode to JSON
    echo json_encode($returnData);
?>