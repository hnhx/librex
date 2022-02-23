<?php
    function wikipedia_results($query) 
    {
        require "config.php";
        
        $query_encoded = urlencode($query);

        $mh = curl_multi_init();

        $ch_desc = curl_init("https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro&explaintext&redirects=1&titles=$query_encoded");
        curl_setopt_array($ch_desc, $config_curl_settings);
        curl_multi_add_handle($mh, $ch_desc);

        $ch_image = curl_init("https://en.wikipedia.org/w/api.php?action=query&titles=$query_encoded&prop=pageimages&format=json&pithumbsize=1000");
        curl_setopt_array($ch_image, $config_curl_settings);
        curl_multi_add_handle($mh, $ch_image);

        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        $json_response_desc = json_decode(curl_multi_getcontent($ch_desc), true);
        $json_response_image = json_decode(curl_multi_getcontent($ch_image), true);

        $first_page_desc = array_values($json_response_desc["query"]["pages"])[0];
        $first_page_image = array_values($json_response_image["query"]["pages"])[0];

        if (!array_key_exists("missing", $first_page_desc))
        {
            $description = substr($first_page_desc["extract"], 0, 250) . "...";
            
            if (strpos($description, "may refer to"))
                return;

            echo "<p id=\"special-result\">";

            if (array_key_exists("thumbnail", $first_page_image))
            {
                $img_src = $first_page_image["thumbnail"]["source"];
                $ch_image = curl_init($first_page_image["thumbnail"]["source"]);
                curl_setopt_array($ch_image, $config_curl_settings);
                $image_response = curl_exec($ch_image);
                $base64_image = base64_encode($image_response);

                echo "<a href=\"data:image/jpeg;base64,$base64_image\" target=\"_blank\">";
                echo "<img src=\"data:image/jpeg;base64,$base64_image\" id=\"wiki-image\">";
                echo "</a>";
            } 

            echo "$description";
            echo "<a id=\"wiki-link\" href=\"https://en.wikipedia.org/wiki/$query\">";
            echo "Wikipedia";
            echo "</a>";

            echo "</p>";
        }
    }
?>