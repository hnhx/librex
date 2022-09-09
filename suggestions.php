<?php
    $config = require "config.php";
    require "engines/google/suggestions.php";

    header('Content-Type: application/x-suggestions+json');
    header('Content-Disposition: attachment; filename="suggestions.json"');

    $q = isset($_REQUEST['q']) ? htmlspecialchars(trim($_REQUEST["q"])) : '';
    $result = get_suggestions_results($q);
    echo print_suggestions_results($result, $q);
