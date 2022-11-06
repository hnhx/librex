<?php
$config = require "config.php";


if (isset($_REQUEST["save"]) || isset($_REQUEST["reset"])) {
    if (isset($_SERVER["HTTP_COOKIE"])) {
        $cookies = explode(";", $_SERVER["HTTP_COOKIE"]);
        foreach ($cookies as $cookie) {
            $parts = explode("=", $cookie);
            $name = trim($parts[0]);
            setcookie($name, "", time() - 1000);
        }
    }

}

if (isset($_REQUEST["save"])) {
    foreach ($_POST as $key => $value) {
        if (!empty($value)) {
            setcookie($key, $value, time() + (86400 * 90), '/');
            $_COOKIE[$name] = $value;
        }
    }
}

if (isset($_REQUEST["save"]) || isset($_REQUEST["reset"])) {
    header("Location: ./settings.php");
    die();
}

require "misc/header.php";
?>

<title>LibreX - Settings</title>
<body>
<div class="misc-container">
    <h1>Settings</h1>
    <form method="post" enctype="multipart/form-data" autocomplete="off">
        <div>
            <label for="theme">Theme:</label>
            <label>
                <select name="theme">
                    <?php
                    $themes = "<option value=\"dark\">Dark</option>
                        <option value=\"darker\">Darker</option>
                        <option value=\"amoled\">AMOLED</option>
                        <option value=\"light\">Light</option>
                        <option value=\"auto\">Auto</option>
                        <option value=\"nord\">Nord</option>
                        <option value=\"night_owl\">Night Owl</option>
                        <option value=\"discord\">Discord</option>
                        <option value=\"google\">Google Dark</option>
                        <option value=\"startpage\">Startpage Dark</option>
                        <option value=\"gruvbox\">Gruvbox</option>
                        <option value=\"github_night\">GitHub Night</option>";

                    if (isset($_COOKIE["theme"])) {
                        $cookie_theme = $_COOKIE["theme"];
                        $themes = str_replace($cookie_theme . "\"", $cookie_theme . "\" selected", $themes);
                    }

                    echo $themes;
                    ?>
                </select>
            </label>
        </div>
        <div>
            <label>Disable special queries (e.g.: currency conversion)</label>
            <label>
                <input type="checkbox"
                       name="disable_special" <?php echo isset($_COOKIE["disable_special"]) ? "checked" : ""; ?> >
            </label>
        </div>
        <h2>Privacy friendly frontends</h2>
        <p>For an example if you want to view YouTube without getting spied on, click on "Invidious", find the instance
            that is most suitable for you then paste it in (correct format: https://example.com)</p>
        <div class="instances-container">

            <div>
                <a for="invidious" href="https://docs.invidious.io/instances/" target="_blank">Invidious</a>
                <label>
                    <input type="text" name="invidious" placeholder="Replace YouTube" value=
                    <?php echo isset($_COOKIE["invidious"]) ? htmlspecialchars($_COOKIE["invidious"]) : "\"$config->invidious\""; ?>
                    >
                </label>
            </div>

            <div>
                <a for="bibliogram" href="https://git.sr.ht/~cadence/bibliogram-docs/tree/master/docs/Instances.md"
                   target="_blank">Bibliogram</a>
                <label>
                    <input type="text" name="bibliogram" placeholder="Replace Instagram" value=
                    <?php echo isset($_COOKIE["bibliogram"]) ? htmlspecialchars($_COOKIE["bibliogram"]) : "\"$config->bibliogram\""; ?>
                    >
                </label>
            </div>

            <div>
                <a for="nitter" href="https://github.com/zedeus/nitter/wiki/Instances" target="_blank">Nitter</a>
                <label>
                    <input type="text" name="nitter" placeholder="Replace Twitter" value=
                    <?php echo isset($_COOKIE["nitter"]) ? htmlspecialchars($_COOKIE["nitter"]) : "\"$config->nitter\""; ?>
                    >
                </label>
            </div>

            <div>
                <a for="libreddit" href="https://github.com/spikecodes/libreddit" target="_blank">Libreddit</a>
                <label>
                    <input type="text" name="libreddit" placeholder="Replace Reddit" value=
                    <?php echo isset($_COOKIE["libreddit"]) ? htmlspecialchars($_COOKIE["libreddit"]) : "\"$config->libreddit\""; ?>
                    >
                </label>
            </div>

            <div>
                <a for="proxitok" href="https://github.com/pablouser1/ProxiTok/wiki/Public-instances" target="_blank">ProxiTok</a>
                <label>
                    <input type="text" name="proxitok" placeholder="Replace TikTok" value=
                    <?php echo isset($_COOKIE["proxitok"]) ? htmlspecialchars($_COOKIE["proxitok"]) : "\"$config->proxitok\""; ?>
                    >
                </label>
            </div>

            <div>
                <a for="wikiless" href="https://codeberg.org/orenom/wikiless" target="_blank">Wikiless</a>
                <label>
                    <input type="text" name="wikiless" placeholder="Replace Wikipedia" value=
                    <?php echo isset($_COOKIE["wikiless"]) ? htmlspecialchars($_COOKIE["wikiless"]) : "\"$config->wikiless\""; ?>
                    >
                </label>
            </div>
        </div>
        <div>
            <label>Disable frontends</label>
            <label>
                <input type="checkbox"
                       name="disable_frontends" <?php echo isset($_COOKIE["disable_frontends"]) ? "checked" : ""; ?> >
            </label>
        </div>
        <div>
            <button type="submit" name="save" value="1">Save</button>
            <button type="submit" name="reset" value="1">Reset</button>
        </div>
    </form>
</div>

<?php require "misc/footer.php"; ?>
