<?php
function do_pPlugneditStyleFooter(){?>
<script language="JavaScript" type="text/javascript">
try {
var ElePNE=document.getElementById('ICG1ADDONS-Spacer')
if(ElePNE){
var tempStyleminwidth=parseInt(document.body.style.minWidth)
if (isNaN(tempStyleminwidth) || tempStyleminwidth < 800 || tempStyleminwidth =='' ){
if (parseInt(ElePNE.style.width) > 500){
document.body.style.minWidth=800+'px'
} else{
document.body.style.minWidth=710+'px'}
}
}
} catch(err){
}

</script>
<?php
}

remove_filter ('the_content',  'wpautop');
function PNEcheckpost($content) {
if (preg_match('/ICG1ADDON/', $content)) {
return $content;
}
return wpautop($content);
}

add_filter( 'the_content', 'PNEcheckpost' );


add_action( 'wp_footer', 'do_pPlugneditStyleFooter' );

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
if ( current_user_can('unfiltered_html')  ) {
add_action( 'admin_footer', 'do_pPlugnedit' );
}
}
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
PNEpreserveupdate=true
<?php if (isset($_POST['PlugNeditHTML'])){?>
document.getElementById('content').value='<?php echo $_POST['PlugNeditHTML'] ?>';
<?php }?>
strContent=document.getElementById('content').value
<?php if (isset($_POST['plugneditcontent'])){?>
var NewPlugNeditContent=1
<?php }?>
SubStringContentPlugnedit=''
var ICGWarning=''
function PreservePNEcontent(){
if (PNEpreserveupdate==true && strContent!=document.getElementById('content').value){
document.getElementById('content').value=strContent
} 
}

if (strContent.match('ICG1ADDON') ||  NewPlugNeditContent==1 ){if (strContent.match('ICG1ADDON')){
document.getElementById('wp-content-wrap').style.visibility='hidden'
if (!document.getElementById('post').getAttribute('onsubmit')){document.getElementById('post').setAttribute('onsubmit','PreservePNEcontent()') } else {
try{
 document.getElementById('post').setAttribute('onsubmit','PreservePNEcontent();'+document.getElementById('post').getAttribute('onsubmit')) 
 } catch(err){}
}

document.getElementById('postdivrich').innerHTML='<br><br><br><iframe id="PlugNeditView" class="wp-editor-area" src="" style="z-index:100000;width:99.9%;height:500px"></iframe><br><input type="button" class="button" value="Show WordPress Editor - WordPress editor uses auto formatting and may distort the look of the page." onclick="document.getElementById(\'wp-content-wrap\').style.visibility=\'visible\';PNEpreserveupdate=false">'+document.getElementById('postdivrich').innerHTML;var x=document.getElementById("PlugNeditView");var y=(x.contentWindow || x.contentDocument);setTimeout("if (y.document)y=y.document;y.body.innerHTML=SubStringContentPlugnedit+strContent",2000)};ICGWarning='<BR><span style="font-size:13px;color:red;font-weight:bold">This page should be edited in the PlugNedit Editor only.</span>'; if (document.getElementById('content-tmce')){document.getElementById('content-tmce').style.visibility='hidden' }; if (document.getElementById('edButtonPreview')){document.getElementById('edButtonPreview').style.visibility='hidden' }}
document.getElementById('edit-slug-box').innerHTML=document.getElementById('edit-slug-box').innerHTML+'<a href="javascript:void(0)" id="PNE-editor" onclick="SMPE()" class="button-primary" >PlugNedit Page Builder</a>'+ICGWarning;
function SMPE(){
var strContent=document.getElementById('content').value

document.getElementById('PlugNeditReturnUrl').value=document.URL;
if (strContent=='' || strContent.match('ICG1ADDON')){document.getElementById('PlugNeditContent').value=strContent;ProcessUpdatePlugNedit();document.forms['PlugNeditFormGet'].submit();if (document.getElementById('PlugNeditView')){document.getElementById('PlugNeditView').style.visibility='hidden'}} else{
document.getElementById('NoEditupper5').style.visibility='visible'
}}

