<?php
error_reporting(0);
include("includes/adminsessions.php");
require_once("includes/set_env.php");
include('includes/functions.php');
include('includes/values.php');
$object=new main();

$art_id=$_REQUEST['mid'];
if($art_id=="")
{
header("location:artists.php");
exit;
}
$SqlGetUserFlag=sprintf("select * from `tbl_catart` WHERE `art_id` =$art_id");
$QryGetUserFlag=$object->ExecuteQuery($SqlGetUserFlag);
$cols=$object->NumRows($QryGetUserFlag);
$ResGetUserFlag=$object->FetchArray($QryGetUserFlag);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Adtingo</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="images/css.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/reset.css" media="all" />

</head>

 <body>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10"><img src="images/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="wbg">
        <tr>
          <td align="left" valign="top"><img src="images/box_top_left.gif" width="3" height="3"></td>
          <td align="right" valign="top"><img src="images/box_top_right.gif" width="3" height="3"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td class="wbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/spacer.gif" width="1" height="1"></td>
          <td height="5" valign="top"><img src="images/spacer.gif"></td>
          <td><img src="images/spacer.gif"></td>
        </tr>
        <tr>
          <td width="10">&nbsp;</td>
          <td height="300" valign="top">
            <!-- <form name="loginfrm" method="post" action="<?=$PHP_SELF?>"> -->            <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1">
              <tr>
                <td>
				<h3>View Category Artical details</h3>
                    <table width="100%"  border="0" cellpadding="1" cellspacing="0" class="border">
                      <tr>
                        <td><table width="100%"  border="0" cellpadding="3" cellspacing="0" class="td">
                            <tr>
                              <td width="100%" colspan="2" align="left" class="h1"></td>
                            </tr>
                          </table>
                            <table width="100%"  border="0" cellpadding="5" cellspacing="5" height="40px;" >
							<tr align="left">
                                <td width="17%" >Category  </td>
                                <td width="83%" ><?php 
								$cat=mysql_fetch_array(mysql_query("select * from `wp_terms` where `term_id`=$ResGetUserFlag[cat_id]")); echo $cat['name'] ?></td>
						   	</tr>
							<tr align="left">
                                <td >Title</td>
                                <td align="justify" ><?php echo substr(stripslashes($ResGetUserFlag['title']),0,100); ?></td>
						   	</tr>
							
							<tr align="left">
                                <td >Image</td>
                                <td align="justify" >
								<?php if($ResGetUserFlag['img']<>'')
					$show_img="articles/".$ResGetUserFlag['img'];
					else
					$show_img="images/content-110x110pic.jpg";
				?>
				<?php if($ResGetUserFlag['url']<>''){?>
								
								<img src="<?php echo $show_img?>" width="110" height="110" alt="<?php echo stripslashes($ResGetUserFlag['title']); ?>" title="<?php echo stripslashes($ResGetUserFlag['title']); ?>" />
								<?php }else{?>
								<img src="<?php echo $show_img?>" width="110" height="110" alt="<?php echo stripslashes($ResGetUserFlag['title']);?>" title="<?php echo stripslashes($ResGetUserFlag['title']);?>" />
				<?php }?>
								</td>
						   	</tr>
							
							 	<tr align="left">
                                <td >Content</td>
                                <td align="justify" ><?php echo stripslashes($ResGetUserFlag['desc']); ?></td>
						   	</tr>
							
							<tr align="left">
                                <td >Date</td>
                                <td ><?php echo date('d M, Y',strtotime($ResGetUserFlag['date'])); ?></td>
						   	</tr>
							
					        			
					
                                 <!-- only SiteUsers are having Password -->
							 

                             
                          </table></td>
                      </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="10">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="22" align="center" class="wbg"><a href="javascript:window.close();">Close Window</a> </td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="wbg">
        <tr>
          <td align="left" valign="bottom"><img src="images/box_bot_left.gif" width="3" height="3"></td>
          <td align="right" valign="bottom"><img src="images/box_bot_right.gif" width="3" height="3"></td>
        </tr>
    </table></td>
  </tr>
</table>
 
    

</body>
</html>
