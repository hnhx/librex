<?php 
    require "static/header.php";
    require "config.php";
?>

    <title>LibreX - Settings</title>
    </head>
    <body class="settings-container">
        <p>Since LibreX doesn't use any cookies for better user privacy, settings are passed trough query parameters.</p>

        <form method="post" enctype="multipart/form-data" autocomplete="off">
            <label for="theme">Theme:</label>
            <select name="theme">
                <option value="dark">Dark</option>
                <option value="light">Light</option>
                <option value="nord">Nord</option>
                <option value="night_owl">Night Owl</option>
                <option value="discord">Discord</option>
            </select>
            <br><br>
            <p>Privacy friendly frontends</p>
            <div class="instances-container">
                <label for="invidious">Invidious:</label>
                <input type="text" name="invidious">

                <br><br>
                <label for="bibliogram">Bibliogram:</label>
                <input type="text" name="bibliogram">

                <br><br>
                <label for="nitter">Nitter:</label>
                <input type="text" name="nitter">

                <br><br>
                <label for="libreddit">Libreddit:</label>
                <input type="text" name="libreddit">
            </div>
            <br>
            <button type="submit" name="save" value="1">Save</button>
        </form>


        <?php
            if (isset($_REQUEST["save"]))
            {
                $url = $_SERVER["HTTP_HOST"] . "/search.php?q=test&theme=" . $_REQUEST["theme"];

                if (!empty($_REQUEST["invidious"]))
                    $url .= "&invidious=" . $_REQUEST["invidious"];

                if (!empty($_REQUEST["bibliogram"]))
                    $url .= "&bibliogram=" . $_REQUEST["bibliogram"];

                if (!empty($_REQUEST["nitter"]))
                    $url .= "&nitter=" . $_REQUEST["nitter"];

                if (!empty($_REQUEST["libreddit"]))
                    $url .= "&nitter=" . $_REQUEST["libreddit"];

                echo "<a href=\"http://$url\" target=\"_blank\"><p>";
                echo  $url;
                echo "</p>";
            }
        ?>

<?php require "static/footer.html"; ?>