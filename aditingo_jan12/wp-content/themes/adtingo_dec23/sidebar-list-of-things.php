<?php
get_header(); 

$sel=mysql_fetch_array(mysql_query("select * from `tbl_email_template_content` where TId='$_GET[id]'"));

?>
<!-- #content -->
<div  class="content-cont-inner">
<!--Left content -->
<div class="content-left">
 <div class="form-title">List of Things to Come</div>
<h4 class="skyblue-tit"><strong style="text-transform:uppercase">
<!--ELECTRONICS &amp; GADGETS </strong>\ Article Entry Breadcrumb-->
</strong>
</h4>
<!--<div class="inner-con-left">-->
<div class="clear"></div><br /><br />
<?php if($sel['paragraph1']<>""){ echo stripslashes($sel['paragraph1'])."<br /><br />"; }?>
<?php if($sel['paragraph2']<>""){ echo stripslashes($sel['paragraph2'])."<br /><br />"; }?>
<?php if($sel['paragraph3']<>""){ echo stripslashes($sel['paragraph3'])."<br />"; }?>
<!--</div>-->
<div class="clear"></div>
  </div><!--Left content ends-->
<!--right content -->
<?php get_sidebar('adtingo2'); ?>  
<!--right content ends-->
</div>
<?php get_footer(); ?>
