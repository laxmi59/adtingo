<?php 
$nav=3;
include("includes/adminsessions.php");
include('includes/header.php'); 

//********* START CODE DELETING CUSTOMER  **********//
if(isset($_REQUEST['delid']) && $_REQUEST['delid']!='')
{
if($_REQUEST['type']!=1)
$message="del";
else
$message="fdel";
	$cid=$_REQUEST['delid'];
	$GETMessRes=$object->DeleteData("tbl_clients","clientid=$cid");
	
	if($GETMessRes)
	{
		header("Location:clientsdetails.php?msg=".$message."");
		exit;
	}
	
}
//********* END CODE DELETING CUSTOMER  **********//


//******* START CODE FOR UPDATING CUSTOMER STATUS **********//
if($_REQUEST['status']!='')
{
	if($_REQUEST['status']==1)
		$msg='Act';
	else
		$msg='Deact'; 
	
	$QryupdateUserStatus=sprintf("update tbl_clients  set Status='%s' Where clientid	=%d",$object->stripper($_REQUEST['status']),$object->stripper($_REQUEST['cid']));
	$ResupdateUserStatus=$object->ExecuteQuery($QryupdateUserStatus);
	if($ResupdateUserStatus)
	{
		header("Location:clientsdetails.php?msg=$msg&page=".$_REQUEST['page']);
		exit;
	}
	
}
//******* END CODE FOR UPDATING CUSTOMER STATUS **********//



//********** Start Code for displaying CUSTOMERS  *************//

	 $SqlGetCustomersInfo="select *,date_format(date_created,'%M %d,  %Y %l:%i:%s %p') as Regdate from  tbl_clients";
	
	if($_REQUEST['field']=='name')
	{
		$field='full_name';
		$order=$_REQUEST['order'];
		$SqlGetCustomersInfo.= " Order By ".$field." ".$order;
	}
	else if($_REQUEST['field']=='email')
	{
		$field='email_address';
		$order=$_REQUEST['order'];
		$SqlGetCustomersInfo.= " Order By ".$field." ".$order;
	}
	else if($_REQUEST['field']=='companyname')
	{
		$field='company_name';
		$order=$_REQUEST['order'];
		$SqlGetCustomersInfo.= " Order By ".$field." ".$order;
	}
	 	
	else
	{
		 $SqlGetCustomersInfo.="  Order By clientid DESC";
	}
	//echo $SqlGetCustomersInfo;
	$QryGetCustomersInfo=$object->ExecuteQuery($SqlGetCustomersInfo);
	$cols=$object->NumRows($QryGetCustomersInfo);
	if($_REQUEST['page']=='')
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
	 $SqlGetCustomersInfo=$SqlGetCustomersInfo." LIMIT $getPaginationRecords,$limit";
	 $ResGetCustomersInfo=$object->ExecuteQuery($SqlGetCustomersInfo);
	

//********** End Code for displaying Artists  *************//

?>


<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Manage Clients </td>
<td align="right"  class="padbot5"><a href="edit-client.php">Add Client </a></td>
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
<tr><td colspan="3" align="center" class="errer-mess2"> Client Information has been updated successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="added")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Client Information has been added successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="del")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Client has been deleted successfully</td></tr>
<?php
}

if($_REQUEST['msg']=="Deact")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Client  has been deactivated successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="Act")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Client has been activated successfully</td></tr>
<?php
}

?>  
<tr>
    <td height="10"></td>
	
  </tr>
   <tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,"clientsdetails.php?"); ?> of <?php echo $let_infe;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtval(this.value,'clientsdetails');">
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
             <!-- <td width="6%" class="headings" align="left"><strong>ID</strong></td>-->
                <td width="17%" align="left" class="headings">Full Name   <a href="clientsdetails.php?page=<?php echo $page;?>&field=name&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="clientsdetails.php?page=<?php echo $page;?>&field=name&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="15%" align="left" class="headings">Email Address <a href="clientsdetails.php?page=<?php echo $page;?>&field=email&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="clientsdetails.php?page=<?php echo $page;?>&field=email&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="21%" align="left" class="headings">Company Name <a href="clientsdetails.php?page=<?php echo $page;?>&field=companyname&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="clientsdetails.php?page=<?php echo $page;?>&field=companyname&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
				
                
                <td width="19%" align="left" class="headings">Options</td>
              </tr>
			  <?php
			  if($cols>0)
			  {
			  $i=1;
			  while($RecGetCustomersInfo=$object->FetchArray($ResGetCustomersInfo))
			{ 
				if($i%2==0)
				$class="tr2";
				else
				$class="tr1";
				?>
		<tr>
             <!--  <td class="<?php echo $class;?>" align="left"></td>-->
                <td align="left" class="<?php echo $class;?>"><?php echo stripslashes($RecGetCustomersInfo['full_name']);?></td>
                <td align="left" class="<?php echo $class;?>">
				<a href="mailto:<?php echo stripslashes($RecGetCustomersInfo['email_address']);?>">
				<?php echo stripslashes($RecGetCustomersInfo['email_address']);?></a></td>
                <td align="left" class="<?php echo $class;?>"><?php echo stripslashes($RecGetCustomersInfo['company_name']);?></td>
                
                <td align="left" class="<?php echo $class;?>">
	<a href="javascript:MM_openBrWindow('viewclients.php?cid=<?php echo $RecGetCustomersInfo['clientid'];?>','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=450,height=550')">
	<img src='images/view2.gif' alt='View'  border='0' title='View'></a>
				
				<a href="edit-client.php?cid=<?php echo $RecGetCustomersInfo['clientid'];?>&page=<?php echo $page ;?> "> 
				<img src="images/edit.gif" alt="Edit"  border="0" /></a> 
	<?php if($RecGetCustomersInfo['status']=='0')
	  {
	  ?>	
			<a  href="clientsdetails.php?cid=<?php echo $RecGetCustomersInfo['clientid'];?>&status=1&page=<?php echo $page ;?>" onclick="javascript:return confirm('Are you sure you want to Activate this Client');" >
		<img src="images/inactive.gif" alt="Activate Client" title="Activate Client" /></a>	  
	 <?php 
	 } 
	 else 
	 {
	  ?>
	  	<a href="clientsdetails.php?cid=<?php echo $RecGetCustomersInfo['clientid'];?>&status=0&page=<?php echo $page ;?>" onclick="javascript:return confirm('Are you sure you want to Deactivate this Client');">
		<img src="images/active.gif" alt="Deactivate Client" title="Deactivate Client" /></a>
	 <?php
	 }
	 ?>
	  <a href="javascript:deleteClient(<?php echo $RecGetCustomersInfo['clientid'];?>, <?php echo $page;?>);" ><img src="images/delete.gif" title="Delete" alt="Delete" /></a></td>
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