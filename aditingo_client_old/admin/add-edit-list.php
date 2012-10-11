<?php 
$nav=7;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('../includes/values.php'); 


//********* START CODE FOR UPDATING PROFILE **************//
if(isset($_REQUEST['button3']) && $_REQUEST['button3']!='')
{	
if($_REQUEST['area_id']=='')
	{	
		 $insertcatInfo=sprintf("insert into tbl_metropolitian_list(area_name,status) values('%s',%d)",$object->stripper($_POST['areaname']),'1'); 
		$QryinsertareaInfo=$object->ExecuteQuery($insertcatInfo);
		$msg="added";
	}
	else
	{
		 $updatecatinfo=sprintf("update tbl_metropolitian_list set  area_name='%s' where  area_id=%d",$object->stripper($_POST['areaname']),$object->stripper($_REQUEST['area_id'])); 
$QryinsertareaInfo=$object->ExecuteQuery($updatecatinfo);
$msg="update"; 
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
                                <td align="left"><input name="areaname" id="areaname" type="text" class="input2" value="<?php echo stripslashes($QryGetareaDetailsRec['area_name']);?>" /></td>
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