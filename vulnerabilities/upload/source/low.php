<?php

if( isset( $_POST[ 'Upload' ] ) ) {

        $target_path = DVWA_WEB_PAGE_TO_ROOT . "hackable/uploads/";

        $filename = basename( $_FILES[ 'uploaded' ][ 'name' ] );
        $tmp_name = $_FILES[ 'uploaded' ][ 'tmp_name' ];

        // First check whether upload itself succeeded
        if ( $_FILES['uploaded']['error'] !== UPLOAD_ERR_OK || empty($tmp_name) ) {
                $html .= '<pre>Upload failed.</pre>';
                return;
        }

        $allowed_extensions = array( 'jpg', 'jpeg', 'png', 'gif' );
        $extension = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );

        $finfo = finfo_open( FILEINFO_MIME_TYPE );
        $mime_type = finfo_file( $finfo, $tmp_name );

        $allowed_mime_types = array(
                'image/jpeg',
                'image/png',
                'image/gif'
        );

        if( !in_array( $extension, $allowed_extensions, true ) ||
            !in_array( $mime_type, $allowed_mime_types, true ) ||
            getimagesize( $tmp_name ) === false ) {

                $html .= '<pre>Invalid file type. Only valid image files are allowed.</pre>';
        }
        else {
                $target_path .= $filename;

                if( !move_uploaded_file( $tmp_name, $target_path ) ) {
                        $html .= '<pre>Your image was not uploaded.</pre>';
                }
                else {
                        $html .= "<pre>{$target_path} successfully uploaded!</pre>";
                }
        }
}

?>
