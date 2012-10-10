<?php 
$nav=9;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');

if(isset($_REQUEST['delid']) && $_REQUEST['delid']!='')
{
	$tid=$_REQUEST['delid'];
	//$GETMessRes=$object->DeleteData("tbl_campaigns","campaign_id=$mid");
	$GETMessRes="update tbl_email_template_content set template_status=0 where TId=".$tid."";
	//$GETMessResqry=mysql_query($GETMessRes);
	$GETMessResqry=$object->ExecuteQuery($GETMessRes);
	if($GETMessResqry)
	{
		header("Location:manage_email_templates.php?msg=deleted");
		exit;
	}
	
}
if($_REQUEST['status']!='')
{
	if($_REQUEST['status']==2)
		$msg='Deact';
	else
		$msg='Act'; 
	
	$QryupdateUserStatus=sprintf("update tbl_email_template_content set template_status='%s' Where TId	=%d",$object->stripper($_REQUEST['status']),$object->stripper($_REQUEST['eid']));
	$ResupdateUserStatus=$object->ExecuteQuery($QryupdateUserStatus);
	if($ResupdateUserStatus)
	{
		header("Location:manage_email_templates.php?msg=$msg&page=".$_REQUEST['page']);
		exit;
	}
	
}
$SqlGetEmailTemplates="select * from tbl_email_template_content where template_status!=0 order by TId desc";
$ResGetEmailTemplates=$object->ExecuteQuery($SqlGetEmailTemplates);
$cols=$object->NumRows($ResGetEmailTemplates);
	if(!isset($_REQUEST['page']))
		$page=1;	
	else
		$page=$_REQUEST['page'];	
	
	$let_infe=ceil($cols/$limit);
	if($_REQUEST['limit']!='')
	{
		$limit=$_REQUEST['limit'];
	}	
	else
	{
		$limit=10;		
	}	
	
	 $getPaginationRecords=$object->paginationTop($cols,$limit,$page);
	$SqlGetCampaigns=$SqlGetEmailTemplates." LIMIT $getPaginationRecords,$limit";
	 $SqlGetCampaignres=$object->ExecuteQuery($SqlGetCampaigns);
	//echo $SqlGetCampaigns;

 ?>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="36%" height="30">&nbsp;</td>
    <td width="14%">&nbsp;</td>
	<td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Manage Email Templates</td>
  <td width="14%" class="errer-mess2"></td>
   <td height="20" align="left"><div align="right"><a href="create_email_template.php">Create Email Templates</a></div></td>
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="3"></td>
  </tr>
  

</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="errer-mess2"><?php if($_REQUEST['msg']=='edit') {?>
      Email Template has been updated successfully
      <?php } ?>
	  <?php if($_REQUEST['msg']=='added') {?>
      Email Template has been added successfully
      <?php } ?>
	   <?php if($_REQUEST['msg']=='deleted') {?>
      Email Template has been deleted successfully
      <?php } 
	  if($_REQUEST['msg']=="Deact")
{
?>
 Email Template  has been deactivated successfully
<?php
}
if($_REQUEST['msg']=="Act")
{
?>
 Email Template has been activated successfully
<?php
}

?>  
    </td>
  </tr>
   <tr height="4"><td colspan="3"></td></tr>
   <tr >
    <td align="left" colspan="3">page <?php echo $object->userpaginationBottom($cols,$limit,$page,"manage_email_templates.php?"); ?> of <?php echo $let_infe;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtval(this.value,'manage_email_templates');">
		<?php echo $page_num_str=$object->select_function($page_num_array,$limit);?>
      </select>
per page</td>
  </tr>
  <tr height="4"><td colspan="3"></td></tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table">
        <thead>
          <tr>
            <td width="50%"   height="20" align="left" class="headings">Template Name </td>
            <td width="50%"  align="left" class="headings">Options</td>
          </tr>
          <?php while($RecGetEmailTemplates=$object->FetchArray($SqlGetCampaignres))
			{ ?>
		  <tr>
            <td align="left" class="tr1"><?php echo stripslashes($RecGetEmailTemplates['TemplateName']);?></td>
            <td align="left" class="tr1"> <a href="edit_email_template.php?Tid=<?php echo $RecGetEmailTemplates['TId'];?>"><img src="images/edit.gif" alt="Edit" title="Edit"  border="0" /></a>
			<a href="javascript:MM_openBrWindow('viewtemplatepreview.php?image=<?php echo $RecGetEmailTemplates['preview'];?>','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=480,height=600')">
	Priview</a>
	<?php if($RecGetEmailTemplates['template_status']=='2')
	  {
	  ?>	
			<a  href="manage_email_templates.php?eid=<?php echo $RecGetEmailTemplates['TId'];?>&status=1&page=<?php echo $page ;?>" onclick="javascript:return confirm('Are you sure you want to Activate this Email Template');" >
		<img src="images/inactive.gif" alt="Activate" title="Activate" /></a>	  
	 <?php 
	 } 
	 else 
	 {
	  ?>
	  	<a href="manage_email_templates.php?eid=<?php echo $RecGetEmailTemplates['TId'];?>&status=2&page=<?php echo $page ;?>" onclick="javascript:return confirm('Are you sure you want to Deactivate this Email Template');">
		<img src="images/active.gif" alt="Deactivate" title="Deactivate" /></a>
	 <?php
	 }
	 ?>
	
	
	<a href="javascript:deleteEmailTemplate(<?php echo $RecGetEmailTemplates['TId'];?> );" ><img src="images/delete.gif" title="Delete" alt="Delete" /></a>
			</td>
          </tr>
		  <?php
		  }?>
          
        </thead>
        <tbody>
        </tbody>
      </table></td>
  </tr>
</table>
<?php include('includes/footer.php'); ?>
