<?php
/*
Plugin Name: PlugNedit
Plugin URI: Http://plugnedit.com
Version: 4.2.6
Author: 2 sticks
Description:PlugNedit <strong>Drag N Drop Visual Editor</strong> and web page builder for WordPress is a tool that allows specialized formatting of text on images, and other unique formatting for blog entries.
*/



if( isset( $_POST['PNEByPassFiltering']) &&  strlen( $_POST['PNEByPassFiltering'])){
include 'IEFilterX.php';
} 

include 'PNEBlogBuilder.php';
include 'pagebuilder.php'; 

?>