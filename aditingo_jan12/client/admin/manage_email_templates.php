<?php 
$nav=9;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');

$SqlGetEmailTemplates="select * from tbl_email_template_content";
$ResGetEmailTemplates=$object->ExecuteQuery($SqlGetEmailTemplates);


 ?>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="27%" height="30">&nbsp;</td>
    <td width="73%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Manage Email Templates</td>
  <td width="73%" class="errer-mess2"></td>
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
  </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="errer-mess2"><?php if($_REQUEST['msg']=='edit') {?>
      Email Template has been updated successfully
      <?php } ?></td>
  </tr>
   
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table">
        <thead>
          <tr>
            <td width="50%"   height="20" align="left" class="headings">Template Name </td>
            <td width="50%"  align="left" class="headings">Options</td>
          </tr>
          <?php while($RecGetEmailTemplates=$object->FetchArray($ResGetEmailTemplates))
			{ ?>
		  <tr>
            <td align="left" class="tr1"><?php echo stripslashes($RecGetEmailTemplates['Template Name']);?></td>
            <td align="left" class="tr1"> <a href="edit_email_template.php?Tid=<?php echo $RecGetEmailTemplates['TId'];?>"><img src="images/edit.gif" alt="Edit"  border="0" /></a></td>
          </tr>
		  <?php
		  }?>
          
        </thead>
        <tbody>
        </tbody>
      </table></td>
  </tr>
</table>
<?php include('includes/footer.php'); ?>
