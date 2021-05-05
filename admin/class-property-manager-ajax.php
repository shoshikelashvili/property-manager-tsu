<?php

//Not using in anything ATM
class Property_Manager_Ajax {

    public function example_ajax_request()
	{
		if ( isset($_REQUEST) ) {
            error_log('logging media upload initial');

			$image = $_REQUEST['base64'];
            $title = $_REQUEST['filename'];
            
            $postId = $_REQUEST['postId'];

            $directory = "/".date('Y')."/".date('m')."/";
            $wp_upload_dir = wp_upload_dir();
            $data = base64_decode($image);
            $filename = "IMG_".time().".png";
            //$fileurl = $wp_upload_dir['url'] . '/' . basename( $filename );
            $fileurl = "../wp-content/uploads".$directory.$filename;

            $filetype = wp_check_filetype( basename( $fileurl), null );

            file_put_contents($fileurl, $data);

                $attachment = array(
                    'guid' => $wp_upload_dir['url'] . '/' . basename( $fileurl ),
                    'post_mime_type' => $filetype['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', basename($fileurl)),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
            //  print_r($attachment);
            //echo "<br>file name :  $fileurl";
                $attach_id = wp_insert_attachment( $attachment, $fileurl ,$postId);
            require_once('../wp-admin/includes/image.php' );

            // Generate the metadata for the attachment, and update the database record.
            $attach_data = wp_generate_attachment_metadata( $attach_id, $fileurl );
            wp_update_attachment_metadata( $attach_id, $attach_data );
		}
	
		// Always die in functions echoing AJAX content
	   die();
	}
}