<?php
/*
Plugin Name: PlugNedit
Plugin URI: Http://plugnedit.com
Version: 4.4.0
Author: JavaScript Tech
Description:PlugNedit <strong>Drag N Drop Visual Editor</strong> and web page builder for WordPress is a tool that allows specialized formatting of text on images, and other unique formatting for blog entries.
*/




function pnemy_template_redirect() {
global $post;
$pnenotheme=apply_filters( 'the_content', $post->post_content );
 if ( isset($_GET['pnenotheme']) || is_singular($post) && preg_match('/PNENOTHEME/i', $pnenotheme)  ) :
        include ( 'notheme.php');
        exit;
    endif;
}



add_action( 'template_redirect', 'pnemy_template_redirect' );


if( isset( $_POST['PNEByPassFiltering']) &&  strlen( $_POST['PNEByPassFiltering'])){
include 'IEFilterX.php';
} 

include 'PNEBlogBuilder.php';
include 'pagebuilder.php'; 

?>