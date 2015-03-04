<?php
/*
Plugin Name: PlugNedit Adaptive Editor
Plugin URI: Http://plugnedit.com
Version: 5.0.8
Author: JavaScript Tech
Description:PlugNedit <strong>Drag N Drop Visual Editor</strong> and web page builder for WordPress is a tool that allows specialized formatting of text on images, and other unique formatting for blog entries.
*/




function pnemy_template_redirect() {
global $post;

if (have_posts()){
$pnenotheme = $post->post_content;
if ( isset($_GET['pnenotheme']) || is_singular($post) && preg_match('/PNENOTHEME/i', $pnenotheme)  ) :
        include ( 'notheme.php');
        exit;
    endif; 
	}
}

add_action( 'template_redirect', 'pnemy_template_redirect' );
include 'PNEBlogBuilder.php';
include 'pagebuilder.php'; 
?>