<?php require "misc/header.php"; ?>

    <title>LibreX - Settings</title>
    </head>
    <body>
        <div class="misc-container">
            <h1>Settings</h1>
            <form method="post" enctype="multipart/form-data" autocomplete="off">
              <div>
                <label for="theme">Theme:</label>
                <select name="theme">
                <?php

                    $themes = "<option value=\"dark\">Dark</option>
                    <option value=\"light\">Light</option>
                    <option value=\"auto\">Auto</option>
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
              </div>
                <h2>Privacy friendly frontends</h2>
                <p>For an example if you want to view YouTube without getting spied on, click on "Invidious", find the instance that is most suitable for you then paste it in (correct format: https://url.domain)</p>
                <div class="instances-container">

                      <div>
                        <a for="invidious" href="https://docs.invidious.io/Invidious-Instances/" target="_blank">Invidious</a>
                        <input type="text" name="invidious" placeholder="Replace YouTube" value=
                            <?php echo isset($_COOKIE["invidious"]) ? $_COOKIE["invidious"]  : "\"\""; ?>
                        >
                      </div>

                      <div>
                        <a for="bibliogram" href="https://git.sr.ht/~cadence/bibliogram-docs/tree/master/docs/Instances.md" target="_blank">Bibliogram</a>
                        <input type="text" name="bibliogram" placeholder="Replace Instagram" value=
                            <?php echo isset($_COOKIE["bibliogram"]) ? $_COOKIE["bibliogram"]  : "\"\""; ?>
                        >
                      </div>

                      <div>
                        <a for="nitter" href="https://github.com/zedeus/nitter/wiki/Instances" target="_blank">Nitter</a>
                        <input type="text" name="nitter" placeholder="Replace Twitter" value=
                            <?php echo isset($_COOKIE["nitter"]) ? $_COOKIE["nitter"]  : "\"\""; ?>
                        >
                      </div>

                      <div>
                        <a for="libreddit" href="https://github.com/spikecodes/libreddit" target="_blank">Libreddit</a>
                        <input type="text" name="libreddit" placeholder="Replace Reddit" value=
                            <?php echo isset($_COOKIE["libreddit"]) ? $_COOKIE["libreddit"]  : "\"\""; ?>
                        >
                      </div>
                </div>
                <div>
                  <button type="submit" name="save" value="1">Save</button>
                  <button type="submit" name="reset" value="1">Reset</button>
                </div>
            </form>


            <?php
                if (isset($_REQUEST["save"]))
                {
                    if (!empty($_REQUEST["invidious"]))
                        setcookie("invidious", $_REQUEST["invidious"], time() + (86400 * 90));

                    if (!empty($_REQUEST["bibliogram"]))
                        setcookie("bibliogram", $_REQUEST["bibliogram"], time() + (86400 * 90));

                    if (!empty($_REQUEST["nitter"]))
                        setcookie("nitter", $_REQUEST["nitter"], time() + (86400 * 90));

                    if (!empty($_REQUEST["libreddit"]))
                        setcookie("libreddit", $_REQUEST["libreddit"], time() + (86400 * 90));


                    setcookie("theme", $_REQUEST["theme"], time() + (86400 * 90));

                    header("Location: /settings.php");
                    die();
                }
                else if (isset($_REQUEST["reset"]))
                {
                    if (isset($_SERVER["HTTP_COOKIE"])) {
                        $cookies = explode(";", $_SERVER["HTTP_COOKIE"]);
                        foreach($cookies as $cookie) {
                            $parts = explode("=", $cookie);
                            $name = trim($parts[0]);
                            setcookie($name, "", time()-1000);
                            setcookie($name, "", time()-1000, "/");
                        }

                        header("Location: /settings.php");
                        die();
                    }
                }
            ?>
        </div>

<?php require "misc/footer.php"; ?>
