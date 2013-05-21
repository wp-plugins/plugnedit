<?php
function PNEADDPAGE() {
add_menu_page('Plug N Edit Page Builder', 'PNE Page Builder', 5, __FILE__, 'PnEPageBuilder');
}

function PnEPageBuilder() {

if( isset( $_POST['PlugneditBGColor']) &&  strlen( $_POST['PlugneditBGColor'])){$pbgcolor=$_POST['PlugneditBGColor'];} else {$pbgcolor="#ffffff";}

if( isset( $_POST['PlugneditEditorMargin']) &&  strlen( $_POST['PlugneditEditorMargin'])){$pnemarginwidth=$_POST['PlugneditEditorMargin'];} else {$pnemarginwidth="755";}

if(isset($_POST['PNEFileName'])) {

$PNEcontent = '<!DOCTYPE html><html><head><title>'.$_POST['PNETitle'].'</title><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="keywords" content="'.$_POST['PNEKeyWords'].'"><meta name="description" content="'.$_POST['PNEDescription'].'"></head><body style="margin:0px;min-width:'.$pnemarginwidth.'px;background-color:'.$pbgcolor.'"><div id="PNEPageBuilderContent">'.stripslashes($_POST['plugneditcontent']).'</div></body></html>';
$PNEFile="../PNEHTML/".str_replace(' ', '_', $_POST['PNEFileName']).".htm";


if (file_exists($PNEFile)){
unlink($PNEFile);}
if ($_POST['PNEDelete']!=1){
$handle = fopen($PNEFile, 'w') or die('Cannot open file:  '.$PNEFileName);
fwrite($handle, $PNEcontent);
}
}
?>


<script>
YBSDPNE=false
</script>
<!--[if IE]>
<script>
YBSDPNE=true
</script>
<![endif]-->
<script language="JavaScript" type="text/javascript">

function PNEBSD()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   document.getElementById('PlugNeditContent').value=xmlhttp.responseText;
document.forms["PNEPageBuilder"].submit()
    }
  }
xmlhttp.open("POST","../wp-content/plugins/plugnedit/tobase64.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
str="str="+encodeURIComponent(document.getElementById('PlugNeditContent').value)
xmlhttp.send(str);

}

function colorToHex(color) {
 
    if (color.substr(0, 1) === '#') {
        return color;
    }
	try {
    var digits = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(color);
    
    var red = parseInt(digits[2]);
    var green = parseInt(digits[3]);
    var blue = parseInt(digits[4]);
    
    var rgb = blue | (green << 8) | (red << 16);
    return digits[1] + '#' + rgb.toString(16);
	} catch(err){}
};


SetLoadPNE=1;



function Loadpne(src,filename,PNEtype, PNEType2){
document.getElementById('PNELoadpage').src =src+'?a='+Math.floor((Math.random()*100000)+1);
document.getElementById('PNEFileName').value=filename;
document.getElementById('PlugNeditFileName').value=src;
SetLoadPNE=PNEtype;
SetLoadPNE2=PNEType2;
PNEFirstEdit=1
}

