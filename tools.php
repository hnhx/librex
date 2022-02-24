<?php
    function get_base_url($url)
    {
        $split_url = explode("/", $url);
        $base_url = $split_url[0] . "//" . $split_url[2] . "/";
        return $base_url;
    }
?>