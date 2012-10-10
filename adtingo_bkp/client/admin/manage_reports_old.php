<?php 
$nav=11;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');


//$con=mysql_connect("localhost","root","");
//mysql_select_db("adtingodb",$con);

 ?>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="27%" height="30">&nbsp;</td>
    <td width="73%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Manage Campaign Reports </td>
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
    <td class="form-bg2">
	<table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table">
    <tr>
        <td align="left" class="tr1"><b>Select Client</b></td>
		<td align="left" class="tr1">
		<? $SqlGetClients=mysql_query("SELECT * FROM `tbl_clients` WHERE STATUS =1");
		//echo "select * from `tbl_clients` where status=1";
		//echo mysql_num_rows($SqlGetClients);
		?>
		<select name="client" onchange="getCampaigns(this.value)">
			<option value="">&nbsp;Select Client&nbsp;&nbsp;</option>
		<?	while($ResGetClients=mysql_fetch_array($SqlGetClients)){?>
         	<option value="<?=$ResGetClients['clientid']?>"><?=$ResGetClients['full_name']?></option>
		<? }?>
          </select>
		</td>
	</tr>
    </table></td>
  </tr>
</table>
<?php include('includes/footer.php'); ?>
