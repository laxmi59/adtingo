<?php 
$nav=5;
include("includes/adminsessions.php");
include('includes/header.php');
include('includes/values.php');
	$mess="";
	$current_date=date("Y-m-d H:i:s");
	$source=$_FILES['csvfile']['tmp_name']; 
	$filename=time().$_FILES['csvfile']['name'];
	$destination="uploads/sample2.csv"; 
	$chk=move_uploaded_file($source,$destination); 
	//echo file_get_contents($destination);exit;
	$row = 0;
	$handle = fopen($destination, "r");
	
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	if ($row > 0) {
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
		  $SqlGetInfo="select * from tbl_members where email_address='".$email."' ";//exit;
		  //echo $SqlGetInfo;
		  	$QryGetInfo=$object->ExecuteQuery($SqlGetInfo);
		   	$numrows=mysql_num_rows($QryGetInfo);
			if($numrows!=0) 
			{	
				
				$insertMember=sprintf("update tbl_members set full_name='%s',last_name='%s' where email_address='%s'",$name,$lastname,$email);		
				echo $insertMember;"<br>";
				$resinsertmember=$object->ExecuteQuery($insertMember);
				//$member_id=mysql_insert_id();
				// mail code	
				$mess="<span class='errer-mess2'>Data has been imported successfully</span>";
				
				
			}	
			$k++;
		}
	}
	$row++;
} 
fclose($handle);

unlink($destination);
if($mess=='')
$mess="<span class='errer-mess2'>Email or username already exists</span>";
//}

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
                                <td width="70%" height="10" align="right"><a href="download.php">Download Sample file</a></td>
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
                       
                      </table></td>
                    </tr>
					</thead>
                  </table></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
     <?php include('includes/footer.php'); ?>