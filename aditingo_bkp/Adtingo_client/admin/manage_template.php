<?php 
$nav=8;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');
//********* START CODE DELETING CUSTOMER  **********//
if(isset($_REQUEST['delid']) && $_REQUEST['delid']!='')
{
if($_REQUEST['type']!=1)
$message="del";
else
$message="fdel";
	$mid=$_REQUEST['delid'];
	$GETMessRes=$object->DeleteData("tbl_members","memberid=$mid");
	
	if($GETMessRes)
	{
		header("Location:manage_template.php?msg=".$message."&page=".$_REQUEST['page']."");
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
	
	$QryupdateUserStatus=sprintf("update tbl_members set Status='%s' Where memberid	=%d",$object->stripper($_REQUEST['status']),$object->stripper($_REQUEST['mid']));
	$ResupdateUserStatus=$object->ExecuteQuery($QryupdateUserStatus);
	if($ResupdateUserStatus)
	{
		header("Location:members.php?msg=$msg&page=".$_REQUEST['page']);
		exit;
	}
	
}
//******* END CODE FOR UPDATING CUSTOMER STATUS **********//



//********** Start Code for displaying CUSTOMERS  *************//

	 $SqlGetCustomersInfo="select *,date_format(date_created,'%M %d,  %Y %l:%i:%s %p') as Regdate from tbl_members";
	
	if($_REQUEST['field']=='name')
	{
		$field='username';
		$order=$_REQUEST['order'];
		$SqlGetCustomersInfo.= " Order By ".$field." ".$order;
	}
	else if($_REQUEST['field']=='email')
	{
		$field='email_address';
		$order=$_REQUEST['order'];
		$SqlGetCustomersInfo.= " Order By ".$field." ".$order;
	}
	else if($_REQUEST['field']=='income')
	{
		$field='income';
		$order=$_REQUEST['order'];
		$SqlGetCustomersInfo.= " Order By ".$field." ".$order;
	}
	 	
	else
	{
		 $SqlGetCustomersInfo.="  Order By memberid DESC";
	}
	//echo $SqlGetCustomersInfo;
	$QryGetCustomersInfo=$object->ExecuteQuery($SqlGetCustomersInfo);
	$cols=$object->NumRows($QryGetCustomersInfo);
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
		$limit=6;		
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
    <td height="20" align="left" class="content-header">Manage Email Templates </td>
<td align="right"  class="padbot5"><a href="edit-member.php?page=<?php echo $page;?>"> </a></td>
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
<tr><td colspan="3" align="center" class="errer-mess2"> Member has been deleted successfully</td></tr>
<?php
}

if($_REQUEST['msg']=="Deact")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Member  has been deactivated successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="Act")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Member has been activated successfully</td></tr>
<?php
}

?>  
<tr>
    <td height="10"></td>
	
  </tr>
   <tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,"manage_template.php?"); ?> of <?php echo $let_infe;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtval(this.value,'manage_template');">
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
                <td width="17%" align="left" class="headings">Heading </td>
                <td width="15%" align="left" class="headings">Sub Heading </td>
               
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
             <!--  <td class="<?php echo $class;?>" align="left"> </td>-->
                <td align="left" class="<?php echo $class;?>">Test Heading</td>
                <td align="left" class="<?php echo $class;?>">
				Test Sub heading
				</td>
                
                
                <td align="left" class="<?php echo $class;?>">
	<a href="javascript:MM_openBrWindow('EmailTemplates/template2.html','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=620,height=620')">
	<img src='images/view2.gif' alt='View'  border='0' title='View'></a>
				
				<a href="edit-member.php?mid=<?php echo $RecGetCustomersInfo['memberid'];?>&page=<?php echo $page ;?> "> 
				<img src="images/edit.gif" alt="Edit"  border="0" /></a> 

	  <a href="javascript:deleteartist(<?php echo $RecGetCustomersInfo['memberid'];?>, <?php echo $page;?>);" ><img src="images/delete.gif" title="Delete" alt="Delete" /></a></td>
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