<?php 
$nav=7;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('../includes/values.php'); 


//********* START CODE FOR UPDATING PROFILE **************//
if(isset($_REQUEST['button3']) && $_REQUEST['button3']!='')
{	
extract($_POST);

if($_REQUEST['area_id']=='')
{	
	$errchk=sprintf("select * from tbl_metropolitian_list where area_name='%S'",$object->stripper($_POST['areaname']));
	$errchkext=$object->ExecuteQuery($errchk);
	$cols=$object->NumRows($errchkext);
	if($cols==0){
		$insertcatInfo=sprintf("insert into tbl_metropolitian_list(area_name,status) values('%s',%d)",$object->stripper($_POST['areaname']),'1'); 
		$QryinsertareaInfo=$object->ExecuteQuery($insertcatInfo);
		$msg="added";
		
	$iid=mysql_insert_id();
	$msg="added";
	$cat_slug1=str_replace(" ","-",$areaname);
	$cat_slug=strtolower($cat_slug1);
	include('add_cats.php');	
	$terms_ins=mysql_query("insert into wp_terms (name, slug) values ('$areaname','$cat_slug')");
	
	$getterms=mysql_fetch_array(mysql_query("select * from wp_terms order by term_id desc limit 0,1"));
	
	$tbl=mysql_query("update `tbl_metropolitian_list` set cat_id='$getterms[term_id]' where area_id='$iid' ");
	
	$terms_ins=mysql_query("insert into `wp_term_taxonomy` (term_id, taxonomy, parent) values ('$getterms[term_id]', 'category', 0)");
	for($i=0; $i<sizeof($arr);$i++){
		$terms_sub_ins=mysql_query("insert into wp_terms (name, slug) values ('".$arr[$i]."', '".$arr_slug[$i]."')");
		$getterms_sub=mysql_fetch_array(mysql_query("select * from wp_terms order by term_id desc limit 0,1"));
		$terms_ins=mysql_query("insert into `wp_term_taxonomy` (term_id, taxonomy, parent) values ('$getterms_sub[term_id]', 'category', '$getterms[term_id]')");
			
		$concat.="i:".$i.";i:".$getterms_sub[term_id].";";
		$rewrite.=str_replace('hyderabad', $cat_slug, $replacecontent);
	}
	$concat.="}}";
	$tval=$option_val.$concat;
	$upd=mysql_query("update `wp_options` set `option_value` = '".$tval."' where `option_name` = 'category_children'");
		
	$option_rewrite= explode($explode_string,$option_rule);
	$opt=$option_rewrite[0].$rewrite.$option_rewrite[1];
		
	$upd=mysql_query("update `wp_options` set `option_value` = '".$opt."' where `option_name` = 'rewrite_rules'");
	}else{
	$msg="City Name already exists";
	}
}
else
{
	$errchk=sprintf("select * from tbl_metropolitian_list where area_name='%S'",$object->stripper($_POST['areaname']));
	$errchkext=$object->ExecuteQuery($errchk);
	$cols=$object->NumRows($errchkext);
	if($cols==1){
		 $updatecatinfo=sprintf("update tbl_metropolitian_list set  area_name='%s' where  area_id=%d",$object->stripper($_POST['areaname']),$object->stripper($_REQUEST['area_id'])); 
$QryinsertareaInfo=$object->ExecuteQuery($updatecatinfo);
$msg="update"; 
$iid=$_REQUEST['area_id'];
	$fet=mysql_fetch_array(mysql_query("select * from tbl_metropolitian_list where area_id='$iid'"));
	$concat.="i:".$getterms[term_id].";a:12:{";
	$cat_slug1=str_replace(" ","-",$areaname);
	$cat_slug=strtolower($cat_slug1);
		include('add_cats.php');
	$terms_ins=mysql_query("update wp_terms set name='$areaname', slug='$cat_slug' where term_id='$fet[cat_id]'");
	
	$arr_term=array();
	$term_id_query=mysql_query("select * from wp_term_taxonomy where parent='$fet[cat_id]' order by term_id asc");
	for($j=0;$term_id_fet=mysql_fetch_array($term_id_query);$j++){
		$arr_term[$j]=$term_id_fet['term_id'];
	}	
	for($i=0; $i<sizeof($arr);$i++){
		$terms_sub_ins=mysql_query("update wp_terms set name='".$arr[$i]."', slug='".$arr_slug[$i]."' where term_id='".$arr_term[$i]."'");
			
		$concat.="i:".$i.";i:".$getterms_sub[term_id].";";
		$rewrite.=str_replace('hyderabad', $cat_slug, $replacecontent);
	}
	$concat.="}}";
	$tval=$option_val.$concat;
	$upd=mysql_query("update `wp_options` set `option_value` = '".$tval."' where `option_name` = 'category_children'");
		
	$option_rewrite= explode($explode_string,$option_rule);
	$opt=$option_rewrite[0].$rewrite.$option_rewrite[1];
		
	$upd=mysql_query("update `wp_options` set `option_value` = '".$opt."' where `option_name` = 'rewrite_rules'");
	}else{
	$msg="City Name already exists";
	}
}
	
	if($QryinsertareaInfo)
	{
		header("Location:managearealist.php?msg=$msg&page=".$_POST['page']);
		exit;
		
	}
		
 }
