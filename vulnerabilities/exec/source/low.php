<?php

if( isset( $_POST[ 'Submit' ] ) ) {
    // Get input
    $target = trim( $_REQUEST[ 'ip' ] );

    // FIX 1: Allow only a real IP address (rejects ";", "&&", "|", spaces, etc.)
    if( filter_var( $target, FILTER_VALIDATE_IP ) === false ) {
        $html .= '<pre>Error: Please enter a valid IP address.</pre>';
        return;
    }

    // FIX 2: Escape the argument as defence in depth
    $safe_target = escapeshellarg( $target );

    // Determine OS and execute the ping command.
    if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
        // Windows
        // nosemgrep: php.lang.security.exec-use.exec-use -- input validated by FILTER_VALIDATE_IP and escaped with escapeshellarg()
        $cmd = shell_exec( 'ping ' . $safe_target );
    } else {
        // *nix
        // nosemgrep: php.lang.security.exec-use.exec-use -- input validated by FILTER_VALIDATE_IP and escaped with escapeshellarg()
        $cmd = shell_exec( 'ping -c 4 ' . $safe_target );
    }

    // Feedback for the end user
    $html .= "<pre>{$cmd}</pre>";
}

?>
