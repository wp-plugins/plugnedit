<!DOCTYPE html>
<html>
<head>
<title><?php echo get_the_title($ID); ?></title>
<meta charset="UTF-8"/>
<?php
wp_head();
global $post;
$pnecout=apply_filters( 'the_content', $post->post_content );
preg_match('/data-pnebgcolor=\"([^\"]*)\"/i', $pnecout, $matches);
?>
<body style="background-color:<?php echo $matches[1]; ?>" >
<?php 
 echo $pnecout;
?>
<?php 
wp_footer(); 
?>
</body>
</html>


