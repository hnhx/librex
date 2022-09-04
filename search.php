<?php require "misc/header.php"; ?>

<title>
<?php
  $query = htmlspecialchars(trim($_REQUEST["q"]));
  echo $query;
?> - LibreX</title>
</head>
    <body>
        <form class="sub-search-container" method="get" autocomplete="off">
            <h1 class="logomobile"><a class="noDecoration" href="./">Libre<span class="X">X</span></a></h1>
            <input type="text" name="q"
                <?php
                    $query_encoded = urlencode($query);

                    if (1 > strlen($query) || strlen($query) > 256)
                    {
                        header("Location: ./");
                        die();
                    }

                    echo "value=\"$query\"";
                ?>
            >
            <br>
            <?php
                $type = isset($_REQUEST["type"]) ? (int) $_REQUEST["type"] : 0;
                echo "<button class=\"hide\" name=\"type\" value=\"$type\"/></button>";
            ?>
            <button type="submit" class="hide"></button>
            <input type="hidden" name="p" value="0">
            <div class="sub-search-button-wrapper">
                <button name="type" value="0"><img src="static/images/text_result.png" alt="text result" />General</button>
                <button name="type" value="1"><img src="static/images/image_result.png" alt="image result" />Images</button>
                <button name="type" value="2"><img src="static/images/video_result.png" alt="video result" />Videos</button>
                <button name="type" value="3"><img src="static/images/torrent_result.png" alt="torrent result" />Torrents</button>
            </div>
        <hr>
        </form>

        <?php
            $config = require "config.php";
            require "misc/tools.php";

            $page = isset($_REQUEST["p"]) ? (int) $_REQUEST["p"] : 0;

            $start_time = microtime(true);
            switch ($type)
            {
                case 0:
                    if (substr($query, 0, 1) == "!" || substr(end(explode(" ", $query)), 0, 1) == "!")
                        check_ddg_bang($query);
                    require "engines/google/text.php";
                    $results = get_text_results($query, $page);
                    print_elapsed_time($start_time);
                    print_text_results($results);
                    break;

                case 1:
                    require "engines/qwant/image.php";
                    $results = get_image_results($query_encoded, $page);
                    print_elapsed_time($start_time);
                    print_image_results($results);
                    break;

                case 2:
                    require "engines/brave/video.php";
                    $results = get_video_results($query_encoded);
                    print_elapsed_time($start_time);
                    print_video_results($results);
                    break;

                case 3:
                    if ($config->disable_bittorent_search)
                        echo "<p class=\"text-result-container\">The host disabled this feature! :C</p>";
                    else
                    {
                        require "engines/bittorrent/merge.php";
                        $results = get_merged_torrent_results($query_encoded);
                        print_elapsed_time($start_time);
                        print_merged_torrent_results($results);
                        break;
                    }

                    break;

                default:
                    require "engines/google/text.php";
                    $results = get_text_results($query_encoded, $page);
                    print_text_results($results);
                    print_elapsed_time($start_time);
                    break;
            }


            if (2 > $type)
            {
                echo "<div class=\"next-page-button-wrapper\">";

                    if ($page != 0)
                    {
                        print_next_page_button("&lt;&lt;", 0, $query, $type);
                        print_next_page_button("&lt;", $page - 10, $query, $type);
                    }

                    for ($i=$page / 10; $page / 10 + 10 > $i; $i++)
                        print_next_page_button($i + 1, $i * 10, $query, $type);

                    print_next_page_button("&gt;", $page + 10, $query, $type);

                echo "</div>";
            }
        ?>

<?php require "misc/footer.php"; ?>
