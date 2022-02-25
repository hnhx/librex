<?php
    function wikipedia_results($query) 
    {
        require "config.php";
        require_once "misc/tools.php";
        
        $query_encoded = urlencode($query);

        $url = "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts%7Cpageimages&exintro&explaintext&redirects=1&pithumbsize=500&titles=$query_encoded";
        $response = request($url);
        $json_response = json_decode($response, true);

        $first_page = array_values($json_response["query"]["pages"])[0];

        if (!array_key_exists("missing", $first_page))
        {
            $description = substr($first_page["extract"], 0, 250) . "...";
            
            if (strpos($description, "may refer to"))
                return;

            echo "<p class=\"special-result-container\">";

            if (array_key_exists("thumbnail", $first_page))
            {
                $img_src = $first_page["thumbnail"]["source"];
                $url = $first_page["thumbnail"]["source"];
                $image_response = request($url);
                $base64_image = base64_encode($image_response);

                echo "<a href=\"data:image/jpeg;base64,$base64_image\" target=\"_blank\">";
                echo "<img src=\"data:image/jpeg;base64,$base64_image\">";
                echo "</a>";
            } 

            echo "$description";
            echo "<a href=\"https://en.wikipedia.org/wiki/$query\">";
            echo "Wikipedia";
            echo "</a>";

            echo "</p>";
        }
    }
?>