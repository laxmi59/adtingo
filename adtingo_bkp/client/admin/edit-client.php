<?php 
$nav=3;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('../includes/values.php'); 


//********* START CODE FOR UPDATING PROFILE **************//
if(isset($_POST['submitproduct']) && $_POST['submitproduct']!='')
{	
		if($_REQUEST['cid']=='')
		{	
			//print_r($_REQUEST);exit;
			$insertMemInfo=sprintf("insert into tbl_clients(full_name,email_address,username,password,company_name,time_zone,metropolitian_area,date_created,status) values('%s','%s','%s','%s','%s','%s',%d,'%s',%d)",$object->stripper($_POST['full_name']),$object->stripper($_POST['email']),$object->stripper($_POST['username']),$object->stripper($_POST['password']),$object->stripper($_POST['companyname']),$object->stripper($_POST['timezone']),$object->stripper($_POST['metropolitian_list']),date('Y:m:d H:i:s'),'1'); 
			$QryinsertMemInfo=$object->ExecuteQuery($insertMemInfo);
			
			$clientid=mysql_insert_id();
			$metroIds=$object->stripper($_POST['metroIds']);
			$metroIds=substr($metroIds,0,-1);
			$metroIds_array=explode(":",$metroIds);
			
			for($i=0;$i<count($metroIds_array);$i++)
			{
				 $metroIds_array[$i];
			//	echo "insert into tbl_ client_metropolitian(area_id,clientid) values('%d','%d')",$metroIds_array[$i],$clientid;
				//$insertMetroInfo=sprintf("insert into tbl_ client_metropolitian(area_id,clientid) values(%d,%d)",$metroIds_array[$i],$clientid);
				 $insertMetroInfo=sprintf("insert into tbl_client_metropolitian(area_id,clientid) values(%d,%d)",$metroIds_array[$i],$clientid);
				 $QryinsertMetroInfo=$object->ExecuteQuery($insertMetroInfo);
			}	
			
			$msg="added";
		}
		else
		{
		 $updateuserinfo=sprintf("update tbl_clients  set full_name='%s', email_address='%s' , username='%s' , password='%s', company_name='%s',time_zone='%s',metropolitian_area='%s' where clientid=%d",$object->stripper($_POST['full_name']),$object->stripper($_POST['email']),$object->stripper($_POST['username']),$object->stripper($_POST['password']),$object->stripper($_POST['companyname']),$object->stripper($_POST['timezone']),$object->stripper($_POST['metropolitian_list']),$object->stripper($_REQUEST['cid']));  
		$QryinsertMemInfo=$object->ExecuteQuery($updateuserinfo);
			$clientid=$_REQUEST['cid'];
			$metroIds=$object->stripper($_POST['metroIds']);
			$metroIds=substr($metroIds,0,-1);
			$metroIds_array=explode(":",$metroIds);
	
			
			$Getres=$object->DeleteData(" tbl_client_metropolitian","clientid=".$clientid); 
			for($i=0;$i<count($metroIds_array);$i++)
			{
				 $metroIds_array[$i];
			//	echo "insert into tbl_ client_metropolitian(area_id,clientid) values('%d','%d')",$metroIds_array[$i],$clientid;
				//$insertMetroInfo=sprintf("insert into tbl_ client_metropolitian(area_id,clientid) values(%d,%d)",$metroIds_array[$i],$clientid);
				
				
					 $insertMetroInfo=sprintf("insert into tbl_client_metropolitian(area_id,clientid) values(%d,%d)",$metroIds_array[$i],$clientid);
					 $QryinsertMetroInfo=$object->ExecuteQuery($insertMetroInfo);
				
			}
		
		$msg="update"; 
		}

	if($QryinsertMemInfo)
	{
		header("Location:clientsdetails.php?msg=$msg&page=".$_POST['page']);
		exit;
		
	}
		
}
//********* END CODE FOR UPDATING PROFILE **************//
//************** START DISPLAY PROFILE VALUES ************//
$SqlGetUserDetails=sprintf("select * FROM tbl_clients  where clientid=%d ",$object->stripper($_REQUEST['cid']));
$QryGetUserDetails=$object->ExecuteQuery($SqlGetUserDetails);
$QryGetUserDetailsRec=$object->FetchArray($QryGetUserDetails);
//************** END DISPLAY PROFILE VALUES ************//
if($_REQUEST['cid']=='')
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
                    <td height="20" align="left" class="content-header">Client information </td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>  <form action="" method="post" name="profilrfrm" enctype="multipart/form-data" onsubmit="return validateprofilefrm_admin();">
				
