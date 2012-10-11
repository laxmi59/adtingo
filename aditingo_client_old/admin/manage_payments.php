<?php 
$nav=11;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');

//********** Start Code for displaying CUSTOMERS  *************//

	 $SqlGetCampaigns="select *,date_format(date_created,'%d %b,  %Y') as date  from tbl_paymentdetails";
	
	if($_REQUEST['field']=='date')
	{
		$field='date_created';
		$order=$_REQUEST['order'];
		$SqlGetCampaigns.= " Order By ".$field." ".$order;
	}
	else if($_REQUEST['field']=='client')
	{
		$field='client_name';
		$order=$_REQUEST['order'];
		$SqlGetCampaigns.= " Order By ".$field." ".$order;
	}
	
	 	
	else
	{
		 $SqlGetCampaigns.="  Order By PayID DESC";
	}
	//echo $SqlGetCustomersInfo;
	$SqlGetCampaignsRes=$object->ExecuteQuery($SqlGetCampaigns);
	$cols=$object->NumRows($SqlGetCampaignsRes);
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
	$SqlGetCampaigns=$SqlGetCampaigns." LIMIT $getPaginationRecords,$limit";
	 $SqlGetCampaignres=$object->ExecuteQuery($SqlGetCampaigns);
	

//********** End Code for displaying Artists  *************//

?>

<script language="javascript" type="text/javascript">
  function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Manage Payments  </td>
<!--<td align="right"  class="padbot5"><a href="edit-member.php?page=">Add Member </a></td>-->
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
    </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">

<?php
if($_REQUEST['msg']=="update")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Member Information has been updated successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="added")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Member Information has been added successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="del")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Campaign has been deleted successfully</td></tr>
<?php
}

if($_REQUEST['msg']=="Deact")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Campaign  has been Rejected successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="Act")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Campaign has been Approved successfully</td></tr>
<?php
}

?>  
<tr>
    <td height="10"></td>
	
  </tr>
   <tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,"manage_payments.php?"); ?> of <?php echo $let_infe;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtval(this.value,'manage_payments');">
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
              <!--<td width="6%" class="headings" align="left"><strong>ID</strong></td>-->
                <td width="17%" align="left" class="headings">Client Name <a href="manage_payments.php?page=<?php echo $page;?>&field=client&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="manage_payments.php?page=<?php echo $page;?>&field=client&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="15%" align="left" class="headings">Campaign Name </td>
                <td width="21%" align="left" class="headings">Total Amount Charged  </td>
                  <td width="19%" align="left" class="headings">Payment date <a href="manage_payments.php?page=<?php echo $page;?>&field=date&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="manage_payments.php?page=<?php echo $page;?>&field=date&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
				   <td width="19%" align="left" class="headings">Options</td>
              </tr>
			  <?php
			  if($cols>0)
			  {
			  $i=1;
			  while($SqlGetCampaignrec=$object->FetchArray($SqlGetCampaignres))
			{ 
				if($i%2==0)
				$class="tr2";
				else
				$class="tr1";
				?>
		<tr>
             <!--  <td class="<?php echo $class;?>" align="left"> </td>-->
                <td align="left" class="<?php echo $class;?>"><?php echo stripslashes($SqlGetCampaignrec['client_name']); ?></td>
                <td align="left" class="<?php echo $class;?>">
					<?php echo $object->GetCampaignName($SqlGetCampaignrec['campaign_id']); ?></td>
                <td align="left" class="<?php echo $class;?>">$ <?php echo number_format($SqlGetCampaignrec['TotalAmount'],2); ?></td>
                
                <td align="left" class="<?php echo $class;?>" ><?php echo $SqlGetCampaignrec['date'];?></td>
				 <td align="left" class="<?php echo $class;?>">
	<a href="javascript:MM_openBrWindow('viewpaymentdetails.php?Tid=<?php echo $SqlGetCampaignrec['PayID'];?>','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=450,height=550')">
	<img src='images/view2.gif' alt='View'  border='0' title='View'></a>
		
	   </td>
              </tr>			  
			  <?php
			  $i++;
			  }
			  }
			  else
			  {
			  ?>
			  <tr>
               <td class="errer-mess2" align="left" colspan="6">No Records Found </td>
			  <?php
			  }
			  ?>
			  
			  
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
      
	  
      
   

 <?php include('includes/footer.php'); ?>