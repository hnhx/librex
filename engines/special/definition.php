<?php
    function definition_results($query, $response) 
    {
            require "config.php";
            require_once "misc/tools.php";
        
            $split_query = explode(" ", $query);
            $reversed_split_q = array_reverse($split_query);
            $word_to_define = $reversed_split_q[1];

            $json_response = json_decode($response, true);

            if (!array_key_exists("title", $json_response))
            {
                $definition = $json_response[0]["meanings"][0]["definitions"][0]["definition"];

                echo "<p class=\"special-result-container\">";
                echo "$word_to_define meaning<br/>";
                echo "<br/>" . $definition . "<br/>";
                echo "<a href=\"https://dictionaryapi.dev/\" target=\"_blank\">dictionaryapi.dev</a>";
                echo "</p>";
            }
        
    }
?>