<?php
    function definition_results($query) 
    {
        require "config.php";
        
        $split_query = explode(" ", $query);
        
        if (count($split_query) >= 2)
        {
            $reversed_split_q = array_reverse($split_query);
            $word_to_define = $reversed_split_q[1];

            $ch = curl_init("https://api.dictionaryapi.dev/api/v2/entries/en/$word_to_define");
            curl_setopt_array($ch, $config_curl_settings);
            $response = curl_exec($ch);
            $json_response = json_decode($response, true);

            if (!array_key_exists("title", $json_response))
            {
                $definition = $json_response[0]["meanings"][0]["definitions"][0]["definition"];

                echo "<p id=\"special-result\">";
                echo "$word_to_define meaning<br/>";
                echo "<br/>" . $definition . "<br/>";
                echo "</p>";
            }
        }
    }
?>