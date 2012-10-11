<?php 
$nav=8;
error_reporting(0);
include("includes/adminsessions.php");
include('includes/header.php'); 

//********* START CODE DELETING POLL  **********//
if(isset($_REQUEST['delid']) && $_REQUEST['delid']!='')
{

	$Pollid=$_REQUEST['delid'];
	$GETMessRes=$object->DeleteData("tbl_poll","PollID=$Pollid");
	
	if($GETMessRes)
	{
		header("Location:polls.php?msg=del");
		exit;
	}
	
}
//********* END CODE DELETING POLL  **********//


//******* START CODE FOR UPDATING POLL STATUS **********//
if($_REQUEST['status']!='')
{
	if($_REQUEST['status']==1)
		$msg='Deact';
	else
		$msg='Act'; 
	
$QryupdatePollStatus=sprintf("update tbl_poll set Status=%d Where PollID=%d",$object->stripper($_REQUEST['status']),$object->stripper($_REQUEST['pid']));
	$ResupdatePollStatus=$object->ExecuteQuery($QryupdatePollStatus);
	if($ResupdatePollStatus)
	{
		header("Location:polls.php?msg=$msg&page=".$_REQUEST['page']);
		exit;
	}
	
}
//******* END CODE FOR UPDATING POLL STATUS **********//

//********** Start Code for displaying CUSTOMERS  *************//

	$SqlGetpollInfo="select * from tbl_poll";
	
	if($_REQUEST['field']=='Question')
	{
		$field='Question';
		$order=$_REQUEST['order'];
		$SqlGetpollInfo.= " Order By ".$field." ".$order;
	}
	else if($_REQUEST['field']=='sdate')
	{
		$field='StartDate';
		$order=$_REQUEST['order'];
		$SqlGetpollInfo.= " Order By ".$field." ".$order;
	}
	else if($_REQUEST['field']=='edate')
	{
		$field='EndDate';
		$order=$_REQUEST['order'];
		$SqlGetpollInfo.= " Order By ".$field." ".$order;
	}
	
	else
	{
		 $SqlGetpollInfo.="  Order By PollID DESC";
	}
	
	$QryGetpollInfo=$object->ExecuteQuery($SqlGetpollInfo);
	$cols=$object->NumRows($QryGetpollInfo);
	if(!isset($_REQUEST['page']))
		$page=1;	
	else
		$page=$_REQUEST['page'];
	
	
	$let=ceil($cols/$limit);
	
	$getPaginationRecords=$object->paginationTop($cols,$limit,$page);
	$SqlGetpollInfo=$SqlGetpollInfo." LIMIT $getPaginationRecords,$limit";
	//echo $SqlGetBannerInfo;
	$QryGetpollInfo=$object->ExecuteQuery($SqlGetpollInfo);
	$i=1;
	if($cols>0)
	{	
		while($RecGetpollInfo=$object->FetchArray($QryGetpollInfo))
		{ 
		 $qry="select *,sum(b.PollResult) as pollcount, count(*) as total from tbl_poll a,tbl_pollresults b where a.PollID=b.PollID and a.PollID=".$RecGetpollInfo['PollID']." group by b.PollID order by b.Poll_Results_id desc";
		$res=mysql_query($qry);
		$rec=mysql_fetch_array($res);
		$per2=round(($rec['pollcount']*100)/$rec['total']);
		$per1=round((($rec['total']-$rec['pollcount'])*100)/$rec['total']);
		//DB DATE CONVETED TO DISPLAY FORMAT START HERE
		$start_Date=explode("-",$RecGetpollInfo['StartDate']);
		$start_Display_date=$start_Date[1]."/".$start_Date[2]."/".$start_Date[0];
		
		$End_Date=explode("-",$RecGetpollInfo['EndDate']);
		$End_Display_date=$End_Date[1]."/".$End_Date[2]."/".$End_Date[0];
		//POSTED DATE CONVETED TO DB FORMAT END HERE
		
			if($i%2==0)
				$class="tr2";
			else
				$class="tr1";

			$displayPolls.="<tr>
			<td align='left' class='$class'>".$RecGetpollInfo['Question']." </td>
			<td align='center' class='$class'>".$per1."</td>
			<td align='center' class='$class'>".$per2."</td>
			<td align='left' class='$class'>".$start_Display_date."</td>
			<td align='left' class='$class'>".$End_Display_date."</td>
			<td align='left' class='$class'><a href='add-edit-poll.php?poll_id=".$RecGetpollInfo['PollID']."'><img src='images/edit.gif' title='Edit' alt='Edit' align='absmiddle'/></a><a href='javascript:deletePoll(".$RecGetpollInfo['PollID'].",".$page.");'><img src='images/delete.gif' title='Delete' alt='Delete' align='absmiddle'/></a>";
		
			if($RecGetpollInfo['Status']==1) 
				{
					$displayPolls.="<a href='polls.php?pid=".$RecGetpollInfo['PollID']."&status=0&page=".$page."'  onclick='JavaScript: return confirm(\"Are you sure you want to Activate this Poll?\")'><img src='images/active.gif' alt='Activate Poll' title='Activate Poll' align='absmiddle'/></a>";
				}
				else
				{
					$displayPolls.="<a href='polls.php?pid=".$RecGetpollInfo['PollID']."&status=1&page=".$page."'  onclick='JavaScript: return confirm(\"Are you sure you want to Deactivate this Poll?\")'><img src='images/inactive.gif' alt='Deactivate Poll' title='Deactivate Poll' align='absmiddle'/></a>";
				}
				$displayPolls.="</td></tr>";
				
				$i++;
		}
	}
	else
	{
		$displayPolls.='<tr>
                <td align="center" class="errer-mess" colspan="6">No Records Found</td>
              </tr>';
	}
	

