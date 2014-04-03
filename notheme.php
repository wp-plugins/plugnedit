<!DOCTYPE html>
<html>
<head>
<title><?php echo get_the_title(); ?></title>
<meta charset="UTF-8"/>
<?php
wp_head();
global $post;
$pnecout=apply_filters( 'the_content', $post->post_content );
$pnecolor='background-color:white';

if (preg_match('/data-pnebgcolor=\"([^\"]*)\"/i', $pnecout, $matches)){
if ($matches[1] != ''){
$pnecolor='background-color:'.$matches[1];
}}
?>
<body style="<?php echo $pnecolor; ?>" >
<?php 
 echo $pnecout;
?>
<?php 
wp_footer(); 
?>
</body>
</html>