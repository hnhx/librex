<?php
                $config = require "config.php";


                if (isset($_REQUEST["save"]) || isset($_REQUEST["reset"]))
                {
                    if (isset($_SERVER["HTTP_COOKIE"]))
                    {
                            $cookies = explode(";", $_SERVER["HTTP_COOKIE"]);
                            foreach($cookies as $cookie)
                            {
                                $parts = explode("=", $cookie);
                                $name = trim($parts[0]);
                                setcookie($name, "", time() - 1000);
                            }
                    }

                }

                if (isset($_REQUEST["save"]))
                {
                    foreach($_POST as $key=>$value){
                        if (!empty($value))
                        {
                            setcookie($key, $value, time() + (86400 * 90), '/');
                            $_COOKIE[$name] = $value;
                        }
                    }
                }

                if (isset($_REQUEST["save"]) || isset($_REQUEST["reset"]))
                {
                    header("Location: ./settings.php");
                    die();
                }

                require "misc/header.php";
?>

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
                    <option value=\"darker\">Darker</option>
                    <option value=\"amoled\">AMOLED</option>
                    <option value=\"light\">Light</option>
                    <option value=\"auto\">Auto</option>
					<option value=\"dracula\">Dracula</option>
                    <option value=\"nord\">Nord</option>
                    <option value=\"night_owl\">Night Owl</option>
                    <option value=\"discord\">Discord</option>
                    <option value=\"google\">Google Dark</option>
                    <option value=\"startpage\">Startpage Dark</option>
                    <option value=\"gruvbox\">Gruvbox</option>
                    <option value=\"github_night\">GitHub Night</option>";

                    if (isset($_COOKIE["theme"]))
                    {
                        $cookie_theme = $_COOKIE["theme"];
                        $themes = str_replace($cookie_theme . "\"", $cookie_theme . "\" selected", $themes);
                    }

                    echo $themes;
                ?>
                </select>
                </div>
                <div>
                    <label>Disable special queries (e.g.: currency conversion)</label>
                    <input type="checkbox" name="disable_special" <?php echo isset($_COOKIE["disable_special"]) ? "checked"  : ""; ?> >
                </div>
                <h2>Privacy friendly frontends</h2>
                <p>For an example if you want to view YouTube without getting spied on, click on "Invidious", find the instance that is most suitable for you then paste it in (correct format: https://example.com)</p>
                <div class="instances-container">
                      <?php

                            $frontends = array(
                                "invidious" => array("https://docs.invidious.io/instances/", "YouTube"),
                                "bibliogram" => array("https://git.sr.ht/~cadence/bibliogram-docs/tree/master/docs/Instances.md", "Instagram"),
                                "nitter" => array("https://github.com/zedeus/nitter/wiki/Instances", "Twitter"),
                                "scribe" => array("https://git.sr.ht/~edwardloveall/scribe/tree/main/docs/instances.md", "Medium),
                                "libreddit" => array("https://github.com/spikecodes/libreddit", "Reddit"),
                                "proxitok" => array("https://github.com/pablouser1/ProxiTok/wiki/Public-instances", "TikTok"),
                                "wikiless" => array("https://codeberg.org/orenom/wikiless", "Wikipedia"),
                                "quetre" => array("https://github.com/zyachel/quetre", "Quora"),
                                "libremdb" => array("https://github.com/zyachel/libremdb", "IMDb"),
                                "breezewiki" => array("https://gitdab.com/cadence/breezewiki", "Fandom")
                            );

                           foreach($frontends as $frontend => $info)
                           {
                                echo "<div>";
                                echo "<a for=\"$frontend\" href=\"" . $info[0] . "\" target=\"_blank\">" . ucfirst($frontend) . "</a>";
                                echo "<input type=\"text\" name=\"$frontend\" placeholder=\"Replace " . $info[1] . "\" value=";
                                echo isset($_COOKIE["$frontend"]) ? htmlspecialchars($_COOKIE["$frontend"])  : json_decode(json_encode($config), true)[$frontend];
                                echo ">";
                                echo "</div>";
                           }
                      ?>
                </div>
                <div>
                    <label>Disable frontends</label>
                    <input type="checkbox" name="disable_frontends" <?php echo isset($_COOKIE["disable_frontends"]) ? "checked"  : ""; ?> >
                </div>
                <div>
                  <button type="submit" name="save" value="1">Save</button>
                  <button type="submit" name="reset" value="1">Reset</button>
                </div>
            </form>
        </div>

<?php require "misc/footer.php"; ?>
