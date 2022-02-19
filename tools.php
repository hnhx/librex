<?php
    function get_base_url($url)
    {
        $split_url = explode("/", $url);
        $base_url = $split_url[0] . "//" . $split_url[2] . "/";
        return $base_url;
    }

    function better_session_destroy()
    {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    
        session_destroy();
    }

    function check_for_special_search($query)
    {
        $query_lower = strtolower($query);

        // Check for currency convesion
        if (strpos($query_lower, "to"))
        {
            require_once "results/currency.php";
            currency_results($query);
        }
           
        // Check for definition 
        else if (strpos($query_lower, "mean"))
        {
            require_once "results/definition.php";
            definition_results($query);
        }
    }
?>