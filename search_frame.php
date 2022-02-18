
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
    <meta http-equiv="Content-type" content="application/xhtml+xml;charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="static/styles.css"/>
    </head>
    <body>
        <?php
            function print_next_pages($page, $button_val, $q) {
                echo "<form id=\"page\" action=\"search.php\" target=\"_top\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"p\" value=\"" . $page . "\" />";
                echo "<input type=\"hidden\" name=\"q\" value=\"$q\" />";
                echo "<button type=\"submit\">$button_val</button>";
                echo "</form>"; 
            }

            session_start();

            require("fetch.php");

            $query = $_SESSION["q"];
            $page = (int) htmlspecialchars($_SESSION["p"]);
            $search_type = $_SESSION["type"] == "img" ? true : false;

            $start_time = microtime(true);
            $results = fetch_results($query, $page, $search_type);
            $end_time = number_format(microtime(true) - $start_time, 2, '.', '');

            echo "<p id=\"time\">Fetched the results in $end_time seconds</p>";
            
            if ($_SESSION["type"] != "img") 
            {
                special_search($query);
                
                foreach($results as $result)
                {
                    $title = $result["title"];
                    $url = $result["url"];
                    $base_url = $result["base_url"];

                    echo "<div class=\"result-container\">";
                    echo "<a href=\"$url\" target=\"_blank\">";
                    echo "$base_url";
                    echo "<h2>$title</h2>";
                    echo "</a>";
                    echo "</div>";
                }
                
                echo "<div class=\"page-container\">";

                if ($page != 0) 
                {
                    print_next_pages(0, "&lt;&lt;", $query);
                    print_next_pages($page - 10, "&lt;", $query);
                }
                
                for ($i=$page / 10; $page / 10 + 10>$i; $i++)
                {
                    $page_input = $i * 10;
                    $page_button = $i + 1;
                    
                    print_next_pages($page_input, $page_button, $query);
                }

                print_next_pages($page + 10, "&gt;", $query);

                echo "</div>";
            }
            else
            {
                foreach($results as $result)
                {
                    $src = $result["base64"];
                    $alt = $result["alt"];
                    echo "<a href=\"data:image/jpeg;base64,$src\" target=\"_blank\"><img src=\"data:image/jpeg;base64,$src\"></a>";
                }
            }

            require "session_destroy.php";

            
        ?>
    </body>
</html>