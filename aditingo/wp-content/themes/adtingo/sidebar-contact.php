<?
$object=new main(); 
if(isset($_POST['unsub_submit']) && $_POST['unsub_submit']!="")
{
	mysql_query("insert into `tbl_contact` (`name`, `email`, `subject`, `message`, `date`) values ('$_POST[contact_name]', '$_POST[email]', '$_POST[contact_subject]', '$_POST[contact_message]', now())");

	$to="info@adtingo.com";
	$subject = $_POST['contact_subject'];
	$body = "Message From <br> Name : ".$_POST['contact_name']."<br> Email : ".$_POST['email'].$_POST['contact_message'];
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:adtingo<info@adtingo.com>\n';
	$headers .= 'Reply-To: adtingo <info@adtingo.com>\n';
	if(mail($to,$subject,$body,$headers)){}
	header("location:". get_page_link(97)."/?msg=1");
}

if($_GET['msg']==1)
$mess="Thanks for Contacting Us";
?>
<div class="content-cont-inner">
<div class="content-left">
   
      <div id="div-Form">
        <div class="form-title">Contact Us</div>
		
		<div style="clear:both"></div>
	    <div><p>&nbsp;</p>If you have questions or concerns let us know, we want to hear from you. Also,   feel free to contact us about: Story Ideas, Great Places to eat, Local   Do-Gooders. &nbsp;If you are interested in Advertising, <a href="http://clients.adtingo.com/">Click Here</a></div>
		
        <div class="requiredfields"><span class="red">*</span> Required Fields </div>
		 <div align="center" class="errer-mess1">
        <?php  echo "<br>".$mess; ?>
      </div>
        <div class="register-form">
          <div align="center" class="errer-mess2"></div>
		   <form method="post" name="teee" id="teeee" onsubmit="return validatecontactform();">
          <dl class="form1">
		  	<dt>Name <span class="red">*</span></dt>
            <dd><input type="text" id="contact_name" class="inputs" name="contact_name"> </dd>
           	<dt>Email <span class="red">*</span></dt>
            <dd><input type="text" id="email" class="inputs" name="email"> </dd>
			<dt>Subject <span class="red">*</span></dt>
            <dd><input type="text" id="contact_subject" class="inputs" name="contact_subject"> </dd>
			<dt>Message <span class="red">*</span></dt>
            <dd>
              <textarea name="contact_message" cols="29" rows="5" class="inputs" id="contact_message"></textarea> 
            </dd>
            <dt></dt>
            <dd>
              <input type="submit" value="submit" id="unsub_submit" name="unsub_submit" class="submit-bt">
            </dd>
          </dl>
		      </form>
          <div class="signup"> </div>
        </div>
      </div>

  </div>
<?php get_sidebar('adtingo2'); ?>  
</div>
