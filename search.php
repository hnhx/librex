
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

                    $query = trim($_REQUEST["q"]);

                    if (1 > strlen($query) || strlen($query) > 256)
                    {
                        header("Location: /");
                        die();
                    } 
 
                    echo "value=\"$query\"";

                    $_SESSION["q"] = $query;
                    $_SESSION["p"] = $_REQUEST["p"];
                    $_SESSION["type"] = $_REQUEST["type"];

                ?>
            >
            <br>
            <?php
                $type = $_REQUEST["type"];
                echo "<input type=\"hidden\" name=\"type\" value=\"$type\"/>";
            ?>
            <button type="submit" style="display:none;"></button>
            <div class="result_change">
                <button name="type" value="0">Text results</button>
                <button name="type" value="1">Image results</button>
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