<?php
    function calculator_results($query)
    {
        //  Remove white spaces and invalid math chars
        $query = preg_replace("/\s+/", "", $query);
        $query = str_replace(",", ".", $query);
        $query = preg_replace("[^0-9\.\+\-\*\/\(\)]", "", $query);

        if (preg_match('~^[0-9\.()+\-*\/]+$~', $query)) 
        {
            try 
            {
                $result = stripslashes(@eval("return " . $query . ";"));
            } 
            catch (\Throwable $th) 
            {
                return;
            }
        }

        return [
            "special_response" => [
                "response" => $query . " = </br> <strong>" . $result . "</strong>",
                "source" => "",
            ],
        ];
    }
?>