//********* END CODE FOR UPDATING PROFILE **************//
//************** START DISPLAY PROFILE VALUES ************//
$SqlGetareaDetails=sprintf("select * FROM tbl_metropolitian_list  where area_id=%d ",$object->stripper($_REQUEST['area_id']));
$QryGetareaDetails=$object->ExecuteQuery($SqlGetareaDetails);
$QryGetareaDetailsRec=$object->FetchArray($QryGetareaDetails);
//************** END DISPLAY PROFILE VALUES ************//
if($_REQUEST['area_id']=='')
	$title='Add';
else
	$title='Edit';
?>





 <table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
</table>
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="customerGrid_table">
              <thead>
              
              <tr>
                <td width="83%" height="100" align="left" class="tr5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  
                  <tr>
                    <td height="20" align="left" class="content-header"> Manage Metropolitian Areas</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
				  <?php
 if($_REQUEST['msg']=="del")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Track has been deleted successfully</font></td></tr>
<?php } ?><tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'><?php echo $msg;?></font></td></tr>
                </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="right">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="28" align="left" class="form-headings"><?php echo $title;?> </td>
                    </tr>
                    
                    <tr>
                      <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
                        <thead>
                          
                         
                          <tr>
                            <td width="12%" align="left" class="tr2">
						<table width="100%" border="0" cellspacing="5" cellpadding="0">
<tr>
<td width="50%"  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
<form name="frmchart" action="" method="post" onsubmit="return validateMetroArealist();">
<input id="page" name="page" type="hidden" value="<?php echo $_REQUEST['page'];?>" /> 
<tr>
<td width="30%" height="10" align="left"></td>
<td width="70%" height="10" align="left"></td>
</tr>
			
		  <tr>
			<td height="30" align="left"><strong>Metropolitian Name</strong></td>
			<td align="left"><input name="areaname" id="areaname" type="text" class="input2" value="<?php echo stripslashes($QryGetareaDetailsRec['area_name']);?>" onblur="member_citycheck(this.value,'cityerr')" />
			<input type="hidden" id="cityerr" name="cityerr">
			<?php
			$displaycat=mysql_fetch_array(mysql_query("SELECT * FROM `wp_options` WHERE `option_name` = 'category_children'"));
$option_val= str_replace(";}}",";}",$displaycat['option_value']);
	
			$displaycatrewrite=mysql_fetch_array(mysql_query("SELECT * FROM `wp_options` WHERE `option_name` = 'rewrite_rules'"));
$option_rule=$displaycatrewrite['option_value'];
			?>
			<input type="hidden" name="option_val" value="<?php echo $option_val?>" />
			<input type="hidden" name="option_rule" value="<?php echo $option_rule?>" />
			</td>
		  </tr>
		  
		  
		  <tr>
			<td height="30" align="left">&nbsp;</td>
			<td align="left">
			  <input name="button3" type="submit" class="button" id="button3" value="Submit" />
								  </td>
		  </tr>
			
		  </form>
		   
		  <tr><td>&nbsp;</td></tr>
		</table></td>
<td width="50%" valign="top">	
		</td></tr>
							
			
</table>       
							 
			
			      
			 </td>
  </tr>
</table>
						
  
  </td>
                            </tr>
                        
                        <tbody>
                        </tbody>
                      </table></td>
                    </tr>
                  </table></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
     <?php include('includes/footer.php'); ?>