<?php
    function get_base_url($url)
    {
        $split_url = explode("/", $url);
        $base_url = $split_url[0] . "//" . $split_url[2] . "/";
        return $base_url;
    }


    function print_text_results($results) 
    {
        global $query , $page;

        if ($page == 0)
            check_for_special_search($query);
        
        foreach($results as $result)
        {
            $title = $result["title"];
            $url = $result["url"];
            $base_url = $result["base_url"];
            $description = $result["description"];

            echo "<div class=\"result-container\">";
            echo "<a href=\"$url\">";
            echo "$base_url";
            echo "<h2>$title</h2>";
            echo "</a>";
            echo "<span>$description</span>";
            echo "</div>";
        }
    }

    function print_image_results($results)
    {
        echo "<div class=\"image-result-container\">";

            foreach($results as $result)
            {
                $src = $result["base64"];
                $alt = $result["alt"];

                echo "<a title=\"$alt\" href=\"data:image/jpeg;base64,$src\" target=\"_blank\">";
                echo "<img src=\"data:image/jpeg;base64,$src\" width=\"350\" height=\"200\">";
                echo "</a>";
            }

            echo "</div>";
    }

    function print_video_results($results)
    {
            foreach($results as $result)
            {
                $title = $result["title"];
                $url = $result["url"];
                $base_url = $result["base_url"];

                echo "<div class=\"result-container\">";
                echo "<a href=\"$url\">";
                echo "$base_url";
                echo "<h2>$title</h2>";
                echo "</a>";
                echo "</div>";
            }
    }

    function print_next_page_button($page, $button_val, $q, $type) 
    {
        echo "<form id=\"page\" action=\"search.php\" target=\"_top\" method=\"post\" enctype=\"multipart/form-data\" autocomplete=\"off\">";
        echo "<input type=\"hidden\" name=\"p\" value=\"" . $page . "\" />";
        echo "<input type=\"hidden\" name=\"q\" value=\"$q\" />";
        echo "<input type=\"hidden\" name=\"type\" value=\"$type\" />";
        echo "<button type=\"submit\">$button_val</button>";
        echo "</form>"; 
    }
?>