PNEFirstEdit=0
function frameloaded()
{
try {
var iframe = document.getElementById("PNELoadpage");
var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
var PlugNeditContentframe=innerDoc.getElementById('PNEPageBuilderContent').innerHTML;
document.getElementById('PlugNeditReturnUrl').value=document.URL;
if (document.getElementById('ByPassFiltering')){document.getElementById('ByPassFiltering').value=document.URL;}
if (SetLoadPNE == 1){
document.getElementById('PNEMETA').style.visibility='visible';
document.getElementById('PNETitle').value=innerDoc.title;
var keywords='';
var description='';
var metas = innerDoc.getElementsByTagName('meta');
    if (metas) {
        for (var x=0,y=metas.length; x<y; x++) {
            if (metas[x].name.toLowerCase() == "keywords") {
                keywords += metas[x].content;
            }
        }
    }
	
	  if (metas) {
        for (var x=0,y=metas.length; x<y; x++) {
            if (metas[x].name.toLowerCase() == "description") {
                description += metas[x].content;
            } 
        }
    }
	document.getElementById('PNEKeyWords').value=keywords;
	document.getElementById('PNEDescription').value=description; 
<?php if(!isset( $_POST['PlugneditBGColor']) &&  !strlen($_POST['PlugneditBGColor'])){ ?>
document.getElementById('PlugneditBGColor').value=colorToHex(innerDoc.body.style.backgroundColor)
<?php  } ?>

if (PNEFirstEdit!=0){
if (!isNaN(parseInt(innerDoc.body.style.minWidth))){
document.getElementById('marginwidth').value=parseInt(innerDoc.body.style.minWidth)
}
}


if (SetLoadPNE2!=0){	
document.getElementById('PlugNeditContent').value=PlugNeditContentframe;
document.getElementById('plugneditcontent').value=PlugNeditContentframe;
}
} else {
document.getElementById('PNEditorBgColor').value=colorToHex(innerDoc.body.style.backgroundColor)
document.getElementById('plugneditcontent').value=PlugNeditContentframe;
document.getElementById('PlugNeditContent').value=PlugNeditContentframe;
if (!isNaN(parseInt(innerDoc.body.style.minWidth))){
document.getElementById('marginwidth').value=parseInt(innerDoc.body.style.minWidth)
}

if (YBSDPNE==false){
document.forms["PNEPageBuilder"].submit();

 } else {
PNEBSD()
}
}
} catch(err){}
}


function validateThisForm()
{
var alertp=''
var x=document.forms["PNEUPDATE"]["PNEFileName"].value;
if (x==null || x=="")
{
alertp='Please Enter A Name For Page   ';
}
x=document.forms["PNEUPDATE"]["PNETitle"].value;
if (x==null || x=="")
{
alertp=alertp+'Please Enter A Title For Page  ';
}
x=document.forms["PNEUPDATE"]["PNEKeyWords"].value;
if (x==null || x=="")
{
alertp=alertp+'Please Enter Keywords For Page  ';
}
x=document.forms["PNEUPDATE"]["PNEDescription"].value;
if (x==null || x=="")
{
  alertp=alertp+'Please Enter A Description For Page     ';
}  
if(alertp!='') {alert(alertp);return false;};
}
</script>

<?php
$PNEStart=0;
if (isset($_GET["PNENEXT"])){
$PNEStart=$PNEStart+$_GET["PNENEXT"];
}
$PNEEnd=$PNEStart+20;
$dirname = '../PNEHTML';
if (!file_exists($dirname)) wp_mkdir_p($dirname);
$dir = "../PNEHTML/*";
$dirnamereplace = '../PNEHTML/';
$PNEHTMLGlob=glob($dir);

if (is_array($PNEHTMLGlob)){

foreach(array_slice($PNEHTMLGlob,$PNEStart,$PNEEnd) as $file)  
{ 
if (substr($file,-4) == ".htm"){
$plugneditHTMLfiles = "$plugneditHTMLfiles;$file";}
}}
?>
 




<div class="wrap">

<div style="width:750px;text-align:justify">
<h1 style="color:red;font-size:11px;font-style:normal;font-family:Tahoma">Administrator: Only users that are Administrator or Editor Roles can use the editor due to WordPress unfiltered HTML rules. </h1>

<BR>
<table style="width:750px;padding:4px;border:none"><tr><td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="CMKNAW64GX9WU">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="paypal" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</td><td>
<h2 style="color:Green;font-size:24px;font-weight:bolder;font-style:italic;font-family:Tahoma">&nbsp;&nbsp;&nbsp;Plug N Edit</h2>
<span style="color:#21759B;font-size:12px">
Do not use PlugNedit for any type of sensitive or personal information (General 
Public Pages Only). <BR> 
</span>

