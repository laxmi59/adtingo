<?php 
$nav=5;
include("includes/adminsessions.php");
include('includes/header.php');
include('includes/values.php');
	//print_r($education_array);print_r($income_array);
//inserting chardt records
if(isset($_POST['button3']) && $_POST['button3']!='')
{

	$mess="";
	$current_date=date("Y-m-d H:i:s");
	$source=$_FILES['csvfile']['tmp_name']; 
	$filename=time().$_FILES['csvfile']['name'];
	$destination="uploads/$filename"; 
	$chk=move_uploaded_file($source,$destination); 
	//echo file_get_contents($destination);
	$row = 0;
	$handle = fopen($destination, "r");
	
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	if ($row > 0) {
        /*$name = $data[0];  
		$lastname=$data[1]; 		
		$email = $data[2];
		$username = $data[3];
		$cityname=$data[4]; 
		$dob = $data[5];		
		$gender = $data[6];	
		$zipcode = $data[7];
		$education = $data[8];
		$income = $data[9];
		$interest = $data[10];	
		$arealist = $data[11];*/
		$name = $data[0];  
		$lastname=$data[1]; 		
		$email = $data[2];
		$cityname=$data[3]; 
		$dob = $data[4];		
		$gender = $data[5];	
		$zipcode = $data[6];
		$education = $data[7];
		$income = $data[8];
		$interest = $data[9];	
		$arealist = $data[10];
	    $current_date=date("Y-m-d H:i:s",time());
		if($email!='')
		{
			//interest and activities
			
			$interestkey='';
			foreach($Intrest_and_activitise as $key=>$val)
			{
				if(strtolower($val)==strtolower($interest))
				$interestkey=$key;
			}
			$incomekey='';
			foreach($income_array as $key=>$val)
			{
				if($val==$income)
				$incomekey=$key;
			}
			$educationkey='';
			foreach($education_array as $key=>$val)
			{
				if(strtolower($val)==strtolower($education))
				$educationkey=$key;
			}
			//check if email/username already exists
		  $SqlGetInfo="select * from tbl_members  where email_address='".$email."' ";//exit;
		  $QryGetInfo=$object->ExecuteQuery($SqlGetInfo);
		   $numrows=mysql_num_rows($QryGetInfo);
			if($numrows===0) 
			{	
			
			$rand_numbers=preg_replace('/([ ])/e', 'chr(rand(48,57))', '  ');
	 		$rand_alpha=preg_replace('/([ ])/e', 'chr(rand(97,122))', '   ');
			$new_rand_pwd=$rand_numbers.$rand_alpha;			 
			 $insertMember=sprintf("insert into tbl_members(full_name,last_name,email_address,password,home_city,dob,gender,zipcode,education,income,  	interests_and_activities,date_created,status)
		values('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$name,$lastname,$email,$new_rand_pwd,$cityname,$dob,$gender,$zipcode,$educationkey,$incomekey,$interestkey,$current_date,'1'); 		
		//echo $insertMember;
				$resinsertmember=$object->ExecuteQuery($insertMember);
			 	$member_id=mysql_insert_id();
	// mail code	
			$to=$email;
			$subject = "Membership Confirmation Mail From Adtingo";
			$fileName = "../../wp-content/themes/adtingo/templates/member_welcome_template.html";		
				if(file_exists($fileName))
				{
					$emailText = file_get_contents($fileName); 
				
				}
				//echo $emailText;
				$htmMsg = nl2br($email);
				$htmMsg1 = nl2br($new_rand_pwd);
				$htmMsg2 = nl2br(date('F d, Y'));
				$mailMessage = str_replace("#EMAIL#", "$htmMsg", $emailText);
				$mailMessage = str_replace("#PASSWORD#", "$htmMsg1", $mailMessage);
				$mailMessage = str_replace("#DATE#", "$htmMsg2", $mailMessage);
				//echo $mailMessage;		
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:Adtingo.com <info@adtingo.com>" ."\r\n";
				$headers .= 'Reply-To: adtingo <info@adtingo.com>'."\r\n";
				
				if(mail($to,$subject,$mailMessage,$headers)){}	

			$all_areaList=explode(",",$arealist);
			$SqlGetListInfo="select * from tbl_metropolitian_list";  
			$QryGetListInfo=$object->ExecuteQuery($SqlGetListInfo);
			$AreaListArray=array();
			$AreaListkeyArray=array();
			while($ResGetListInfo=$object->FetchArray($QryGetListInfo))
			{
				$AreaListArray[]=$ResGetListInfo['area_name'];
				$AreaListkeyArray[]=$ResGetListInfo['area_id'];
			}
				$k=0;
				for($s=0;$s<count($all_areaList);$s++)
				{
						if(in_array($all_areaList[$s],$AreaListArray))
						{
							$insertarealist=sprintf("insert into tbl_member_metropolitian(area_id,memberid)
							 values(%d,%d)",$AreaListkeyArray[$s],$member_id);
							$insertUserarealistRes=$object->ExecuteQuery($insertarealist);
						}
						else
						{
						 $InsertareaListqry=sprintf("insert into tbl_metropolitian_list (area_name,status)
						 values('%s',%d)",$all_areaList[$s],'1');
						 $InsertareaListRes=$object->ExecuteQuery($InsertareaListqry);
						 $Area_Id = mysql_insert_id();
						 $insertUserarealist=sprintf("insert into tbl_member_metropolitian(area_id,memberid)
						  values(%d,%d)",$Area_Id,$member_id);
						$insertUserarealistRes=$object->ExecuteQuery($insertUserarealist);
						
						}
						if($insertUserarealistRes)
					 	$mess="Data has been imported successfully";
						}
				}	
				$k++;
			
		}
		
		
	}
	$row++;
} 
fclose($handle);

unlink($destination);
if($mess=='')
$mess='Email or username already exists';
}

?>

<script type="text/javascript" src="../js/moo.js"></script>
<script type="text/javascript">
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
</script>


 <table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  height="30">&nbsp; </td>
  </tr>
</table>
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="customerGrid_table">
              <thead>
              
              <tr>
                <td width="83%" height="100" align="left" class="tr5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  
                  <tr>
                    <td height="20" align="left" class="content-header"> Import Data</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'><?php if($mess!="") { echo $mess; }?></font></td></tr>
                </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="right">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="28" align="left" class="form-headings">Import </td>
                    </tr>
                    
                    <tr>
                      <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
                        <thead>
                          
                         
                          <tr>
                            <td width="12%" align="left" class="tr2">
						<table width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td width="50%"  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
							 
							
							  <form name="frmchart" action="" method="post" onsubmit="return validateImport();" enctype="multipart/form-data">
							  <input id="sreachid" name="sreachid" type="hidden" value="<?php echo $trackid;?>" />
							   <input id="adminid" name="adminid" type="hidden" value="<?php echo $_REQUEST['admin'];?>" />
							     <input id="page" name="page" type="hidden" value="<?php echo $_REQUEST['page'];?>" />
								 <input id="trackids_1" name="trackids_1" type="hidden" value="<?php echo $trackid;?>" />
								 <tr>
                                <td width="30%" height="10" align="left"></td>
                                <td width="70%" height="10" align="right"><a href="download.php">Download Sample file<a></td>
                              </tr>
                              <tr>
                                <td width="30%" height="10" align="left"></td>
                                <td width="70%" height="10" align="left"></td>
                              </tr>
							      <tr>
                                <td height="30" align="left"><strong>Upload file (format: csv)</strong></td>
                                <td align="left"><input name="csvfile" id="csvfile" type="file" class="input2" value="<?php echo isset($_POST['username'])?$_POST['username']:$ResGetChartInfo['admin_username'];?>" /></td>
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