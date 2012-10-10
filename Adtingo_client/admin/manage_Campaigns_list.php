<?php 
$nav=12;
include("includes/adminsessions.php");
include('includes/header.php'); 
?>
<script language="javascript" type="text/javascript">
function checkclientsel()
{
if(document.clientselection.clientselect.value=="")
{
alert("Please select Client");
return false;
}
return true;
}
function loc(nid)
{
	window.location='manage_Campaigns_list2.php?uid='+nid;
}
</script>
<form name="clientselection" id="clientselection" action="manage_Campaigns_list2.php" method="post" onsubmit="return checkclientsel();">
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Manage Campaigns  </td>
<td align="right"  class="padbot5">&nbsp;</td>
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
    </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">&nbsp;</td>
            </tr>
            <tr>
              <td height="28" align="left" class="form-headings">Client selection</td>
            </tr>
            <tr>
              <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
                  <thead>
                    <tr>
                      <td width="12%" align="left" class="tr2"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                          <tr>
                            <td width="50%"  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
                             
                                <tr>
                                  <td width="30%" height="30" align="left"><strong>Select Client</strong></td>
                                  <td width="70%" align="left"><select name="clientselect" id="clientselect" class="w-165" onchange="return loc(this.value)">
								  <option value="">Select Client</option>
								  <?php echo $object->GetAllClientsinfo();?>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left">&nbsp;</td>
                                  <td align="left">
                                    <!--<input name="Submit" type="submit" class="button" id="Submit" value="Next" />-->
                                   </td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                            </table></td>
                            <td width="50%" valign="top"></td>
                          </tr>
                      </table></td>
                    </tr>
                  </thead>
              </table></td>
            </tr>
            <tr>
              <td></thead></td>
            </tr>
            <tbody>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
  </tr>
      </table>
    
	  
      
  </form> 

<?php include('includes/footer.php'); ?>