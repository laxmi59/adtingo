<?
$object=new main(); 
if(isset($_POST['submit']) && $_POST['submit']!="")
{
echo "test";
	header("location:". get_page_link(99)."/?msg=1");
	/*$to="rama@ritwik.com";
	$subject = $_POST['subject'];
	$body = $_POST['message'];
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:adtingo<info@adtingo.com>\n';
	$headers .= 'Reply-To: adtingo <info@adtingo.com>\n';
	if(mail($to,$subject,$body,$headers)){}*/
		
}
if($_GET['msg']==1)
$mess="Thanks for contacting us";
?>

<div class="content-cont-inner">
<div class="content-left">
   
      <div id="div-Form">
        <div class="form-title">Contat Us</div>
		
		<div style="clear:both"></div>
	    <div><p>&nbsp;</p>If you have questions or concerns let us know, we want to hear from you. Also,   feel free to contact us about: Story Ideas, Great Places to eat, Local   Do-Gooders. &nbsp;If you are interested in Advertising, <a href="<?php bloginfo('url'); ?>/client/">Click Here</a></div>
        <div class="requiredfields"><span class="red">*</span> Required Fields </div>
		 <div align="center" class="errer-mess"> <?php  echo $mess; ?></div>
        <div class="register-form">
		 <form method="post" name="contact_form" action="<?=get_page_link(99)?>" onsubmit="return validatecontactform()">
          <div align="center" class="errer-mess2"></div>
		  
          <dl class="form1">
            <dt>Name <span class="red">*</span></dt>
            <dd><input type="text" id="name" class="inputs" name="name"> </dd>
			<dt>Email <span class="red">*</span></dt>
            <dd><input type="text" id="email" class="inputs" name="email"> 
            </dd>
			<dt>Subject <span class="red">*</span></dt>
            <dd><input type="text" id="subject" class="inputs" name="subject"> </dd>
			<dt>Message <span class="red">*</span></dt>
            <dd>
              <textarea name="message" cols="29" rows="5" class="inputs" id="message"></textarea> 
            </dd>
            <dt></dt>
            <dd>
              <input type="submit" value="submit" id="contact_submit" name="contact_submit" class="submit-bt">
            </dd>
          </dl>
		    
          <div class="signup"> </div>
		   </form>
        </div>
		 
      </div>

  </div>
<?php get_sidebar('adtingo2'); ?>  
</div>
