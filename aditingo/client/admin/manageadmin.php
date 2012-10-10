<?php 
$nav=4;

include("includes/adminsessions.php");
include('includes/header.php');

//********* START CODE DELETING CHARTS **********//
if(isset($_REQUEST['delid']) && $_REQUEST['delid']!='')
{
	$Getres=$object->DeleteData("tbl_admin","adminid=".$_REQUEST['delid']); 
	if($Getres)
	{
		header("Location:manageadmin.php?msg=del&page=".$_REQUEST['page']);
		exit;
	}
}
//$object->deletecategorygener($QryGetCatGener);

//********* END CODE DELETING CHARTS **********//

//******* START CODE FOR UPDATING BANNER STATUS **********//
if($_REQUEST['status']!='')
{
	if($_REQUEST['status']==1)
		$msg='Act';
	else
		$msg='Deact'; 
	$updateadvbandet=sprintf("update tbl_admin set admin_status='%s' Where adminid=%d",$object->stripper($_REQUEST['status']),$object->stripper($_REQUEST['admin']));
	$updateadvbandetres=$object->ExecuteQuery($updateadvbandet);
	if($updateadvbandetres)
	{
		header("Location:manageadmin.php?msg=$msg&page=".$_REQUEST['page']);
		exit;
	}
	
}
//******* END CODE FOR UPDATING BANNER STATUS **********//

//********** Start Code for displaying Charts  *************//

	$SqlGetCharts="select * from tbl_admin";
	
	if($_REQUEST['field']=='username')
	{
		$field='admin_username';
		$order=$_REQUEST['order'];
		$SqlGetCharts.= " Order By ".$field." ".$order;
	}
	else if($_REQUEST['field']=='email')
	{
		$field='admin_email';
		$order=$_REQUEST['order'];
		$SqlGetCharts.= " Order By ".$field." ".$order;
	}
	else
	{
		$SqlGetCharts.=" Order By adminid DESC";
	}
	
	 $QryGetCharts=$object->ExecuteQuery($SqlGetCharts);
	 $cols=$object->NumRows($QryGetCharts); 
	
	if(!isset($_REQUEST['page']))
		$page=1;	
	else
		$page=$_REQUEST['page'];
	
	
	$let=ceil($cols/$limit);
	
	$getPaginationRecords=$object->paginationTop($cols,$limit,$page);
	$SqlGetCharts=$SqlGetCharts." LIMIT $getPaginationRecords,$limit";
	
	//echo $SqlGetCatGener;
	$QryGetCharts=$object->ExecuteQuery($SqlGetCharts);
	
	
	
//********** End Code for displaying categories genres  *************//
 ?>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Administrators </td>
    <td align="right"  class="padbot5"><a href="add-edit-admin.php">Add Admin </a></td>
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
    </tr>
	<?php
 if($_REQUEST['msg']=="added")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Admin has been added successfully</font></td></tr>
<?php
}if($_REQUEST['msg']=="update")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Admin has been updated successfully</font></td></tr>
<?php
}
if($_REQUEST['msg']=="del")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Admin has been deleted successfully</font></td></tr>
<?php
}
if($_REQUEST['msg']=="Deact")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Admin has been deactivated successfully</font></td></tr>

<?php
}
if($_REQUEST['msg']=="Act")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Admin has been activated successfully</font></td></tr>

<?php
}?>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
  <?php $pagename="manageadmin.php?field=".$_GET['field']."&order=".$_GET['order']."";?>
   <tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,$pagename); ?> of <?php echo $let;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtval(this.value+'&field=<?php echo $_GET['field'];?>&order=<?php echo $_GET['order'];?>','manageadmin');">
		<?php echo $page_num_str=$object->select_function($page_num_array,$limit);?>
      </select>
per page</td>
    </tr>
  <tr>
    <td height="10"></td>
  </tr>
</table>
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table">
            <thead>
              <tr>
                <td width="33%" align="left" class="headings">Username <a href="manageadmin.php?page=<?php echo $page;?>&field=username&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="manageadmin.php?page=<?php echo $page;?>&field=username&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="51%" align="left" class="headings">Email <a href="manageadmin.php?page=<?php echo $page;?>&field=email&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="manageadmin.php?page=<?php echo $page;?>&field=email&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <!--<td width="25%" align="left" class="headings">End Date <a href="manageadmin.php?page=<?php //echo $page;?>&field=ed&order=ASC&limit=<?php //echo $limit;?>"><img src="images/up.gif"  /></a><a href="manageadmin.php?page=<?php //echo $page;?>&field=ed&order=DESC&limit=<?php //echo $limit;?>"><img src="images/down.gif"  /></a></td>-->
                <td width="16%" align="left" class="headings">Options</td>
              </tr>
			 <?php 
			 
			 $i=0;
	if($cols>0)
	{	
		while($ResGetCharts=$object->FetchArray($QryGetCharts))
		{
			
			if($i%2==0)
				$class="tr1";
			else
				$class="tr2";
			?>
			
			<tr>
                <td align="left" class="tr1"><?php echo $ResGetCharts['admin_username'];?></td>
                <td align="left" class="tr1"><?php echo $ResGetCharts['admin_email'];?></td>
            
                <td align="left" class="tr1"><a href="add-edit-admin.php?admin=<?php echo $ResGetCharts['adminid'];?>&page=<?php echo $page;?>"><img src="images/edit.gif" title="Edit" alt="Edit" align="absmiddle"/></a><a href="javascript:deleteAdmin('<?php echo $ResGetCharts['adminid'];?>','<?php echo $page;?>');"><img src="images/delete.gif" title="Delete" alt="Delete" align="absmiddle"/></a>
				<?php
				if($ResGetCharts['admin_status']==0) 
				{
				?>
					<a href='manageadmin.php?admin=<?php echo $ResGetCharts['adminid'];?>&status=1&page=<?php echo $page;?>'  onclick="javascript:return confirm('Are you sure you want to Activate this Admin');" ><img src='images/inactive.gif' alt='Activate ' title='Activate ' align='absmiddle'/></a>
				<?php }
				else
				{?>
					<a href='manageadmin.php?admin=<?php echo $ResGetCharts['adminid'];?>&status=0&page=<?php echo  $page;?>'  onclick="javascript:return confirm('Are you sure you want to Deactivate this Admin');" ><img src='images/active.gif' alt='Deactivate' title='Deactivate' align='absmiddle'/></a>
				<?php } ?>
					</td></tr>
				
				
				
				<?php
			  $i++;
		}
		
	}
	else
	{ ?>
		<tr>
                <td align="center" class="tr1" colspan="4">No Chart Found</td>
              </tr>
	 <?php  }
			 
			 ?>
              
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
       <?php include('includes/footer.php'); ?>