
<!DOCTYPE html>
<head><title>IE Filter Bypass</title></head>
<body>

<?php if (is_admin() ) { ?>



<form name="PNEPageBuilder" method="post" action="<?php echo $_POST['PnePostingPage'] ?>">


<?php
if( isset( $_POST['FilterBypass']) &&  strlen( $_POST['FilterBypass'])){
$PNEFILETEMP="../PNEHTML/PNETempContent.txt";

?>

<textarea id="plugneditcontent" cols="10" rows="10" style="visibility:hidden;display:none" name="plugneditcontent"><?php echo file_get_contents($PNEFILETEMP) ?></textarea>


<?php

unlink($PNEFILETEMP);

} else{
$dirname = '../PNEHTML';
if (!file_exists($dirname)) wp_mkdir_p($dirname);
$PNEFileFilter="../PNEHTML/PNETempContent.txt";
$handleFilter = fopen($PNEFileFilter, 'w');
fwrite($handleFilter, stripslashes($_POST['plugneditcontent']));
?>
<input type="hidden" name="PNEByPassFiltering" value="1">
<?php
}
?>
<input type="hidden" name="PnePostingPage" value="<?php echo $_POST['PnePostingPage'] ?>">
<input type="hidden" name="Bypass" value="<?php echo $_POST['PnePostingPage'] ?>">
<input type="hidden" name="FilterBypass" value="1">
<?php 
if( isset( $_POST['PlugneditEditorMargin']) &&  strlen( $_POST['PlugneditEditorMargin'])){?>
<input type="hidden" id="PlugneditEditorMargin" name="PlugneditEditorMargin" value="<?php echo  $_POST['PlugneditEditorMargin'] ?>">
<?php }
if( isset( $_POST['PlugneditBGColor']) &&  strlen( $_POST['PlugneditBGColor'])){?>
<input type="hidden" id="PlugneditBGColor" name="PlugneditBGColor" value="<?php echo  $_POST['PlugneditBGColor'] ?>">
<?php }
if( isset( $_POST['PlugNeditFileName']) &&  strlen( $_POST['PlugNeditFileName'])){?>
<input type="hidden" id="pnefilename" name="PlugNeditFileName" value="<?php echo $_POST['PlugNeditFileName'] ?>">
<?php }  ?>


Due To Internet Explorers Filters You Will Need To Manual Submit This Content To Verify It.<BR>
<BR>
<input type="Submit" name="Submit Content" value="Submit">
</form>

<?php
if( isset( $_POST['FilterBypass']) &&  strlen( $_POST['FilterBypass'])){ ?>
<script language="JavaScript">
document.forms['PNEPageBuilder'].submit()
</script>
<?php } ?>
</body>
</html>
<?php } 

die()
 ?>
