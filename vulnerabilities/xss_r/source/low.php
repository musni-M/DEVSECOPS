<?php

// Is there any input?
if (array_key_exists("name", $_GET) && $_GET['name'] != NULL) {

    // Encode untrusted input before rendering it in HTML
    $safe_name = htmlspecialchars(
        $_GET['name'],
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );

    // Feedback for end user
    $html .= '<pre>Hello ' . $safe_name . '</pre>';
}

?>
