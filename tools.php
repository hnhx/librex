<?php
    function get_base_url($url)
    {
        $split_url = explode("/", $url);
        $base_url = $split_url[0] . "//" . $split_url[2] . "/";
        return $base_url;
    }

    function check_for_special_search($query)
    {
        $query_lower = strtolower($query);

        if (strpos($query_lower, "to"))
        {
            require_once "results/currency.php";
            currency_results($query);
        }
        else if (strpos($query_lower, "mean"))
        {
            require_once "results/definition.php";
            definition_results($query);
        }
        else if (5 > count(explode(" ", $query))) // long queries usually wont return a wiki result thats why this check exists
        {
            require_once "results/wikipedia.php";
            wikipedia_results($query_lower);
            return;
        }
    }
?>