<span style="color:gray;font-size:12px">
For blog entries and pages built within your WordPress template, use the button labeled "PlugNedit Page Builder" In the Post or Pages menu. 
This section of PlugNedit is for creating pages outside of your Wordpress Template. In order to use PlugNedit you will need to import links to your media.
HTML files are saved in your wordpress root in folder PNEHTML. 
<BR><BR>
Adding HTML or editing file by hand may make it non-editable in Plug N Edit. </span><BR><BR>
</td></tr></table>
</div>
<a href="http://plugNEdit.com" target="_blank" style="font-size:13px">Plug & Edit Home Page</a> &nbsp;&nbsp;&nbsp;<a href="mailto:contact@plugnedit.com" style="font-size:13px">Support Email: Contact@plugnedit.com</a>
<table style="border:solid;border-width:1px;border-color:black;padding:2px;width:800px;font-size:16px;font-weight:bold;color:#21759B"><tr style="background-color:#777;color:white;text-shadow: -1px -1px #333, 1px 1px #333;height:35px"><td style="width:200px">Page Name</td><td>Preview</td><td>URL</td><td>Edit Meta</td><td>Edit Page</td></tr>
<?php		 
$arrayp = explode(';', $plugneditHTMLfiles); 
foreach($arrayp as $value) 
{
if ($value != ''){
echo '<TR><td style="font-size:16px">';
echo str_ireplace('.htm','',str_ireplace($dirnamereplace,' ',$value));
echo '</td><td style="font-size:10px;font-weight:bold;color:#21759B">';
echo '<a class="button" href="';
echo $value.'?k='.rand(10000,10000000); 
echo '" target="_blank">Preview Page</a>';
echo '</td><td style="font-size:10px;font-weight:bold;color:#21759B"><input type="text" value="';
echo esc_attr(get_option('home'));
echo str_ireplace('..','',$value);
echo '"></td><td style="font-size:10px;font-weight:bold;color:#21759B">';
echo '<a class="button" onclick="Loadpne(\''; echo $value;  echo '\',\''; echo str_ireplace('.htm','',str_ireplace($dirnamereplace,'',$value)); echo '\',1)">Manage Page</a>';
echo '</td><td style="font-size:10px;font-weight:bold;color:#21759B">';
echo '<input type="submit" name="PNEPUBLISH"  id="publish" class="button-primary" value=" Edit Page In Plug N Edit " onclick="Loadpne(\''; echo $value;  echo '\',\''; echo str_ireplace('.htm','',str_ireplace($dirnamereplace,'',$value)); echo '\',0)">';
echo '</td></tr><tr><td colspan=5><hr size="1px" width="700px"></tr> ';
}}
echo '</table></div><BR>';
if($PNEStart > 19){
$PNEStart=$PNEStart-20;
echo '&nbsp;&nbsp;<a style="font-size:16px;font-weight:bold;color:#21759B" href="admin.php?page=plugnedit/pagebuilder.php&PNENEXT='; echo $PNEStart; echo ' ">Previous</a>';
};

if($PNEEnd < count($PNEHTMLGlob)){
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a style="font-size:16px;font-weight:bold;color:#21759B" href="admin.php?page=plugnedit/pagebuilder.php&PNENEXT='; echo $PNEEnd; echo ' ">Next</a>';
};


?>
<script language="JavaScript" type="text/javascript">
function checkField(fieldname)
{
if (/[^0-9a-zA-Z\s]/gi.test(fieldname.value))
{
alert ("Only alphanumeric characters and spaces are valid in this field");
fieldname.value = "";
fieldname.focus();
return false;
}
}


</script>
<form name="PNEPageBuilder" method="post" action="http://plugnedit.com/wordpress.cfm">
<textarea id="PlugNeditContent" cols="1" rows="1" style="visibility:hidden;display:none" name="PlugNeditContent"></textarea>
<input type="hidden" id="PlugNeditFileUrl"  name="PlugNeditFileUrl" value="<?php echo esc_attr(get_option('upload_path')); ?>">
<input type="hidden" id="PlugNeditHomeUrl"  name="PlugNeditHomeUrl" value="<?php echo esc_attr(get_option('home')); ?>">
<input type="hidden" id="PlugNeditBaseUrl"  name="PlugNeditBaseUrl" value="<?php echo $_SERVER['HTTP_HOST']; ?>">


