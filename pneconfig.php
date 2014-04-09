<?php 
if ( is_admin() ) {

   if (!file_exists('../pnehtml')){ wp_mkdir_p('../pnehtml');};

   
   $pnefolderc='pnehtml';
   if (file_exists('../PNEHTML'))
	{
    $pnec1 = 0; 
    $dir = '../pnehtml';
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false){
            if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
                $pnec1++;
        }
    }
   
  
   
       $pnec2 = 0; 
    $dir = '../PNEHTML';
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false){
            if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
                $pnec2++;
        }
    }
   
   if ($pnec1 >= $pnec2 )
   {
   
    $pnefolderc="pnehtml"; } else {  $pnefolderc="PNEHTML";}
  
   }
   
 add_option('pnefolder', $pnefolderc ); 
 
}

?>