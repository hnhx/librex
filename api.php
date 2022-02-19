<?php
    header('Content-Type: application/json');
    
    require "google.php";

    $query = $_REQUEST["q"];
    $page = (int) $_REQUEST["p"] * 10;
    $type = (int) $_REQUEST["type"];

    $results = get_google_results($query, $page, $type);

    echo json_encode($results, true);
?>