function ProcessImportpage(){
if (strContent !=''){
document.getElementById('PlugNeditContent').value='<div style="text-align:center;position:relative" id="ICG1ADDON" data-plugneditversion="2" data-precision="Relative" data-hguides="" data-vguides=""><div id="ICG1ADDONS-Spacer" style="position: static; height: 0px; width: 550px; background-color: transparent;"></div><div id="UpperMovableDrawing" style="position: absolute; width: 0px; top: 0px; z-index: 10; left: 50%; overflow: visible;"><div id="p1002Movable-drawingmoveDivShadow" data-pnelnatrbt="PNEPlugNedit WP-IMPORT" data-layertype="Movable-drawingmoveDiv" data-layeropacity="1" data-pnelayernumber="1002" data-layerfilter="100" data-type="MVBDRW" style="opacity: 1; margin: 0px; font-size: 12px; border: 3px solid red; position: absolute; background-color: transparent; top: 38px; left: -282px; width: 550px; height: 179px; z-index: 1002; overflow: visible; line-height: normal; padding: 3px; border-spacing: 0px;"><div id="p1002ICGdrawingDiv-NoEdit" data-pnelayernumber="1002" style="font-family: Arial, Arial, Helvetica, sans-serif; font-size: 16px; background-color: rgb(255, 255, 255); border: 1px none rgb(0, 0, 0); padding: 6px; border-spacing: 6px; width: 532px; height: 151px; text-align: left; position: static; margin: 0px auto; overflow: hidden; word-wrap: break-word; letter-spacing: normal; line-height: normal; font-weight: normal; color: rgb(0, 0, 0);" data-editortype="HTML" contenteditable="true">'+strContent+'</div></div></div></div>'};ProcessUpdatePlugNedit('Import');document.forms['PlugNeditFormGet'].submit();
}

function ProcessUpdatePlugNedit(Import){
if (Import!="Import") {

var NewstrContent = document.getElementById('content').value;
} else {
document.getElementById('PlugNeditContent2').value=document.getElementById('PlugNeditContent').value
return;
}
if (NewstrContent.match('ICG1ADDON')){document.getElementById('PlugNeditContent2').value=document.getElementById('content').value;}}
</script>

<div id="NoEditupper5" align="center" style="padding:8px;font-size:13px;visibility:hidden;border-bottom-color:black; border-style:solid; position:absolute; background-color:white; top:100px; left:200px; width:600px; height:550px; z-index:10000 ;opacity:1;filter:alpha(opacity=100)" >

<BR><BR><div align="justify" id="PlugNeditConfirm2" style="color:black;font-size:13px">
PlugNedit uses a 3 Dimensional page layout that the WordPress standard editor cannot edit. Converting old blog entries to this format provides little improvement because the page will still be in 2D format. <BR><BR><BR>
<table align="center"><TR><TD align="center" width="280px" style="font-weight:bold">
PlugNedit Format:<BR>
Height, Width, Depth, Transparency.<BR>
<img src="../wp-content/plugins/plugnedit/translayer.jpg"></TD><TD align="center" width="280px" style="font-weight:bold">
Standard WordPress Editor:<BR>
Height, Width.<BR>
<img src="../wp-content/plugins/plugnedit/nontrans.jpg"></TD></TR></table>
</div>
<div align="justify">.<BR><BR>
If you choose to convert the page you will have the option to set greater inline 
formatting and add new 3D items, however text formatting will be lost, you will also have to set the width and height 
of your blog entry. Complex HTML pages should not be imported. If you are new to PlugNedit you may want to try a new blog entry before editing a imported page.<BR><BR>
    You can use Page Revisions in WordPress to Rollback your blog entry if you 
    find the new format not beneficial.<a href="http://en.support.wordpress.com/pages/page-revisions/" style="font-size:12px" target="_blank">Page 
    Revisions</a> <BR>
 </div><BR><BR>
<input type="button" id="PNE-page-import" Name="Import Page" value="Import Page" class="button-primary"  onClick="ProcessImportpage();" > &nbsp;&nbsp;<input onClick="document.getElementById('NoEditupper5').style.visibility='hidden'" type="Button" name="Cancel"  value="Cancel" class="button">
</div>


<div id="NoEditupper4" align="center" style="font-size:14px;visibility:hidden;border-bottom-color:black; border-style:solid; position:absolute; background-color:white; top:200px; left:300px; width:400px; height:200px; z-index:10000 ;opacity:1;filter:alpha(opacity=100)" >

<BR><BR><div align="center" id="PlugNeditConfirm">
PlugNedit needs to import links of your media files in order to use them! </div>
<div align="center">This may take a moment to process.<BR><BR> </div>
<input type="button" id="PNE-editor-Import" Name="Import Files" value="Import Files" class="button-primary"  onClick="ProcessUpdatePlugNedit();document.forms['PlugNeditFormGet'].submit();" > <input class="button" id="PNE-editor-NoImport" onClick="document.forms['PlugNeditForm'].submit();" type="Button" Name="Proceed Without Import" value="Proceed Without Import"> <input onClick="document.getElementById('NoEditupper4').style.visibility='hidden';if (document.getElementById('PlugNeditView')){document.getElementById('PlugNeditView').style.visibility='visible'}" type="Button" name="Cancel"  value="Cancel" class="button">
</div>

