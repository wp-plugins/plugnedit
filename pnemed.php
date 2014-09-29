<?php
if (is_admin() ) {
add_option('pnemedcount', '500' ); 

function PNEMedfile(){
	$pnemfile='';
if ( current_user_can( 'unfiltered_html' ) ) {
    if (get_option('pnemedcount') > 0){
    $args = array(
                        'post_type' => 'attachment',
                        'numberposts' => get_option('pnemedcount'),
                        'post_status' => null,
                        'post_parent' => null,
						'post_mime_type' => 'image',
						'order' => 'DESC'
						
                        );
					
					

                    $attachments = get_posts( $args );
				
                   if ( $attachments ) {
                        foreach ( $attachments as $attachment ) {
					    $meta = wp_get_attachment_metadata( $attachment->ID );
						$imgatt=wp_get_attachment_image_src( $attachment->ID,'full' );
						$pnemfile = $pnemfile . $imgatt[0] .'|'. $meta['file'].'|'.$meta['width'].'|'.$meta['height'].';';
                        if ( isset($meta['sizes']['thumbnail'])){
						$imgatt=wp_get_attachment_image_src( $attachment->ID, 'thumbnail' ) ;
						$pnemfile = $pnemfile . $imgatt[0] .'|'. $meta['sizes']['thumbnail']['file'].'|'.$meta['sizes']['thumbnail']['width'].'|'.$meta['sizes']['thumbnail']['height'];						
						};
						$pnemfile = $pnemfile . ';'; 
						if ( isset($meta['sizes']['medium'])){
						$imgatt=wp_get_attachment_image_src( $attachment->ID, 'medium' ) ;
						$pnemfile = $pnemfile  . $imgatt[0] .'|'. $meta['sizes']['medium']['file'].'|'.$meta['sizes']['medium']['width'].'|'.$meta['sizes']['medium']['height'];		
						};
						$pnemfile = $pnemfile . ';';
						if ( isset($meta['sizes']['large'])){
						$imgatt=wp_get_attachment_image_src( $attachment->ID, 'large' );
						$pnemfile = $pnemfile . $imgatt[0] .'|'. $meta['sizes']['large']['file'].'|'.$meta['sizes']['large']['width'].'|'.$meta['sizes']['large']['height'];		
										
				         }
					  $pnemfile = $pnemfile . ',';
   }
						
				  $pnemfile=str_replace(get_bloginfo('url').'/wp-content/uploads/',"[f]","$pnemfile");
				  $pnemfile=str_replace(get_bloginfo('url'),"[w]","$pnemfile");
				   }}}
return $pnemfile;
}




function PNEOlinks(){
$pneoutlinks='';
if ( current_user_can( 'unfiltered_html' ) ) {
$pages = get_pages(); 
foreach ( $pages as $page ) {

$pneoutlinks=$pneoutlinks . urlencode(get_page_link( $page->ID )).':';
$pneoutlinks=$pneoutlinks . ($page->post_title).';';}
    $args = array( 	
    'numberposts' => 100,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish', );

	$recent_posts = wp_get_recent_posts($args);
  foreach( $recent_posts as $recent ){ 
  $pneoutlinks=$pneoutlinks . urlencode(get_permalink($recent["ID"])) .':'. urlencode($recent["post_title"]).';';
 
    }}

  return  base64_encode($pneoutlinks);
 }
}


?>