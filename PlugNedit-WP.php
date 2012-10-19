<?php
/*
Plugin Name: PlugNedit
Plugin URI: Http://plugnedit.com
Version: 3.4
Author: 2 sticks
Description:PlugNedit <strong>Drag N Drop Visual Editor</strong> and web page builder for WordPress is a tool that allows specialized formatting of text on images, and other unique formatting for blog entries.
*/




function do_pPlugneditStyleFooter(){?>
<script language="JavaScript" type="text/javascript">
try {
var ElePNE=document.getElementById('ICG1ADDONS-Spacer')
if(ElePNE){
if (parseInt(ElePNE.style.width) > 500){
document.body.style.minWidth=800+'px'
} else{
document.body.style.minWidth=710+'px'}
}} catch(err){
document.body.style.minWidth=710+'px'}
</script>
<?php
}


add_action( 'wp_footer', 'do_pPlugneditStyleFooter' );
if (is_admin() ) {
function my_default_editor() {
$r = 'html'; // html or tinymce
return $r;}

function my_the_content_filter($content) {
 if (preg_match('/ICG1ADDON/', $content)) {
add_filter( 'wp_default_editor', 'my_default_editor' ); }
return $content;
}
if (isset($_POST['plugneditcontent'])){ add_filter( 'wp_default_editor', 'my_default_editor' );}
add_filter( 'the_editor_content', 'my_the_content_filter' );
add_action('edit_form_advanced','do_aPlugnedit');
add_action('edit_page_form','do_aPlugnedit'); 
function do_aPlugnedit() {
add_action( 'admin_footer', 'do_pPlugnedit' );}
function do_pPlugnedit(){
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 
                === FALSE ? 'http' : 'https';
$host     = $_SERVER['HTTP_HOST'];
$script   = $_SERVER['SCRIPT_NAME'];
$params   = $_SERVER['QUERY_STRING'];
$currentUrl = $protocol . '://' . $host . $script . '?' . $params;
?>
<script language="JavaScript">
var NewPlugNeditContent=0
<?php if (isset($_POST['PlugNeditHTML'])){?>
document.getElementById('content').value='<?php echo $_POST['PlugNeditHTML'] ?>';
<?php }?>
var strContent=document.getElementById('content').value
<?php if (isset($_POST['plugneditcontent'])){?>
var NewPlugNeditContent=1
<?php }?>
SubStringContentPlugnedit=''
var ICGWarning=''


if (strContent.match('ICG1ADDON') ||  NewPlugNeditContent==1 ){if (strContent.match('ICG1ADDON')){document.getElementById('postdivrich').innerHTML='<br><br><br><iframe id="PlugNeditView" class="wp-editor-area" src="" style="z-index:100000;width:99.9%;height:500px"></iframe>'+document.getElementById('postdivrich').innerHTML;var x=document.getElementById("PlugNeditView");var y=(x.contentWindow || x.contentDocument);setTimeout("if (y.document)y=y.document;y.body.innerHTML=SubStringContentPlugnedit+strContent",2000)};ICGWarning='<BR><span style="font-size:12px;color:red">This page should be edited in the PlugNedit Editor Only.</span>'; if (document.getElementById('content-tmce')){document.getElementById('content-tmce').style.visibility='hidden' }; if (document.getElementById('edButtonPreview')){document.getElementById('edButtonPreview').style.visibility='hidden' }}
document.getElementById('edit-slug-box').innerHTML=document.getElementById('edit-slug-box').innerHTML+'<a href="javascript:void(0)" id="PNE-editor" onclick="SMPE()" class="button-primary" >PlugNedit Page Builder</a>'+ICGWarning;
function SMPE(){
var strContent=document.getElementById('content').value

document.getElementById('PlugNeditReturnUrl').value=document.URL;
if (strContent=='' || strContent.match('ICG1ADDON')){document.getElementById('PlugNeditContent').value=strContent; document.getElementById('NoEditupper4').style.visibility='visible';if (document.getElementById('PlugNeditView')){document.getElementById('PlugNeditView').style.visibility='hidden'}} else{
var ConfirmPlugNedit = confirm('You are about to leave the Word Press Page Editor. The contents of this page will be lost and updated with changes made with PlugNedit.')
if (ConfirmPlugNedit){
document.getElementById('NoEditupper4').style.visibility='visible'
if (document.getElementById('PlugNeditView')){document.getElementById('PlugNeditView').style.visibility='hidden'}

}else{}}}
function ProcessUpdatePlugNedit(){
var NewstrContent=document.getElementById('content').value;
if (NewstrContent.match('ICG1ADDON')){document.getElementById('PlugNeditContent2').value=document.getElementById('content').value;}}
</script>
<div id="NoEditupper4" align="center" style="font-size:14px;visibility:hidden;border-bottom-color:black; border-style:solid; position:absolute; background-color:white; top:200px; left:300px; width:400px; height:200px; z-index:10000 ;opacity:1;filter:alpha(opacity=100)" >

<BR><BR><div align="center" id="PlugNeditConfirm">
PlugNedit needs to import links of your media files in order to use them! </div>
<div align="center">This may take a moment to process.<BR><BR> </div>
<input type="button" id="PNE-editor-Import" Name="Import Files" value="Import Files" class="button-primary"  onClick="ProcessUpdatePlugNedit();document.forms['PlugNeditFormGet'].submit();" > <input class="button" id="PNE-editor-NoImport" onClick="document.forms['PlugNeditForm'].submit();" type="Button" Name="Proceed Without Import" value="Proceed Without Import"> <input onClick="document.getElementById('NoEditupper4').style.visibility='hidden';if (document.getElementById('PlugNeditView')){document.getElementById('PlugNeditView').style.visibility='visible'}" type="Button" name="Cancel"  value="Cancel" class="button">
</div>

<input type="hidden" id="plugneditcontent" name="plugneditcontent" value="<?php echo $tempcontent ?>">
<form id="PlugNeditForm"  name="PlugNeditForm" method="post" action="http://plugnedit.com/wordpress.cfm"><textarea name="plugneditfiles" cols="1" rows="1" style="visibility:hidden;display:none">
<?php 
if(isset($_POST['GetPlugneditfiles'])) {
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

}

?>
</textarea><?php if (isset($_POST["plugneditcontent"])) { ?>
<textarea id="plugneditreturncontent" cols="1" rows="1" style="visibility:hidden;display:none" name="plugneditreturncontent" ><?php echo stripslashes($_POST["plugneditcontent"]) ?></textarea>

<script language="JavaScript">
var Iframeview=''
if (!document.getElementById("PlugNeditView"))
{
Iframeview='<br><br><br><iframe id="PlugNeditView" class="wp-editor-area" src="" style="z-index:100000;width:99.9%;height:500px"></iframe>'
}
document.getElementById('postdivrich').innerHTML=Iframeview+document.getElementById('postdivrich').innerHTML;var x=document.getElementById("PlugNeditView");var y=(x.contentWindow || x.contentDocument);setTimeout("if (y.document)y=y.document;y.body.innerHTML=SubStringContentPlugnedit+document.getElementById('plugneditreturncontent').value",2000)
document.getElementById('content').value=document.getElementById('plugneditreturncontent').value

</script>


<?php 
}

?>
<textarea id="PlugNeditContent" cols="1" rows="1" style="visibility:hidden;display:none" name="PlugNeditContent" ><?php if(isset($_POST['PlugNeditContent2'])) {echo  stripslashes($_POST['PlugNeditContent2']);}?></textarea>
<input type="hidden" id="PlugNeditFileUrl"  name="PlugNeditFileUrl" value="<?php echo esc_attr(get_option('upload_path')); ?>">
<input type="hidden" value="" id="SaveTheWhales" name="SaveTheWhales">
<input type="hidden" id="PlugNeditContent"  name="PlugNeditHomeUrl" value="<?php echo esc_attr(get_option('home')); ?>">
<input type="hidden" id="PlugNeditSiteId"  name="PlugNeditSiteId" value="">
<input type="hidden" id="PlugNeditBaseUrl"  name="PlugNeditBaseUrl" value="<?php echo $_SERVER['HTTP_HOST']; ?>">
<input type="hidden" name="PlugNeditReturnUrl" id="PlugNeditReturnUrl" value="<?php echo $currentUrl; ?>">
<input type="hidden" name="UpdatePFiles" value="0" id="UpdatePFiles">
<input type="hidden" name="PlugNeditVersion" value="Version 2.0" id="PlugNeditVersion">
</form>
<form action="#" method="post"  name="PlugNeditFormGet">
<input type="hidden"  name="PlugNeditContent2" id="PlugNeditContent2" value="">
<input type="hidden"  name="GetPlugneditfiles" value="0">
<input type="hidden" name="PlugNeditVersion" value="Version 2.0" id="PlugNeditVersion">
</form>
<?php if (isset($_POST['GetPlugneditfiles'])) {?>
<script language="JavaScript"
>
document.getElementById('UpdatePFiles').value='1';
document.forms['PlugNeditForm'].submit();
</script><?php }
}}?><?php include 'pagebuilder.php'; ?>
