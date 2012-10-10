<?php
ob_start();
session_start();
include "dbclass.php";
$con= new DBConnect();
$con->DBConnect();
$con->OpenConnection();
if($_GET['act']=='run'){?>
<? 
$ex5=$_SERVER['REQUEST_URI'];
$file5 = basename(rtrim($ex5, '/'));
$ssl=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".$_GET['q']."'"));
$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = '$ssl[term_id]' and tab1.term_id = tab2.term_id ");
$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);?> 
<select name="subcat" >
	<option value="">All Topics</option><?
	if($Sel_Sub_Cat_Num){	
		while($Sel_Sub_Cat_Fet = mysql_fetch_array($Sel_Sub_Cat)){?>
		<option <? if($file5==$Sel_Sub_Cat_Fet['slug'] || $subcat ==$Sel_Sub_Cat_Fet['slug']) echo "selected='selected'"?>value="<?=$Sel_Sub_Cat_Fet['slug']?>"><?=$Sel_Sub_Cat_Fet['name'];?></option>
	<?	}
	}?>
</select>
<?  }?>
<?
if($_GET['act']=='side_run'){
$ex5=$_SERVER['REQUEST_URI'];
$file5 = basename(rtrim($ex5, '/'));
	$ssl=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".$_GET['q']."'"));
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = '$ssl[term_id]' and tab1.term_id = tab2.term_id ");
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);?> 
	<select name="side_subcat"  class="m-left10">
  <option value="">All Topics</option><?
	if($Sel_Sub_Cat_Num){	
		while($Sel_Sub_Cat_Fet = mysql_fetch_array($Sel_Sub_Cat)){?>
			 <option <? if($file5==$Sel_Sub_Cat_Fet['slug'] || $subcat ==$Sel_Sub_Cat_Fet['slug']) echo "selected='selected'"?>value="<?=$Sel_Sub_Cat_Fet['slug']?>"><?=$Sel_Sub_Cat_Fet['name'];?></option>
<?	}
	}?>
	</select>
	<? }?>

