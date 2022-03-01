<?php require "static/header.html"; ?>

    <title>LibreX</title>
    </head>
    <body>
        <form class="search-container" action="search.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <h1>Libre<span style="color:#bd93f9;">X</span></h1>
                <input type="text" name="q"/>
                <input type="hidden" name="p" value="0"/>
                <input type="hidden" name="type" value="0"/>
                <input type="submit" style="display:none"/>
                <div class="search-button-wrapper">
                    <button name="type" value="0" type="submit">Search with LibreX</button>
                    <button name="type" value="3" type="submit">Search torrents with LibreX</button>
                </div>
        </form>

<?php require "static/footer.html"; ?>