<!--[if IE]>
<input type="hidden" id="PlugNeditBinarycontent"  name="PlugNeditBinarycontent" value="1">
<![endif] -->
<?php
$pages = get_pages(); 
foreach ( $pages as $page ) {
$pneoutlinks=$pneoutlinks . urlencode(get_page_link( $page->ID )).':';
$pneoutlinks=$pneoutlinks . ($page->post_title).';';}
    $args = array( 	'numberposts' => 100,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish', );

	$recent_posts = wp_get_recent_posts($args);
	foreach( $recent_posts as $recent ){ 
  $pneoutlinks=$pneoutlinks . urlencode(get_permalink($recent["ID"])) .':'. urlencode($recent["post_title"]).';';
    } ?>
	
	
<input type="hidden" name="PNEPageLinks" value="<?php echo $pneoutlinks ?>">

<input type="hidden" name="PlugNeditReturnUrl" id="PlugNeditReturnUrl" value="">

<input type="hidden" name="PlugNeditFileName" id="PlugNeditFileName" value="">
<input type="hidden" id="marginwidth" name="marginwidth" value="755">
<input type="hidden" name="PluginType" value="StandAlone">
<input type="hidden" name="DisplayLogo" value="0">
<input type="hidden" id="PNEditorBgColor" name="PNEditorBgColor" value="">
<input type="hidden" name="PNEPluginSection" value="WP_PageBuilder">

<input name="marginheight" id="marginheight" type="hidden" value="20000">

<textarea name="plugneditfiles" cols="1" rows="1" style="visibility:hidden;display:none">

<?php 
if (esc_attr(get_option('upload_path'))==''){
$stringRplaceplugnedit="../wp-content/uploads";
$dir = "../wp-content/uploads/*";  
}else{
$StringAttPNE=esc_attr(get_option('upload_path'));
$stringRplaceplugnedit="../$StringAttPNE/"; 
$dir ="../$StringAttPNE/*";  

}

foreach(array_slice((array)glob($dir),0,5000) as $file)  
{ $file=$file;
if (strtolower(substr($file,-4)) == ".gif" || strtolower(substr($file,-4)) == ".jpg" || strtolower(substr($file,-4))  == ".png" ){
echo  str_replace($stringRplaceplugnedit,';',$file);
$plugneditfiles = "$plugneditfiles;$file";}
if(file_exists($file) && is_dir($file)){
$dir2 = "$file";   
foreach(array_slice((array)glob($dir2),0,5000) as $file2)  
{ $file=$file2;
if (strtolower(substr($file2,-4)) == ".gif" || strtolower(substr($file2,-4))  == ".jpg" || strtolower(substr($file2,-4))  == ".png" ){
 $plugneditfiles = "$plugneditfiles;$file2";
echo  str_replace($stringRplaceplugnedit,';',$file2);}}  
if(file_exists($file2) && is_dir($file2)){
$dir3 = "$file2/*";  
foreach(array_slice((array)glob($dir3),0,5000) as $file3)  
{ $file=$file3;
if (strtolower(substr($file3,-4))  == ".gif" || strtolower(substr($file3,-4)) == ".jpg" || strtolower(substr($file3,-4)) == ".png" ){
 $plugneditfiles = "$plugneditfiles;$file3";
 echo  str_replace($stringRplaceplugnedit,';',$file3);
 } if(file_exists($file3) && is_dir($file3)){
$dir4 = "$file3/*";  }  
foreach(array_slice((array)glob($dir4),0,5000) as $file4)  
{  $file=$file4;
if (strtolower(substr($file4,-4)) == ".gif" || strtolower(substr($file4,-4)) == ".jpg" || strtolower(substr($file4,-4))  == ".png" ){
$plugneditfiles = "$plugneditfiles;$file4";
echo  str_replace($stringRplaceplugnedit,' ; ',$file4);
}}}}}}  
?>
</textarea>
</form>
<BR><BR>  &nbsp;&nbsp;<input type="button" name="publish2" id="publish2" class="button-primary" value="  Create New Page  " onClick="javascript:if (document.getElementById('ByPassFiltering')){document.getElementById('ByPassFiltering').value=document.URL;};document.getElementById('PlugNeditReturnUrl').value=document.URL;document.getElementById('PlugNeditContent').value=' ';document.forms['PNEPageBuilder'].submit()" >  


<iframe src="" onload="frameloaded()" id="PNELoadpage" style="background-color:white;position:absolute;top:0px;left:0px;visibility:hidden;width:0px;height:0px;z-index:1;overflow:hidden">
</iframe>
<div id='PNEMETA'  style="padding:6px;background-color:white;position:absolute;top:100px;left:200px;visibility:hidden;width:600px;height:400px;z-index:10000;border-color:blue;border-width:2px;border:solid">
<BR><span style="font-size:16px;font-weight:bold;color:#21759B">File Name.</span><span style="font-size:12px;font-weight:bold"> (Example: ACME Rockets):</span> <BR>
<form name="PNEUPDATE" method="post" action="#"  onsubmit="return validateThisForm()">
<input type="text" id="PNEFileName" name="PNEFileName" value="" onblur="checkField(this)" maxlength="16" size="16" style="font-size:12px;font-weight:bold;color:red"><BR><BR>
<input type="hidden" id="PNEDelete" name="PNEDelete" value="0">
<span style="font-size:16px;font-weight:bold;color:#21759B">Title Of Page.</span><span style="font-size:12px;font-weight:bold"> (Example: ACME Rockets Work Best.):</span> <BR>
<input type="text" id="PNETitle" name="PNETitle" value="" maxlength="200" size="60" style="font-size:12px;font-weight:bold;color:red"><BR><BR>
<BR>
<span style="font-size:16px;font-weight:bold;color:#21759B">Keywords:</span><span style="font-size:12px;font-weight:bold"> (Example: Rockets, Acme, Best Rockets ).</span> <BR>
<input type="text" Id="PNEKeyWords" name="PNEKeyWords" value="" maxlength="300" size="60" style="font-size:12px;font-weight:bold;color:red"><BR><BR><BR>
<input type="hidden" name="PNEUpdate" value="1">
<input type="hidden" id="PlugneditBGColor" name="PlugneditBGColor" value="<?php echo $pbgcolor; ?>" >
<input type="hidden" id="PlugneditEditorMargin" name="PlugneditEditorMargin" value="<?php echo $pnemarginwidth; ?>" >

<span style="font-size:16px;font-weight:bold;color:#21759B">Description:</span><span style="font-size:12px;font-weight:bold"> (Example: This page is about the superior workmanship of Acme Rockets. ):</span><BR> 
<input type="text" name="PNEDescription" id="PNEDescription" value="" maxlength="10000" size="60" style="font-size:12px;font-weight:bold;color:red"><BR><BR>
<input type="submit" name="publish" id="publish" class="button-primary" value="    Publish    " > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <input type="Button" onClick="javascript:document.getElementById('PNEDelete').value=1;document.forms['PNEUPDATE'].submit();" name="PNEDeletebutton" id="PNEDeletebutton" value="    Delete Page    " class="button button-highlighted"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Button" onClick="javascript:document.getElementById('PNEMETA').style.visibility='hidden'" name="PNECancel" id="PNECancel" value="    Cancel    " class="button button-highlighted">
<textarea  cols="1" rows="1" style="visibility:hidden;display:none"  id="plugneditcontent" name="plugneditcontent" ><?php if(isset($_POST['PlugNeditBinarycontent'])){$_POST['plugneditcontent'] = base64_decode($_POST['plugneditcontent']); };if(isset($_POST['plugneditcontent'])) { echo stripslashes($_POST['plugneditcontent']); }?></textarea>
</form></div>
 
<?php
if(empty($_POST['PlugNeditFileName']) && !empty($_POST['plugneditcontent']) && empty($_POST['PNEUpdate'])) { ?>
<script language="JavaScript" type="text/javascript">
document.getElementById('PNEMETA').style.visibility='visible';
</script> 

<?php
}

if(!empty($_POST['PlugNeditFileName']) && !empty($_POST['plugneditcontent'])        ) { ?>
<script language="JavaScript" type="text/javascript">

<?php 
echo "Loadpne('"; echo str_replace(' ', '_',$_POST['PlugNeditFileName']); echo "','"; echo str_ireplace('.htm','',str_ireplace($dirnamereplace,'',$_POST['PlugNeditFileName'])); echo "','1','0')";
?>
</script> 
<?php

}


}
add_action('admin_menu', 'PNEADDPAGE');
 

 ?>