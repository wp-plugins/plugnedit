<?php if (is_admin() ) {
function PNEADDPAGE() {
add_menu_page('Plug N Edit Page Builder', 'PNE Page Builder', 5, __FILE__, 'PnEPageBuilder');
}

function PnEPageBuilder() {
if(isset($_POST['PNEFileName'])) {
$PNEcontent = '<!DOCTYPE html><head><title>'.$_POST['PNETitle'].'</title><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="keywords" content="'.$_POST['PNEKeyWords'].'"><meta name="description" content="'.$_POST['PNEDescription'].'"></head><body><div id="PNEPageBuilderContent">'.stripslashes($_POST['plugneditcontent']).'</div></body></html>';
$PNEFile="../PNEHTML/".str_replace(' ', '_', $_POST['PNEFileName']).".htm";

if (file_exists($PNEFile)){
unlink($PNEFile);}
if ($_POST['PNEDelete']!=1){
$handle = fopen($PNEFile, 'w') or die('Cannot open file:  '.$PNEFileName);
fwrite($handle, $PNEcontent);
}
}
?>
<script language="JavaScript" type="text/javascript">
SetLoadPNE=1;
SetLoadPNE=1;

function Loadpne(src,filename,PNEtype, PNEType2){
document.getElementById('PNELoadpage').src =src;
document.getElementById('PNEFileName').value=filename;
document.getElementById('PlugNeditFileName').value=src;
SetLoadPNE=PNEtype;
SetLoadPNE2=PNEType2;
}

function frameloaded()
{
try {
var iframe = document.getElementById("PNELoadpage");
var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
var PlugNeditContentframe=innerDoc.getElementById('PNEPageBuilderContent').innerHTML;
document.getElementById('PlugNeditReturnUrl').value=document.URL;
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
if (SetLoadPNE2!=0){	
document.getElementById('PlugNeditContent').value=PlugNeditContentframe;
document.getElementById('plugneditcontent').value=PlugNeditContentframe;
}
} else {
document.getElementById('plugneditcontent').value=PlugNeditContentframe;
document.getElementById('PlugNeditContent').value=PlugNeditContentframe;
document.forms["PNEPageBuilder"].submit();
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
$dirname = '../PNEHTML';
if (!file_exists($dirname)) mkdir($dirname);
$dir = "../PNEHTML/*";
$dirnamereplace = '../PNEHTML/';
foreach(array_slice(glob($dir),0,20) as $file)  
{ $file=strtolower($file);
if (substr($file,-4) == ".htm"){
$plugneditHTMLfiles = "$plugneditHTMLfiles;$file";}
 }
 ?>
<div class="wrap">
<h2>Plug N Edit</h2>
<h3 style="color:red">Read First:</h2>
<h3>For blog entries and pages built within your WordPress template, use the button labeled "PlugNedit Page Builder" In the Post or Pages menu. </h3>
<h3>This section of PlugNedit is for creating pages outside of your Wordpress Template. In order to use this section you will need to import links to your media.</h3>
<h4>PlugNedit is free for blog entries and page built within the wordpress template. This section is limited to 20 pages, if you need more pages please contact us. </h4>
<h4>This section is a new V1.0, the page background colors and styles options 
  are unavailable, we will have updates coming soon, HTML files are saved in your wordpress root in folder PNEHTML. </h4>
<h4>Adding HTML or editing file by hand may make it non-editable in Plug N edit. 
  Because we load links to media pages may take a moment to load. </h4>
<li><a href="http://plugNEdit.com" target="_blank"><h3>Plug & Edit Home Page</h3></a></li>
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
echo $value; 
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
echo '</table></div>';
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
<input type="hidden" name="PlugNeditReturnUrl" id="PlugNeditReturnUrl" value="">
<input type="hidden" name="PlugNeditFileName" id="PlugNeditFileName" value="">
<input type="hidden" name="marginwidth" value="1200">
<input type="hidden" name="PluginType" value="StandAlone">
<input type="hidden" name="DisplayLogo" value="0">
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
foreach(array_slice(glob($dir),0,1000) as $file)  
{ $file=strtolower($file);
if (substr($file,-4) == ".gif" || substr($file,-4) == ".jpg" || substr($file,-4)  == ".png" ){
echo  str_replace($stringRplaceplugnedit,';',$file);
$plugneditfiles = "$plugneditfiles;$file";}
if(file_exists($file) && is_dir($file)){
$dir2 = "$file";   
foreach(array_slice(glob($dir2),0,1000) as $file2)  
{ $file=strtolower($file2);
if (substr($file2,-4) == ".gif" || substr($file2,-4) == ".jpg" || substr($file2,-4)  == ".png" ){
 $plugneditfiles = "$plugneditfiles;$file2";
echo  str_replace($stringRplaceplugnedit,';',$file2);}}  
if(file_exists($file2) && is_dir($file2)){
$dir3 = "$file2/*";  
foreach(array_slice(glob($dir3),0,1000) as $file3)  
{ $file=strtolower($file3);
if (substr($file3,-4) == ".gif" || substr($file3,-4) == ".jpg" || substr($file3,-4)  == ".png" ){
 $plugneditfiles = "$plugneditfiles;$file3";
 echo  str_replace($stringRplaceplugnedit,';',$file3);
 } if(file_exists($file3) && is_dir($file3)){
$dir4 = "$file3/*";  }  
foreach(array_slice(glob($dir4),0,1000) as $file4)  
{  $file=strtolower($file4);
if (substr($file4,-4) == ".gif" || substr($file4,-4) == ".jpg" || substr($file4,-4)  == ".png" ){
$plugneditfiles = "$plugneditfiles;$file4";
echo  str_replace($stringRplaceplugnedit,' ; ',$file4);
}}}}}}
?>
</textarea>
</form>
<BR><BR>  &nbsp;&nbsp;<input type="button" name="publish2" id="publish2" class="button-primary" value="  Create New Page  " onClick="javascript:document.getElementById('PlugNeditReturnUrl').value=document.URL;document.getElementById('PlugNeditContent').value=' ';document.forms['PNEPageBuilder'].submit()" >  


<iframe src="" onload="frameloaded()" id="PNELoadpage" style="background-color:white;position:absolute;top:0px;left:400px;visibility:hidden;width:300px;height:300px;z-index:10000000">
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
<span style="font-size:16px;font-weight:bold;color:#21759B">Description:</span><span style="font-size:12px;font-weight:bold"> (Example: This page is about the superior workmanship of Acme Rockets. ):</span><BR> 
<input type="text" name="PNEDescription" id="PNEDescription" value="" maxlength="10000" size="60" style="font-size:12px;font-weight:bold;color:red"><BR><BR>
<input type="submit" name="publish" id="publish" class="button-primary" value="    Publish    " > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <input type="Button" onClick="javascript:document.getElementById('PNEDelete').value=1;document.forms['PNEUPDATE'].submit();" name="PNEDeletebutton" id="PNEDeletebutton" value="    Delete Page    " class="button button-highlighted">


<textarea  cols="1" rows="1" style="visibility:hidden;display:none"  id="plugneditcontent" name="plugneditcontent" ><?php if(isset($_POST['plugneditcontent'])) { echo stripslashes($_POST['plugneditcontent']); }?></textarea>
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
 

} ?>