<?php
    function image_results($xpath) 
    {
        require "config.php";

        $mh = curl_multi_init();
        $chs = $alts = $results = array();

        foreach($xpath->query("//img[@data-src]") as $image)
        {       
                $alt = $image->getAttribute("alt");
                $src = $image->getAttribute("data-src");

                if (!empty($alt)) 
                {
                    $ch = curl_init($src);
                    curl_setopt_array($ch, $config_curl_settings);
                    array_push($chs, $ch);
                    curl_multi_add_handle($mh, $ch);

                    array_push($alts, $alt);
                }
        }

        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        for ($i=0; count($chs)>$i; $i++)
        {
            $img_base64 = base64_encode(curl_multi_getcontent($chs[$i]));
            array_push($results, 
                array (
                    "base64" => $img_base64,
                    "alt" => $alts[$i]
                )
            );
        }

        return $results;
    }
?>