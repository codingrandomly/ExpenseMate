<?php
function sanitize_input($data) {
    $data = trim($data);             
    $data = stripslashes($data);     
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); 
    return $data;
}

function sanitize_array($array) {
    $clean = [];
    foreach ($array as $key => $value) {
        $clean[$key] = is_array($value) ? sanitize_array($value) : sanitize_input($value);
    }
    return $clean;
}

?>