<?php
if( isset( $_POST[ 'Submit' ]  ) ) {
    $target = $_REQUEST[ 'ip' ];

    // FIX: Validate that input is a real IP address
    if( filter_var( $target, FILTER_VALIDATE_IP ) === false ) {
        echo "<pre>Error: Please enter a valid IP address.</pre>";
        return;
    }

    // FIX: Escape the argument before passing to shell
    $safe_target = escapeshellarg( $target );

    if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
        $cmd = shell_exec( 'ping  ' . $safe_target );
    }
    else {
        $cmd = shell_exec( 'ping  -c 4 ' . $safe_target );
    }

    echo "<pre>{$cmd}</pre>";
}
?>
