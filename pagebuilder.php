<?php
function PNEADDPAGE() {
add_menu_page('Plug N Edit Page Builder', 'Page Builder', 'unfiltered_html' , __FILE__, 'PnEPageBuilder', plugins_url( 'plugnedit/pneicon.ico' ));
}

if (  is_admin() ) {
function PnEPageBuilder() {
if( !get_option('pnefolder') ) {
include 'pneconfig.php';
$pnefilefolder = get_option('pnefolder');
} else {
$pnefilefolder = get_option('pnefolder');
}

if (strpbrk(get_option('pnefolder'), "\\/?%*:.|\"<>\ ") === FALSE && strlen(get_option('pnefolder')) > 0  ) {
} else {
echo 'Config file is not valid, please email contact@plugnedit.com for directions.';
exit();
}
include_once 'pnemed.php';
global $pnefilefolder;
if( isset( $_POST['PlugneditBGColor']) &&  strlen( $_POST['PlugneditBGColor'])){$pbgcolor=$_POST['PlugneditBGColor'];} else {$pbgcolor="#ffffff";}
if( isset( $_POST['PlugneditEditorMargin']) &&  strlen( $_POST['PlugneditEditorMargin'])){$pnemarginwidth=$_POST['PlugneditEditorMargin'];} else {$pnemarginwidth="755";}
if( isset( $_POST['PNEFavi']) &&  strlen( $_POST['PNEFavi'])){
$PNEFavicon='<link rel="icon" type="image/'.substr(strrchr($_POST['PNEFavi'],'.'),1).'" href="'.$_POST['PNEFavi'].'"/>';
} else {
$PNEFavicon='';
}
if(isset($_POST['PNEFileName'])) {
$PNECSSurl = plugin_dir_url( __FILE__ ) . 'css/style.css';
$PNEcontent = '<!DOCTYPE html><html><head><title>'.$_POST['PNETitle'].'</title><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><link rel="stylesheet" type="text/css" href="'.$PNECSSurl.'"><meta name="keywords" content="'.$_POST['PNEKeyWords'].'"><meta name="description" content="'.$_POST['PNEDescription'].'">'.$PNEFavicon.'</head><body style="margin:0px;min-width:'.$pnemarginwidth.'px;background-color:'.$pbgcolor.'"><div id="PNEPageBuilderContent">'.stripslashes($_POST['plugneditcontent']).'</div></body></html>';
$PNEFile="../".get_option('pnefolder')."/".str_replace(' ', '_', $_POST['PNEFileName']).".htm";
if (file_exists($PNEFile)){
unlink($PNEFile);}
if ($_POST['PNEDelete']!=1){
$handle = fopen($PNEFile, 'w') or die('Cannot open file:  '.$PNEFileName);
fwrite($handle, $PNEcontent);
}
}

if(isset($_POST['plugnedit_width'])) {
update_option('plugnedit_width',$_POST['plugnedit_width']);
update_option('pnemedcount',$_POST['pnemedcount']);
update_option('plugnedit_sitewidth',$_POST['plugnedit_sitewidth']);
if(isset($_POST['Pneunincode'])) { $univalue=strtolower($_POST['Pneunincode']);} else {$univalue='';}
update_option('pneunincode', $univalue);

if(isset($_POST['pneautosaves'])) { $pnesavevalue=strtolower($_POST['pneautosaves']);} else {$pnesavevalue='';}
update_option('pneautosaves', $pnesavevalue);

if(isset($_POST['pnejavascriptzoom'])) { $pnejavavalue=strtolower($_POST['pnejavascriptzoom']);} else {$pnejavavalue='';}
update_option('pnejavascriptzoom', $pnejavavalue);
}
?>


<script language="JavaScript" type="text/javascript">

<?php if ( get_option('pneunincode') == 'checked' ) {
echo 'YBSDPNE=true';  } else {echo 'YBSDPNE=false';}
?>

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


function toHex(n) {
    n = parseInt(n);
    if (isNaN(n) || n == 0 || n == 00) return "00";
    n = Math.max(0, Math.min(n, 255));
    return "0123456789ABCDEF".charAt((n - n % 16) / 16) + "0123456789ABCDEF".charAt(n % 16);
}

 
function colorToHex(SortC) {
    if (SortC.match('rgb')) {
        var digits = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(SortC);
        var red = toHex(parseInt(digits[2]));
        var green = toHex(parseInt(digits[3]));
        var blue = toHex(parseInt(digits[4]));
        return red + green + blue
    } else return SortC.replace('#', '');
}

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
//var head=innerDoc.getElementsByTagName("head")[0].innerHTML
var keywords='';
var description='';
var favicon='';
var metas = innerDoc.getElementsByTagName('meta');
var favi= innerDoc.getElementsByTagName('link');
    if (metas) {
        for (var x=0,y=metas.length; x<y; x++) {
            if (metas[x].name.toLowerCase() == "keywords") {
                keywords += metas[x].content;
            }
			
			   if (metas[x].name.toLowerCase() == "description") {
                description += metas[x].content;
            } 
	
			
        }
    }
	
	    if (favi) {
        for (var x=0,y=favi.length; x<y; x++) {
            if (favi[x].rel.toLowerCase() == "icon") {
               favicon += favi[x].href;
            }
			
        }
    }
	

	document.getElementById('PNEKeyWords').value=keywords;
	document.getElementById('PNEDescription').value=description; 
    document.getElementById('PNEFavi').value=favicon; 
		
		
		//	document.getElementById('PNEHeader').value=head; 
<?php if(!isset($_POST) && !isset( $_POST['PlugneditBGColor']) &&  !strlen($_POST['PlugneditBGColor'])){ ?>
document.getElementById('PlugneditBGColor').value='#'+colorToHex(innerDoc.body.style.backgroundColor)
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
document.getElementById('PNEditorBgColor').value='#'+colorToHex(innerDoc.body.style.backgroundColor)
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
} catch(err){

}
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
global $pnefilefolder;
$dirname = "../".get_option('pnefolder');
if (!file_exists('../pnehtml')){ wp_mkdir_p('../pnehtml');};
$dir = "../".get_option('pnefolder')."/*";
$dirnamereplace = "../".get_option('pnefolder')."/";
$PNEHTMLGlob=glob($dir);

if (is_array($PNEHTMLGlob)){
$plugneditHTMLfiles='';
foreach(array_slice($PNEHTMLGlob,$PNEStart,$PNEEnd) as $file)  
{ 
if (substr($file,-4) == ".htm"){
$plugneditHTMLfiles = "$plugneditHTMLfiles;$file";}
}}
?>
<div>
<div style="width:750px;text-align:justify">
<h1 style="color:gray;font-size:11px;font-style:normal;font-family:Tahoma">Administrator: Only users that are Administrator or Editor Roles can use the editor due to WordPress unfiltered HTML rules. </h1>
<br>
<div style="color:#21759B;font-size:12px;font-weight:bolder;padding:20px;background-color:white;width:800px">
<img src="../wp-content/plugins/plugnedit/pnehead.png"><br><br>
<a href="../wp-content/plugins/plugnedit/index.html" target="_blank" style="font-size:18px">Video tutorials & examples.</a><br><br>
<span style="font-size:20px;color:black;font-weight:bolder">
Plug N Edit builds 3 types of pages.
</span>
<br><br><br>
<span style="font-size:16px;color:black">
1.  Normal Posts & Pages.</span><br>
Normal blog post and page inside your WordPress template.
<br>
For normal pages go to "Add New Post" or "Add New Page" in wordpress admin menu and click the PNE Page Builder button.<br>
<br>
<span style="font-size:16px;color:black">
2. Themeless Pages.
</span><br>
Creates pages inside your WordPress site on a blank page (Short Codes And Plugins Work On Page).
<br>
For themeless pages go to "Add New Post" or "Add New Page" in wordpress admin menu and click the PNE Page Builder button.<br>
In the editor click the options menu and check the checkbox labeled "Themeless Page" .
 <br><br>
 <span style="font-size:16px;color:black">
3. Independent Pages.
</span>
<br>
Creates single pages outside your WordPress Site (No Plugins).
To create independent pages outside of your WordPress environment, use the page builder below. Click "Create New Page" to start.
</span><br><br>
<script>
function checkpneoption(z,k,r){
if(/\D/.test(k) || k=='' || k < 0 || k > 2000 ){alert('Number of imports must be numeric and less then 2000');return false;} 
if(/\D/.test(z) || z=='' || /\D/.test(r) || r==''){alert('Width option must be numeric');return false;} else {
if (z > 2000 || z < 300){var r = confirm("Typically widths should be between 800 - 1600   Please confirm you want this setting.");
if (r == true){return true; } else {return false;}
} else{return true;}
}


}
</script>
<br><br>
Width setting for pages and single post: <form  name="PNEoptions" onSubmit="return checkpneoption(document.getElementById('plugnedit_width').value,document.getElementById('pnemedcount').value,document.getElementById('plugnedit_sitewidth').value); " action="#" method="post">
<input id="plugnedit_width" type="text" value="<?php echo get_option('plugnedit_width'); ?>" name="plugnedit_width" style="width:100px" >PX  &nbsp;&nbsp;
<br><br>
Front page width settings for multiple posts. (Default 0 for not in use, standard setting 800-1200 px):
<br><input id="plugnedit_sitewidth" type="text" value="<?php echo get_option('plugnedit_sitewidth'); ?>" name="plugnedit_sitewidth" style="width:100px" >PX  &nbsp;&nbsp;
<br><br>
Custom CSS URL <a href="http://plugnedit.com/cssdir.html">How to set custom CSS for plugnedit.</a><br>
<span style="font-size:11px">Default Setting: <?php echo $PNECSSurl = plugin_dir_url( __FILE__ ) . 'css/style.css'; ?> </span>
<br>
This setting cannot be changed in this version.<br>
<input id="plugnedit_ssurl"   type="text" value="<?php echo get_option('pnecsslink'); ?>" name="plugnedit_cssurl" style="width:300px;font-size:11px" disabled >  &nbsp;&nbsp;
<br>
<br>Number of media files to import (Higher numbers takes longer to load PlugNedit.): <br><input id="pnemedcount" type="text" value="<?php echo get_option('pnemedcount'); ?>" name="pnemedcount" style="width:100px" >
<br>
<br>Use Encoded HTML: <input type="checkbox" name="Pneunincode" value="checked" <?php  echo get_option('pneunincode'); ?>> <span style="color:red"> Uncheck if you experience problems saving or loading pages.</span>
<br>


<br><input type="checkbox" name="pneautosaves" value="checked" <?php  echo get_option('pneautosaves'); ?>> Autosave pages on plugnedit server. (Keeps a snapshots of last 120 minutes of work.)
<br>

<br><input type="checkbox" name="pnejavascriptzoom" value="checked" <?php  echo get_option('pnejavascriptzoom'); ?>> Use javascript to enhance screen fit. (Current version requires this to be enabled for adapted mobile pages.)
<br>






<br><input type="submit" name="Update Options" value="Update Options">
</form>
</div>
<br>


<span style="color:#21759B;font-size:12px">
Do not use PlugNedit for any type of sensitive or personal information (General Public Pages Only). <BR> 
</span>

<span style="color:gray;font-size:12px">
For blog entries and pages built within your WordPress template, use the button labeled "PlugNedit Page Builder" In the Post or Pages menu. 
This section of PlugNedit is for creating pages outside of your Wordpress environment. In order to use PlugNedit you will need to import links to your media.
HTML files are saved in your wordpress root in folder pnehtml. 
Adding HTML or editing file by hand may make it non-editable in Plug N Edit. </span><BR><BR>
</div>
&nbsp;&nbsp;&nbsp;<a href="http://plugNEdit.com" target="_blank" style="font-size:13px">Plug & Edit Home Page</a> &nbsp;&nbsp;&nbsp;<a href="mailto:contact@plugnedit.com" style="font-size:13px">Support Email: Contact@plugnedit.com</a><br><br><br>
<?php
if (is_multisite() ) { 
echo "Multisite can build WordPress pages and post, however the stand alone page builder is not multisite capable.";
} else {
?>
<table style="font-family: Arial, Arial, Helvetica, sans-serif; font-size: 18px; background-color: rgb(35, 86, 125); border: 1px solid rgb(0, 0, 0); padding: 3px; border-spacing: 6px; width: 750px;  text-align: left; margin: 3px; word-wrap: break-word; letter-spacing: normal; line-height: normal; font-weight: normal; color: rgb(0, 0, 0); border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px; box-shadow: rgb(255, 255, 255) 7px 7px 5px; background-image: linear-gradient(rgb(29, 77, 94), rgb(116, 152, 173));"><tr style="border:black 2px solid;color:white;text-shadow: -1px -1px #333, 1px 1px #333;height:35px"><td style="width:200px">Page Name</td><td>Preview</td><td>URL</td><td>Edit Meta</td><td>Edit Page</td></tr>
<?php		 

$arrayp = explode(';', $plugneditHTMLfiles); 
foreach($arrayp as $value) 
{
if ($value != ''){
echo '<TR><td style="font-size:16px;color:white;font-weight:bolder;text-shadow: -1px -1px #333, 1px 1px #333">';
echo str_ireplace('_',' ',str_ireplace('.htm','',str_ireplace($dirnamereplace,' ',$value)));
echo '</td><td style="font-size:10px;font-weight:bold;color:white">';
echo '<a class="button" href="';
echo $value.'?k='.rand(10000,10000000); 
echo '" target="_blank">Preview Page</a>';
echo '</td><td style="font-size:10px;font-weight:bold;color:white"><input type="text" value="';
echo esc_attr(get_option('home'));
echo str_ireplace('..','',$value);
echo '"></td><td style="font-size:10px;font-weight:bold;color:white">';
echo '<a class="button" onclick="Loadpne(\''; echo $value;  echo '\',\''; echo str_ireplace('.htm','',str_ireplace($dirnamereplace,'',$value)); echo '\',1)">Manage Page</a>';
echo '</td><td style="font-size:10px;font-weight:bold;color:white">';
echo '<input type="submit" name="PNEPUBLISH"  id="publish" class="button-primary" value=" Edit Page In Plug N Edit " onclick="Loadpne(\''; echo $value;  echo '\',\''; echo str_ireplace('.htm','',str_ireplace($dirnamereplace,'',$value)); echo '\',0)">';
echo '</td></tr><tr><td colspan=5><hr size="1px" width="700px"></tr> ';
}}
echo '</table></div><BR>';
if($PNEStart > 19){
$PNEStart=$PNEStart-20;
echo '&nbsp;&nbsp;<a style="font-size:16px;font-weight:bold;color:white" href="admin.php?page=plugnedit/pagebuilder.php&PNENEXT='; echo $PNEStart; echo ' ">Previous</a>';
};

if($PNEEnd < count($PNEHTMLGlob)){
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a style="font-size:16px;font-weight:bold;color:white" href="admin.php?page=plugnedit/pagebuilder.php&PNENEXT='; echo $PNEEnd; echo ' ">Next</a>';
};


?>
<script language="JavaScript" type="text/javascript">
function checkField(fieldname)
{
fieldname.value=fieldname.value.replace(/_/g," ")

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
<input type="hidden" name="PNEcustomcss" value="<?php echo plugin_dir_url( __FILE__ ) . 'css/style.css' ?>">
<input type="hidden" name="PNEWpMEd" value="<?php echo get_bloginfo('url'); ?>">
<textarea id="PlugNeditContent" cols="1" rows="1" style="visibility:hidden;display:none" name="PlugNeditContent"></textarea>
<input type="hidden" id="PlugNeditFileUrl"  name="PlugNeditFileUrl" value="<?php echo esc_attr(get_option('upload_path')); ?>">
<input type="hidden" id="PlugNeditHomeUrl"  name="PlugNeditHomeUrl" value="<?php echo esc_attr(get_option('home')); ?>">
<input type="hidden" id="PlugNeditBaseUrl"  name="PlugNeditBaseUrl" value="<?php echo $_SERVER['HTTP_HOST']; ?>">



<?php if ( get_option('pneunincode') == 'checked' ) {
?>
<input type="hidden" id="PlugNeditBinarycontent"  name="PlugNeditBinarycontent" value="1">
<?php
}

?>
<input type="hidden" name="PNEPageLinks" value="<?php echo PNEOlinks();?>">
<input type="hidden" name="PNEAutosaves" value="<?php echo get_option('pneautosaves');?>">
<input type="hidden" name="PlugNeditReturnUrl" id="PlugNeditReturnUrl" value="">
<input type="hidden" name="PlugNeditFileName" id="PlugNeditFileName" value="">
<input type="hidden" id="marginwidth" name="marginwidth" value="755">
<input type="hidden" name="PluginType" value="StandAlone">
<input type="hidden" name="DisplayLogo" value="0">
<input type="hidden" id="PNEditorBgColor" name="PNEditorBgColor" value="">
<input type="hidden" name="PNEPluginSection" value="WP_PageBuilder">

<input name="marginheight" id="marginheight" type="hidden" value="20000">

<textarea name="plugneditfiles" cols="1" rows="1" style="visibility:hidden;display:none"><?php echo  PNEMedfile(); ?></textarea>
</form>
<BR><BR>  &nbsp;&nbsp;<input type="button" name="publish2" id="publish2" class="button-primary" value="  Create New Page  " onClick="javascript:if (document.getElementById('ByPassFiltering')){document.getElementById('ByPassFiltering').value=document.URL;};document.getElementById('PlugNeditReturnUrl').value=document.URL;document.getElementById('PlugNeditContent').value=' ';document.getElementById('PNEUPDATEID1').reset();document.getElementById('PlugNeditFileName').value='';document.forms['PNEPageBuilder'].submit()" >  


<iframe src="" onload="frameloaded()" id="PNELoadpage" style="background-color:white;position:absolute;top:0px;left:0px;visibility:hidden;width:0px;height:0px;z-index:1;overflow:hidden">
</iframe>
<div id='PNEMETA'  style="padding:6px;background-color:white;position:fixed;top:50px;left:200px;visibility:hidden;width:600px;height:600px;z-index:10000;border-color:blue;border-width:2px;border:solid">
<BR><span style="font-size:16px;font-weight:bold;color:#21759B">File Name:</span><span style="font-size:12px;font-weight:bold"> (Example: ACME Rockets)</span> <BR>
<form name="PNEUPDATE" id="PNEUPDATEID1" method="post" action="#"  onsubmit="return validateThisForm()">
<input type="text" id="PNEFileName" name="PNEFileName" value="" onblur="checkField(this)" maxlength="16" size="16" style="font-size:12px;font-weight:bold;color:red"><BR><BR>
<input type="hidden" id="PNEDelete" name="PNEDelete" value="0">
<span style="font-size:16px;font-weight:bold;color:#21759B">Title Of Page:</span><span style="font-size:12px;font-weight:bold"> (Example: ACME Rockets Work Best)</span> <BR>
<input type="text" id="PNETitle" name="PNETitle" value="" maxlength="200" size="60" style="font-size:12px;font-weight:bold;color:red"><BR><BR>
<BR>
<span style="font-size:16px;font-weight:bold;color:#21759B">Keywords:</span><span style="font-size:12px;font-weight:bold"> (Example: Rockets, Acme, Best Rockets )</span> <BR>
<input type="text" Id="PNEKeyWords" name="PNEKeyWords" value="" maxlength="300" size="60" style="font-size:12px;font-weight:bold;color:red"><BR><BR><BR>
<input type="hidden" name="PNEUpdate" value="1">
<input type="hidden" id="PlugneditBGColor" name="PlugneditBGColor" value="<?php echo $pbgcolor; ?>" >
<input type="hidden" id="PlugneditEditorMargin" name="PlugneditEditorMargin" value="<?php echo $pnemarginwidth; ?>" >

<span style="font-size:16px;font-weight:bold;color:#21759B">Description:</span><span style="font-size:12px;font-weight:bold"> (Example: This page is about the superior workmanship of Acme Rockets. )</span><BR> 
<input type="text" name="PNEDescription" id="PNEDescription" value="" maxlength="10000" size="60" style="font-size:12px;font-weight:bold;color:red"><BR><BR>
    <span style="font-size:16px;font-weight:bold;color:#21759B">Favicon:</span><span style="font-size:12px;font-weight:bold"> 
    Favorite Icon. (Example: http://mysite/myicon.ico)</span><span style="font-size:12px;font-weight:bold;color:red"> 
    Not Required:</span><br>
<input type="text" name="PNEFavi" id="PNEFavi" value="" maxlength="10000" size="60" style="font-size:12px;font-weight:bold;color:red"><BR><BR>

<input type="submit" name="publish" id="publish" class="button-primary" value="    Publish    " > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <input type="Button" onClick="javascript:document.getElementById('PNEDelete').value=1;document.forms['PNEUPDATE'].submit();" name="PNEDeletebutton" id="PNEDeletebutton" value="    Delete Page    " class="button button-highlighted"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Button" onClick="javascript:document.getElementById('PNEMETA').style.visibility='hidden';document.getElementById('plugneditcontent').style.display='none'" name="PNECancel" id="PNECancel" value="    Cancel    " class="button button-highlighted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Button" onClick="document.getElementById('plugneditcontent').style.display='';document.getElementById('plugneditcontent').style.visibility='visible'" name="HTMLSource" id="HTMLSource" value="    HTML Source    " class="button button-highlighted">
<br>
<textarea   style="visibility:hidden;display:none;width:580px;height:230px"  id="plugneditcontent" name="plugneditcontent" ><?php if(isset($_POST['PlugNeditBinarycontent'])){$_POST['plugneditcontent'] = base64_decode($_POST['plugneditcontent']); };if(isset($_POST['plugneditcontent'])) { echo stripslashes($_POST['plugneditcontent']); }?></textarea>


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


}}}
add_action('admin_menu', 'PNEADDPAGE');
 

 ?>