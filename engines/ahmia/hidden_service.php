<?php
    function get_hidden_service_results($query)
    {
        global $config;

        $url = "https://ahmia.fi/search/?q=$query";
        $response = request($url);
        $xpath = get_xpath($response);

        $results = array();

        foreach($xpath->query("//ol[@class='searchResults']//li[@class='result']") as $result)
        {
            $url = "http://" . $xpath->evaluate(".//cite", $result)[0]->textContent;
            $title = remove_special($xpath->evaluate(".//h4", $result)[0]->textContent);
            $description = $xpath->evaluate(".//p", $result)[0]->textContent;

            array_push($results,
                array (
                    "title" => $title ? htmlspecialchars($title) : "No description provided",
                    "url" =>  htmlspecialchars($url),
                    "base_url" => htmlspecialchars(get_base_url($url)),
                    "description" => htmlspecialchars($description)
                )
            );
        }

        return $results;
    }

    function print_hidden_service_results($results)
    {
        echo "<div class=\"text-result-container\">";

        foreach($results as $result)
        {
            $title = $result["title"];
            $url = $result["url"];
            $base_url = $result["base_url"];
            $description = $result["description"];

            echo "<div class=\"text-result-wrapper\">";
            echo "<a href=\"$url\">";
            echo "$base_url";
            echo "<h2>$title</h2>";
            echo "</a>";
            echo "<span>$description</span>";
            echo "</div>";
        }

        echo "</div>";
    }
?>
