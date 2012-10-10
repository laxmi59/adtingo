<?php 
$nav=6;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('../includes/values.php'); 


//********* START CODE FOR UPDATING PROFILE **************//
if(isset($_REQUEST['button3']) && $_REQUEST['button3']!='')
{	
if($_REQUEST['catid']=='')
	{	
		 $insertcatInfo=sprintf("insert into tbl_categories(area_id,cat_name,status) values(%d,'%s',%d)",$object->stripper($_POST['metropolitin_area']),$object->stripper($_POST['catname']),'1'); 
		$QryinsertcatInfo=$object->ExecuteQuery($insertcatInfo);
		$msg="added";
	}
	else
	{
		 $updatecatinfo=sprintf("update tbl_categories set area_id='%s', cat_name='%s' where  cat_id=%d",$object->stripper($_POST['metropolitin_area']),$object->stripper($_POST['catname']),$object->stripper($_REQUEST['catid']));
$QryinsertcatInfo=$object->ExecuteQuery($updatecatinfo);
$msg="update"; 
}
	
	if($QryinsertcatInfo)
	{
		header("Location:managecat.php?msg=$msg&page=".$_POST['page']);
		exit;
		
	}
		
}
//********* END CODE FOR UPDATING PROFILE **************//
//************** START DISPLAY PROFILE VALUES ************//
$SqlGetcatDetails=sprintf("select * FROM tbl_categories  where cat_id=%d ",$object->stripper($_REQUEST['catid']));
$QryGetcatDetails=$object->ExecuteQuery($SqlGetcatDetails);
$QryGetcatDetailsrec=$object->FetchArray($QryGetcatDetails);
//************** END DISPLAY PROFILE VALUES ************//
if($_REQUEST['catidid']=='')
	$title='Add';
else
	$title='Edit';
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
                    <td height="20" align="left" class="content-header"> Manage Categories</td>
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
							 
							
							  <form name="frmchart" action="" method="post" onsubmit="return validatecategories();">
							  <input id="sreachid" name="sreachid" type="hidden" value="<?php echo $trackid;?>" />
							   <input id="adminid" name="adminid" type="hidden" value="<?php echo $_REQUEST['admin'];?>" />
							     <input id="page" name="page" type="hidden" value="<?php echo $_REQUEST['page'];?>" />
								 <input id="trackids_1" name="trackids_1" type="hidden" value="<?php echo $trackid;?>" />
                              <tr>
                                <td width="30%" height="10" align="left"></td>
                                <td width="70%" height="10" align="left"></td>
                              </tr>
                                <tr>
                              <td  align="left" height="30"  valign="top"><strong>Metropolitian Area</strong></td>
							   <td align="left"><select name="metropolitin_area" id="metropolitin_area" >
							   <option value="" >Select Area </option>
                  <?php
			echo $object->Getmetropolitianareas($QryGetcatDetailsrec['area_id']);
		   ?>
                        </select> </td>
							   </tr>
                              <tr>
                                <td height="30" align="left"><strong>Category Name</strong></td>
                                <td align="left"><input name="catname" id="catname" type="text" class="input2" value="<?php echo isset($_POST['catname'])?$_POST['catname']:$QryGetcatDetailsrec['cat_name'];?>" /></td>
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