//********** End Code for displaying Banners  *************//

?>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Manage Compaigns </td>
    <td align="right"  class="padbot5"><a href="add-edit-compaign.php">Create Compaigns</a></td>
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
    </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
<?php
 if($_REQUEST['msg']=="added")
{
?>
<tr><td colspan="3" align="center" class="errer-mess">Poll has been added successfully</td></tr>
<?php
}if($_REQUEST['msg']=="update")
{
?>
<tr><td colspan="3" align="center" class="errer-mess">Poll has been updated successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="del")
{
?>
<tr><td colspan="3" align="center" class="errer-mess">Poll has been deleted successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="Deact")
{
?>
<tr><td colspan="3" align="center" class="errer-mess">Poll has been deactivated successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="Act")
{
?>
<tr><td colspan="3" align="center" class="errer-mess">Poll has been activated successfully</td></tr>
<?php
}
?> 
 <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,"polls.php?"); ?> of <?php echo $let;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtval(this.value,'polls');">
		<?php echo $page_num_str=$object->select_function($page_num_array,$limit);?>
      </select>
per page</td>
    </tr>
  <tr>
  <tr>
    <td height="10"></td>
  </tr>
</table>
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table">
            <thead>
              <tr>
                <td width="54%" align="left" class="headings">Question <a href="polls.php?page=<?php echo $page;?>&field=Question&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="polls.php?page=<?php echo $page;?>&field=Question&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="8%" align="center" class="headings"><strong>Yes (%)</strong> </td>
                <td width="8%" align="center" class="headings"><strong>No (%)</strong></td>
                <td width="9%" align="left" class="headings">Start Date  <a href="polls.php?page=<?php echo $page;?>&field=sdate&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="polls.php?page=<?php echo $page;?>&field=sdate&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="10%" align="left" class="headings">End Date <a href="polls.php?page=<?php echo $page;?>&field=edate&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="polls.php?page=<?php echo $page;?>&field=edate&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="11%" align="left" class="headings">Action</td>
              </tr>
		<?php echo $displayPolls;?>
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
       <?php include('includes/footer.php'); ?>