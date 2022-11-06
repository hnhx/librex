<div class="footer-container">
    <a href="./">LibreX</a>
    <a href="https://github.com/hnhx/librex/" target="_blank">Source &amp; Instance list</a>
    <a href="./settings.php">Settings</a>
    <a href="./api.php" target="_blank">API</a>
    <a href="./donate.php">Donate ❤️</a>
</div>
<div class="git-container">
    <?php
    $hash = file_get_contents(".git/refs/heads/main");
    echo "<a href=\"https://github.com/vars1ty/librex/commit/$hash\" target=\"_blank\">Latest commit: $hash</a>";
    ?>
</div>