<input type="hidden" id="plugneditcontent" name="plugneditcontent" value="<?php echo $tempcontent ?>">
<form id="PlugNeditForm"  name="PlugNeditForm" method="post" action="http://plugnedit.com/wordpress.cfm"><textarea name="plugneditfiles" cols="1" rows="1" style="visibility:hidden;display:none">
<?php 
if ( current_user_can('upload_files') ) {
if(isset($_POST['GetPlugneditfiles'])) {
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
if (strtolower(substr($file2,-4)) == ".gif" ||strtolower(substr($file2,-4)) == ".jpg" || strtolower(substr($file2,-4))  == ".png" ){
 $plugneditfiles = "$plugneditfiles;$file2";
echo  str_replace($stringRplaceplugnedit,';',$file2);}}  
if(file_exists($file2) && is_dir($file2)){
$dir3 = "$file2/*";  
foreach(array_slice((array)glob($dir3),0,5000) as $file3)  
{ $file=$file3;
if (strtolower(substr($file3,-4)) == ".gif" || strtolower(substr($file3,-4)) == ".jpg" || strtolower(substr($file3,-4))  == ".png" ){
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

}}

?>
</textarea><?php if (isset($_POST["plugneditcontent"])) { ?>
<textarea id="plugneditreturncontent" cols="1" rows="1" style="visibility:hidden;display:none" name="plugneditreturncontent" ><?php if(isset($_POST['PlugNeditBinarycontent'])){$_POST['plugneditcontent'] = base64_decode($_POST['plugneditcontent']); };if(isset($_POST['plugneditcontent'])) { echo stripslashes($_POST['plugneditcontent']); }?></textarea>

<script language="JavaScript">
var Iframeview=''
if (!document.getElementById("PlugNeditView"))
{
Iframeview='<br><br><br><iframe id="PlugNeditView" class="wp-editor-area" src="" style="z-index:100000;width:99.9%;height:500px"></iframe><br><input type="button" class="button" value="Show WordPress Editor - WordPress editor uses auto formatting and may distort the look of the page." onclick="document.getElementById(\'wp-content-wrap\').style.visibility=\'visible\';PNEpreserveupdate=false">'
}
document.getElementById('wp-content-wrap').style.visibility='hidden'
if (!document.getElementById('post').getAttribute('onsubmit')){document.getElementById('post').setAttribute('onsubmit','PreservePNEcontent()') } else {
try{
 document.getElementById('post').setAttribute('onsubmit','PreservePNEcontent();'+document.getElementById('post').getAttribute('onsubmit')) 
 } catch(err){}
}
document.getElementById('postdivrich').innerHTML=Iframeview+document.getElementById('postdivrich').innerHTML;var x=document.getElementById("PlugNeditView");var y=(x.contentWindow || x.contentDocument);setTimeout("if (y.document)y=y.document;y.body.innerHTML=SubStringContentPlugnedit+document.getElementById('plugneditreturncontent').value",2000)
document.getElementById('content').value=document.getElementById('plugneditreturncontent').value
strContent=document.getElementById('plugneditreturncontent').value
</script>


<?php 
}

?>
<textarea id="PlugNeditContent" cols="1" rows="1" style="visibility:hidden;display:none" name="PlugNeditContent" ><?php if(isset($_POST['PlugNeditContent2'])) { if(isset($_POST['PlugNeditBinarycontent'])) {$_POST['PlugNeditContent2']=base64_encode(stripslashes($_POST['PlugNeditContent2']));} else {$_POST['PlugNeditContent2']=stripslashes($_POST['PlugNeditContent2']);}; echo $_POST['PlugNeditContent2'];}?></textarea>
<input type="hidden" id="PlugNeditFileUrl"  name="PlugNeditFileUrl" value="<?php echo esc_attr(get_option('upload_path')); ?>">
<input type="hidden" value="" id="SaveTheWhales" name="SaveTheWhales">
<input type="hidden" id="PlugNeditContent"  name="PlugNeditHomeUrl" value="<?php echo esc_attr(get_option('home')); ?>">
<input type="hidden" id="PlugNeditSiteId"  name="PlugNeditSiteId" value="">
<input type="hidden" id="PlugNeditBaseUrl"  name="PlugNeditBaseUrl" value="<?php echo $_SERVER['HTTP_HOST']; ?>">
<input type="hidden" name="PlugNeditReturnUrl" id="PlugNeditReturnUrl" value="<?php echo $currentUrl; ?>">
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
    }?>
	
	
<input type="hidden" name="PNEPageLinks" value="<?php echo $pneoutlinks ?>">
<input type="hidden" name="UpdatePFiles" value="0" id="UpdatePFiles">
<input type="hidden" name="PlugNeditVersion" value="Version 2.0" id="PlugNeditVersion">
</form>
<form action="#" method="post"  name="PlugNeditFormGet">
<!--[if IE]>
<input type="hidden" id="PlugNeditBinarycontent"  name="PlugNeditBinarycontent" value="1">
<![endif] -->
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
}?>
