    <?php require "static/header.php"; ?>

    <title>LibreX - Settings</title>
    </head>
    <body>
        <div class="settings-container">
            <h1>Settings</h1>
            <form method="post" enctype="multipart/form-data" autocomplete="off">
                <label for="theme">Theme:</label>
                <select name="theme">
                <?php
                    
                    $themes = "<option value=\"auto\">Auto</option>
                     <option value=\"dark\">Dark</option>
                    <option value=\"light\">Light</option>
                    <option value=\"nord\">Nord</option>
                    <option value=\"night_owl\">Night Owl</option>
                    <option value=\"discord\">Discord</option>";

                    if (isset($_COOKIE["theme"]))
                    {                  
                        $cookie_theme = $_COOKIE["theme"];
                        $themes = str_replace($cookie_theme . "\"", $cookie_theme . "\" selected", $themes);
                    }

                    echo $themes;
                ?>
                </select>
                <br><br>
                <h2>Privacy friendly frontends</h2>
                <p>Replace popular sites with privacy friendly frontends</p>
                <div class="instances-container">
                    <a for="invidious" href="https://docs.invidious.io/Invidious-Instances/" target="_blank">Invidious</a>
                    <input type="text" name="invidious" placeholder="e.g.: https://yewtu.be" value=
                        <?php echo isset($_COOKIE["invidious"]) ? $_COOKIE["invidious"]  : "\"\""; ?>
                    >

                    <br><br>
                    <a for="bibliogram" href="https://git.sr.ht/~cadence/bibliogram-docs/tree/master/docs/Instances.md" target="_blank">Bibliogram</a>
                    <input type="text" name="bibliogram"  value=
                        <?php echo isset($_COOKIE["bibliogram"]) ? $_COOKIE["bibliogram"]  : "\"\""; ?>
                    >

                    <br><br>
                    <a for="nitter" href="https://github.com/zedeus/nitter/wiki/Instances" target="_blank">Nitter</a>
                    <input type="text" name="nitter" value=
                        <?php echo isset($_COOKIE["nitter"]) ? $_COOKIE["nitter"]  : "\"\""; ?>
                    >

                    <br><br>
                    <a for="libreddit" href=" https://github.com/spikecodes/libreddit" target="_blank">Libreddit</a>
                    <input type="text" name="libreddit" value=
                        <?php echo isset($_COOKIE["libreddit"]) ? $_COOKIE["libreddit"]  : "\"\""; ?>
                    >
                </div>
                <br>
                <button type="submit" name="save" value="1">Save</button>
                <button type="submit" name="reset" value="1">Reset</button>
            </form>


            <?php
                if (isset($_REQUEST["save"]))
                {
                    if (!empty($_REQUEST["invidious"]))
                        setcookie("invidious", $_REQUEST["invidious"]);

                    if (!empty($_REQUEST["bibliogram"]))
                        setcookie("bibliogram", $_REQUEST["bibliogram"]);

                    if (!empty($_REQUEST["nitter"]))
                        setcookie("nitter", $_REQUEST["nitter"]);

                    if (!empty($_REQUEST["libreddit"]))
                        setcookie("libreddit", $_REQUEST["libreddit"]);

                    setcookie("theme", $_REQUEST["theme"]);

                    header("Location: /settings.php");
                    die();
                }
                else if (isset($_REQUEST["reset"]))
                {
                    if (isset($_SERVER['HTTP_COOKIE'])) {
                        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                        foreach($cookies as $cookie) {
                            $parts = explode('=', $cookie);
                            $name = trim($parts[0]);
                            setcookie($name, '', time()-1000);
                            setcookie($name, '', time()-1000, '/');
                        }

                        header("Location: /settings.php");
                        die();
                    }
                }
            ?>
        </div>

<?php require "static/footer.html"; ?>