<input type="hidden" name="userid" id="userid" value="<?php echo $_REQUEST['cid']; ?>" />
<input type="hidden" name="page" id="page" value="<?php echo $_REQUEST['page']; ?>" />
<input type="hidden" name="errormess" id="errormess" value=""/>
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
                            <td width="12%" align="left" class="tr2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="23%" height="10" align="left"></td>
                                <td width="76%" height="10" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Full Name</strong></td>
                                <td align="left"> 
								<input type="hidden" name="metroIds" id="metroIds"/>
                                 <input type="text" value="<?php if($QryGetUserDetailsRec['full_name']!='') echo stripslashes($QryGetUserDetailsRec['full_name']);?>"  name="full_name" id="full_name" />                         </td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Email Address</strong></td>
                                <td align="left"> 
								<input type="text" value="<?php if($QryGetUserDetailsRec['full_name']!='') echo stripslashes($QryGetUserDetailsRec['email_address']);?>"  name="email" id="email" onblur="javascript:emailcheck(<?php echo $_REQUEST['cid'];?>);" /><br/>
								<span id="errmail" class="errer-mess2"></span>
								</td>
                              </tr>
							  <tr>
                                <td height="30" align="left"><strong>Username</strong></td>
                                <td align="left"> 
								<input type="text" value="<?php if($QryGetUserDetailsRec['full_name']!='') echo stripslashes($QryGetUserDetailsRec['username']);?>"  name="username" id="username"  /><br/>
								<!--<span id="errmail" class="errer-mess2"></span>-->
								</td>
                              </tr>
							  <tr>
                                <td height="30" align="left"><strong>Password</strong></td>
                                <td align="left"> 
								<input type="password" value="<?php if($QryGetUserDetailsRec['password']!='') echo stripslashes($QryGetUserDetailsRec['password']);?>" name="password" id="password"  /><br/>
								<!--<span id="errmail" class="errer-mess2"></span>-->
								</td>
                              </tr>
							  
                                 <tr>
                                <td height="30" align="left"><strong>Company Name</strong></td>
                                <td align="left"> 
								<input type="text" value="<?php if($QryGetUserDetailsRec['company_name']!='') echo stripslashes($QryGetUserDetailsRec['company_name']);?>"  name="companyname" id="companyname" /></td>
                              </tr>                     
						
							   
						
							 <tr>
                                <td height="30" align="left" valign="top"><strong>Time Zone</strong></td>
                                <td  align="left">
								<select name="timezone" id="timezone" >
								<option value="">Select Time zone</option>
                  <?php
							echo Timezone_info_data($QryGetUserDetailsRec[time_zone]);
		 		  ?>
                        </select>
								</td>
                              </tr>
							  
                             <tr>
                              <td  align="left" height="30"  valign="top"><strong>Metropolitian Area</strong></td>
							   <td align="left">
                  <select name="metropolitian_list" id="metropolitian_list">
							   <option value="">Select  Metropolitian Area</option>
         			 <?php 
		  					$mainobj=new main;
							
							  echo $mainobj->GetAllMetropolitianList($QryGetUserDetailsRec['metropolitian_area']);
		  			 ?>	 </select>
                      </td>
							   </tr>
                            
                                <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left" >
                                  <input name="submitproduct" type="submit" class="button" id="submitproduct" value="Submit" />                                                             </td>
                              </tr>
                              
                            </table></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                    </tr>
                  </table></form></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
	 
     <?php include('includes/footer.php'); ?>