<?php 
if ( is_admin() ) {
$Pdirname = '../pnehtml';
if (!file_exists($Pdirname)){ wp_mkdir_p($Pdirname);
copy('../wp-content/plugins/plugnedit/demo_page.htm', '../pnehtml/demo_page.htm');
};
   
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
   
  
   
   
   
   if (! file_exists('../wp-content/plugins/plugnedit/pneconfig.txt')){
$handle = fopen('../wp-content/plugins/plugnedit/pneconfig.txt', 'w') or die('Cannot open file PNE Config');
fwrite($handle, $pnefolderc);
}
}

?>