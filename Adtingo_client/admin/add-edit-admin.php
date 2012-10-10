<?php 
$nav=4;
include("includes/adminsessions.php");
include('includes/header.php');
$yesterday = date ("Y-m-d", mktime (0,0,0,date("m"),(date("d")-1),date("Y")));



//***** END CODE FOR DELETING CHART TRACK ***********//
//inserting chardt records
if(isset($_POST['button3']) && $_POST['button3']!='')
{

	$current_date=date("Y-m-d H:i:s");
	 
	  $email=$object->stripper($_POST['email']);
	 $SqlGetInfo="select * from tbl_admin  where admin_email='".$email."'";
	if($_POST['adminid']!='')
	 $SqlGetInfo.=" AND adminid!=".$_POST['adminid']."";
	$QryGetInfo=$object->ExecuteQuery($SqlGetInfo);
	 $numrows=mysql_num_rows($QryGetInfo);
	
	if($numrows==0)
	{
	if($_POST['adminid']=='')
	{	
	
			$date=date('Y-m-d H:i:s',time());
			
			
			
		//$MaxOrderIDPrimGenere=$object->getprimarygenermaxordeid();
		
			$insertAdmin=sprintf("insert into tbl_admin(admin_username,admin_pwd,admin_email,date_created,admin_status) values('%s','%s','%s','%s','%s')",$object->stripper($_POST['username']),$object->stripper($_POST['password']),$object->stripper($_POST['email']),$date,'1');
			$resinsertadmin=$object->ExecuteQuery($insertAdmin);
		$msg="added";
	}
	else
	{
		

		$insertAdmin=sprintf("Update tbl_admin  set  admin_username='%s', admin_pwd='%s', admin_email='%s', date_modified='%s' where adminid=%d",$object->stripper($_POST['username']),$object->stripper($_POST['password']),$object->stripper($_POST['email']),$current_date,$object->stripper($_POST['adminid']));
		$resinsertadmin=$object->ExecuteQuery($insertAdmin);
		$msg="update"; 
	}

	if($resinsertadmin)
	{
		if($_POST['page']=='') 
			$page=1;
		else
			$page=$_POST['page'];
		header("location:manageadmin.php?msg=$msg&page=".$page);
		exit;
	}
	}
	if($numrows>0)
	{
		 $msg='Email Already Exists';
	}
}
//******* START CODE FOR EDITING VALUES *********//
$SqlGetChartInfo="select * from tbl_admin  where adminid=".$_REQUEST['admin'];
$QryGetChartInfo=$object->ExecuteQuery($SqlGetChartInfo);
$ResGetChartInfo=$object->FetchArray($QryGetChartInfo);





?>

<script type="text/javascript" src="../js/moo.js"></script>
<!--<script type="text/javascript">
//******** Start CODE FOR DRAG DROP ***********//


	/* when the DOM is ready */
	window.addEvent('domready', function() {
		/* create sortables */
		var sb = new Sortables('sortable-list', {
			/* set options */
			clone:true,
			revert: true,
			/* initialization stuff here */
			initialize: function() { 
				
			},
			/* once an item is selected */
			onStart: function(el) { 
				el.setStyle('background','#add8e6');
			},
			/* when a drag is complete */
			onComplete: function(el) {
				el.setStyle('background','#ddd');
				//build a string of the order
				var sort_order = '';
				$$('#sortable-list table').each(function(table) { sort_order = sort_order +  table.get('alt')  + '|'; });
				$('sort_order').value = sort_order;
				
				//autosubmit if the checkbox says to
				
				
			}
		});
	});

//******** END CODE FOR DRAG DROP ***********//
</script>-->


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
                    <td height="20" align="left" class="content-header"> Add Admin</td>
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
                      <td height="28" align="left" class="form-headings">Add / Edit </td>
                    </tr>
                    
                    <tr>
                      <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
                        <thead>
                          
                         
                          <tr>
                            <td width="12%" align="left" class="tr2">
						<table width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td width="50%"  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
							 
							
							  <form name="frmchart" action="" method="post" onsubmit="return validateadmin();">
							  <input id="sreachid" name="sreachid" type="hidden" value="<?php echo $trackid;?>" />
							   <input id="adminid" name="adminid" type="hidden" value="<?php echo $_REQUEST['admin'];?>" />
							     <input id="page" name="page" type="hidden" value="<?php echo $_REQUEST['page'];?>" />
								 <input id="trackids_1" name="trackids_1" type="hidden" value="<?php echo $trackid;?>" />
                              <tr>
                                <td width="30%" height="10" align="left"></td>
                                <td width="70%" height="10" align="left"></td>
                              </tr>
                                <tr>
                                <td height="30" align="left"><strong>Admin Username</strong></td>
                                <td align="left"><input name="username" id="username" type="text" class="input2" value="<?php echo isset($_POST['username'])?$_POST['username']:$ResGetChartInfo['admin_username'];?>" /></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Password</strong></td>
                                <td align="left"><input name="password" id="password" type="password" class="input2" value="<?php echo isset($_POST['password'])?$_POST['password']:$ResGetChartInfo['admin_pwd'];?>" /></td>
                              </tr>
							  <tr>
							   
                                <td height="30" align="left"><strong>Confirm Password</strong></td>
                                <td align="left"> <input name="confirmpassword" id="confirmpassword" type="password" class="input2" value="<?php echo isset($_POST['confirmpassword'])?$_POST['confirmpassword']:$ResGetChartInfo['admin_pwd'];?>" /></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Email</strong></td>
                                <td align="left"><input name="email" id="email" type="text" class="input2" value="<?php echo isset($_POST['email'])?$_POST['email']:$ResGetChartInfo['admin_email'];?>" /></td>
                              </tr>
							  
                              <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left">
                                  <input name="button3" type="submit" class="button" id="button3" value="Submit" />
                                                      </td>
                              </tr>
							    <input type="hidden" value="" name="sort_order" id="sort_order" />
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
                        </thead>
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