<?php

function sanitize($string) {
    $cleanstring = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    return $cleanstring;
}

function desanitize($string) {
    $oldstring = htmlspecialchars_decode($string, ENT_QUOTES, 'UTF-8');
    return $oldstring;
}

?>