<?php
    function check_for_special_search($query)
    {
        $query_lower = strtolower($query);

        if (strpos($query_lower, "to"))
        {
            require_once "results/special/currency.php";
            currency_results($query);
        }
        else if (strpos($query_lower, "mean"))
        {
            require_once "results/special/definition.php";
            definition_results($query);
        }
        else if (3 > count(explode(" ", $query))) // long queries usually wont return a wiki result thats why this check exists
        {
            require_once "results/special/wikipedia.php";
            wikipedia_results($query_lower);
            return;
        }
    }
?>