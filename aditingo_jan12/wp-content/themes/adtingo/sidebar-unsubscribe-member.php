<?php
$object=new main(); 
/*$MemberEmail=base64_decode($_REQUEST['mid']);
echo $MemberEmail;exit;*/
if($_POST['unsub_submit']){
	extract($_POST);
	//$MemberEmail=base64_decode($_REQUEST['mid']);
	$MemberEmail=$_REQUEST['mid'];
	$CampaignID=base64_decode($_REQUEST['cid']);
	$getAreaId=mysql_fetch_array(mysql_query("SELECT tab6.area_id FROM campaign_posts AS tab1, wp_posts AS tab2, wp_term_relationships AS tab3, `wp_term_taxonomy` AS tab4, wp_terms AS tab5, `tbl_metropolitian_list` AS tab6
WHERE tab1.campaign_id =$CampaignID AND tab1.post_id = tab2.ID AND tab2.ID = tab3.object_id AND tab3.term_taxonomy_id = tab4.term_taxonomy_id AND tab4.parent = tab5.term_id AND tab5.term_id = tab6.cat_id"));
	//echo $MemberEmail;exit;
	//print_r($_POST);exit;
	//echo $getAreaId['area_id'];exit;
	$msg=0;
	//echo $size."<br>".sizeof($chk);
	if($size==sizeof($chk))
		$msg=1;
	else{
		$sel_Member=mysql_fetch_array(mysql_query("select * from tbl_members where email_address='$MemberEmail'"));
		$delMemberMetro=mysql_query("delete from tbl_member_metropolitian where memberid=$sel_Member[memberid]");
		if($delMemberMetro){
			for($i=0;$i<sizeof($chk);$i++){
				$insMemberMetro=mysql_query("insert into tbl_member_metropolitian (area_id,memberid) values($chk[$i],$sel_Member[memberid])");
			}
			$selMemberMetroCheck=mysql_num_rows(mysql_query("select * from tbl_member_metropolitian where area_id=$getAreaId[area_id] and memberid=$sel_Member[memberid]"));
			if(!$selMemberMetroCheck){
				$insUnsubscribe=mysql_query("insert into `tbl_unsubscribe` (`memberid`, `email`, `areas`, `date`, `campaign_id`) values ($sel_Member[memberid], '$MemberEmail', $getAreaId[area_id], now(), $CampaignID )");
			}
			$msg=2;
		}
	}
}
if($msg==1)
$mess="You are not Deselect any area to Unsubscribe";
elseif($msg==2)
$mess="You have been successfully Unsubscribed from Deselcted Area.";
?>
<div class="content-cont-inner">
	<div class="content-left">
		<div id="div-Form">
			<div class="form-title">Unsubscribe</div>
			<div style="clear:both"></div>
			<div><p>&nbsp;</p>
				Currenty Your are Subscriber for below Areas. If you no longer wish to receive any emails from below Areas please Uncheck the check box and press Submit button to unsubscribe from that Area.</div>
			
			<div align="center" class="errer-mess1"><?php  echo "<br>".$mess; ?></div>
			<div class="register-form" align="center">
			<div align="center" class="errer-mess2"></div>
			<form method="post" action="">
			<table align="center" width="80%">
			<tr>
			<?php
			if($_REQUEST['mid']!="")
			{
				//$MemberID=base64_decode($_REQUEST['mid']);
				$MemberEmail=$_REQUEST['mid'];
				$GetDataFromId=mysql_query("SELECT * FROM `tbl_members` tab1, `tbl_member_metropolitian` tab2, `tbl_metropolitian_list` tab3 WHERE tab1.email_address = '$MemberEmail' AND tab2.memberid = tab1.memberid AND tab2.area_id = tab3.area_id");
				$cols=mysql_num_rows($GetDataFromId);
				if($cols){
				$row=2;
					for($i=0;$ResDataFromId=mysql_fetch_array($GetDataFromId);$i++){
						echo "<td width='33%' height='30'><input type='checkbox' name='chk[]' checked='checked' value=".$ResDataFromId['area_id']." />&nbsp;&nbsp;".$ResDataFromId['area_name']."</td>";
						if($row==$i){ echo "</tr></tr>"; $row=$row+3;}
					}
				}else{
					$err_msg="Invalid Link";
				}
			}
			?>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr><td colspan="3"><input type="hidden" value="<?=$cols?>" name="size" /><input type="submit" name="unsub_submit" value=" "  class="submit-bt" /></td></tr>
			</table>
			
			</form>
			
			<div class="signup"> </div>
			</div>
		</div>
	</div>
<?php get_sidebar('adtingo2'); ?>  
</div>
