<?php
    header('Content-Type: application/json');
    
    require "fetch.php";

    $query = $_REQUEST["q"];
    $page = (int) $_REQUEST["p"] * 10;
    $type = $_REQUEST["img_search"] == "true" ? true : false;

    $results = fetch_results($query, $page, $type);

    echo json_encode($results, true);
?>