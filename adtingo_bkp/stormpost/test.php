<title>Campaigns</title>
<style type="text/css">
<!--
.style1 {font-size: 18px}
a{color:#0099FF; text-decoration:none;}
a:hover{color:#0066FF;}
-->
</style>
<table width="80%" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top"><table width="95%" border="0" align="center" cellpadding="10" cellspacing="10">
      <tr>
        <td><a href="test.php?act=create_send" class="style1">Create and send Campaign </a></td>
      </tr>
      <tr>
        <td><a href="test.php?act=create" class="style1">Create Campaign</a></td>
      </tr>
      <tr>
        <td><a href="test.php?act=sending" class="style1">Send Campaign</a></td>
      </tr>
      <tr>
        <td><a href="test.php?act=report" class="style1">Generate Report</a></td>
      </tr>
     <!-- <tr>
        <td><a href="action.php?act=greport" class="style1">Generate Graph Report </a></td>
      </tr>
	  <tr>
        <td><a href="test.php?act=preport" class="style1">Generate Pie Chart </a></td>
      </tr>-->
    </table></td>
    <td valign="top">
	<? if($_GET['act']=='create' || $_GET['act']=='create_send'){$btn="Create"?>
	<form method="post" action="action.php?act=<?=$_GET['act']?>">
	<table width="90%" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td colspan="3"><div align="center"><strong>Create New Campaign </strong></div></td>
    </tr>
  <tr>
    <td>Title</td>
    <td>:</td>
    <td><input name="title" type="text" size="40"></td>
  </tr>
  <tr>
    <td>Subject</td>
    <td>:</td>
    <td><input name="subject" type="text" size="40"></td>
  </tr>
  <tr>
    <td>Text Content</td>
    <td>:</td>
    <td><textarea name="textContent" cols="25"></textarea></td>
  </tr>
  <tr>
    <td>HtmlContent</td>
    <td>:</td>
    <td><textarea name="htmlContent" cols="25"></textarea></td>
  </tr>
  <? if($_GET['act']=='create_send'){ $btn="Create and Send"?>
  <tr>
    <td>Email Id </td>
    <td>:</td>
    <td><textarea name="mails" cols="25"></textarea><br />Ex: abc@abc.com,xyz@abc.com</td>
  </tr>
  <? }?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" value="<?=$btn?>"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
	<? }?>
<? if($_GET['act']=='sending'){?>
<form method="post" action="action.php?act=sending">
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td colspan="3"><div align="center"><strong>Sending template </strong></div></td>
  </tr>
  <tr>
    <td>Template Id</td>
    <td>:</td>
    <td><input  name="cid" type="text" size="40" /></td>
  </tr>
  <tr>
    <td>Email Id </td>
    <td>&nbsp;</td>
    <td><textarea name="mails" cols="25"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" value="Send"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<? }?>
<? if($_GET['act']=='report' || $_GET['act']=='preport'){
if($_GET['act']=='preport')$tt="action.php?act=$_GET[act]&type=12"; else $tt="action.php?act=$_GET[act]";
?>
<form method="post" action="<?=$tt?>">
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td colspan="3"><div align="center"><strong>Detailed Report </strong></div></td>
  </tr>
  <tr>
    <td>Mailing Id</td>
    <td>:</td>
    <td><input  name="rid" type="text" size="40" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" value="Show"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<? }?>

	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
	
	</td>
  </tr>
</table>
