<?php require "misc/header.php"; ?>

    <title>LibreX</title>
    </head>
    <body>
        <form class="search-container" action="search.php" method="get" autocomplete="off">
                <h1>Libre<span class="X">X</span></h1>
                <input type="text" name="q"/>
                <input type="hidden" name="p" value="0"/>
                <input type="hidden" name="type" value="0"/>
                <input type="submit" class="hide"/>
                <div class="search-button-wrapper">
                    <button name="type" value="0" type="submit">Search with LibreX</button>
                    <button name="type" value="3" type="submit">Search torrents with LibreX</button>
                </div>
        </form>
        <style>.footer-container{position:fixed;}</style>

<?php require "misc/footer.php"; ?>
