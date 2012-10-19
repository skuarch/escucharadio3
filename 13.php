<?php

function filterBadCharacters($string) {

    $badCharacters = array(';','\'', '%', '#', '"', '|', '(', ')', '¿', '¡', '\\', '¬');
    $tmp = "";

    for ($i = 0; $i < strlen($string); $i++) {

        for ($e = 0; $e < count($badCharacters); $e++) {           

            if ($string[$i] == $badCharacters[$e]) {
                $i++;
                continue;
            } else {
                $tmp = $tmp . $string[$i];
                break;
            }
        }
    }
    return $tmp;
}

?>
