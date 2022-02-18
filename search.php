
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title> <?php echo $_REQUEST["q"]; ?> - LibreX</title>
        <meta http-equiv="Content-type" content="application/xhtml+xml;charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="A privacy respecting meta search engine."/>
        <link rel="stylesheet" type="text/css" href="static/styles.css"/>
        <link title="LibreX search" type="application/opensearchdescription+xml" href="/opensearch.xml?method=POST" rel="search"/>
    </head>
    <body>
        <form class="small-search-container" method="post">
            <a href="/"><h1>LibreX</h1></a>
            <input type="hidden" name="p" value="0">
            <input type="text" name="q" 
                <?php
                    session_start();

                    $valid_query = true;

                    if (!isset($_REQUEST["q"]))
                        $valid_query = false;
                    else if (1 > strlen($_REQUEST["q"]) || strlen($_REQUEST["q"]) > 256)
                        $valid_query = false;
                    
                    if ($valid_query) 
                    {
                        $query = $_REQUEST["q"];
                        echo "value=\"$query\"";

                        $_SESSION["q"] = trim($query);
                        $_SESSION["p"] = $_REQUEST["p"];
                        $_SESSION["type"] = $_REQUEST["type"];
                    } 
                    else 
                    {
                        header("Location: /");
                        die();
                    }
                ?>
            >
            <br>
            <?php
                if (isset($_REQUEST["type"]))
                    if ($_REQUEST["type"] == "img")
                        echo "<input type=\"hidden\" name=\"type\" value=\"img\"/>";
            ?>
            <button type="submit" style="display:none;"></button>
            <div class="result_change">
                <button name="type" value="text">Text results</button>
                <button name="type" value="img">Image results</button>
            </div>
            
        <hr>
        </form>

        <iframe src="search_frame.php" frameborder="0"></iframe>

        <div class="info-container">
            <a href="/">LibreX</a>
            <a href="https://github.com/hnhx/librex/" target="_blank">Source code &amp; Other instances</a>
            <a href="/donate.xhtml" id="right">Donate ❤️</a>
        </div>
    </body>
</html>