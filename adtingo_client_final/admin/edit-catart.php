<?php 
$nav=10;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php'); 



//********* START CODE FOR UPDATING PROFILE **************//
if(isset($_POST['submitproduct']) && $_POST['submitproduct']!='')
{	
if($_REQUEST['mid']=='')
	{	
		//echo "tt";
		 $insertMemInfo=sprintf("insert into tbl_catart(`cat_id`,`title`,`desc`,`date`,`url`) values(%d,'%s','%s','%s','%s')",$object->stripper($_POST['cat_id']),$object->stripper($_POST['title']),$object->stripper($_POST['content']),date('Y-m-d'),$object->stripper($_POST['url'])); 
		// echo $insertMemInfo;
		$QryinsertMemInfo=$object->ExecuteQuery($insertMemInfo);
		
		$memberid=mysql_insert_id();
		if($_FILES['main_image']['name']!='')
		{
		
			    $filedir="articles/";
				$source=$_FILES['main_image']['tmp_name'];	
				$source_name=$_FILES['main_image']['name'];
				$up_flag='y';
				$main_image_lastname=time()."_".$source_name;
				$dest=$filedir.$main_image_lastname;
				$thumbdest="articles/thumb_images/".$main_image_lastname;
				move_uploaded_file($source, $dest);
				$imagepath_temporary = $_FILES['main_image']['tmp_name'];
				list($width,$height,$type) = getimagesize($dest);
				$uploaded_image_size = $_FILES["main_image"]["size"];
				$Insert_main_image_Qry=sprintf("update tbl_catart set `img`='%s' where `art_id`=%d",$object->stripper($main_image_lastname),$object->stripper($memberid));  
				// echo $Insert_main_image_Qry;
				$Insert_main_image_Res=$object->ExecuteQuery($Insert_main_image_Qry); 
		
		}
		$msg="added";
	}
	else
	{
	//echo date('Y-m-d');
		 $updateuserinfo=sprintf("update tbl_catart set `cat_id`='%d',`title`='%s', `desc`='%s', `date`='%s', `url`='%s'  where art_id=%d",$object->stripper($_POST['cat_id']),$object->stripper($_POST['title']),$object->stripper($_POST['content']),date('Y-m-d'),$object->stripper($_POST['url']),$object->stripper($_REQUEST['mid']));
		 
$QryinsertMemInfo=$object->ExecuteQuery($updateuserinfo);

	$memberid=$_REQUEST['mid'];
	if($_FILES['main_image']['name']!='')
		{
		
			    $filedir="articles/";
				$source=$_FILES['main_image']['tmp_name'];	
				$source_name=$_FILES['main_image']['name'];
				$up_flag='y';
				$main_image_lastname=time()."_".$source_name;
				$dest=$filedir.$main_image_lastname;
				$thumbdest="articles/thumb_images/".$main_image_lastname;
				move_uploaded_file($source, $dest);
				$imagepath_temporary = $_FILES['main_image']['tmp_name'];
				list($width,$height,$type) = getimagesize($dest);
				$uploaded_image_size = $_FILES["main_image"]["size"];
				$Insert_main_image_Qry=sprintf("update tbl_catart set `img`='%s' where `art_id`=%d",$object->stripper($main_image_lastname),$object->stripper($memberid));  
				// echo $Insert_main_image_Qry;
				$Insert_main_image_Res=$object->ExecuteQuery($Insert_main_image_Qry); 
		
		}

$msg="update"; 
}
if($_POST['primary_cat']=='on'){
	$qur=sprintf("Select * from tbl_catart where cat_id=%d and `primary_cat`='%s'",$object->stripper($_POST['cat_id']),$object->stripper($_POST['primary_cat']));
	//echo $qur;
	$ChkPrimary=$object->ExecuteQuery($qur);
	$ChkPrimaryNum=$object->NumRows($ChkPrimary);
	if($ChkPrimaryNum <>''){
		while($ChkPrimaryFetch=$object->FetchArray($ChkPrimary)){
			$updQur=mysql_query("update `tbl_catart` set `primary_cat`='' where art_id='".$ChkPrimaryFetch['art_id']."'");
			//echo "update `tbl_catart` set `primary`='' where art_id='".$ChkPrimaryFetch['art_id']."'";
		}
		$updQur=mysql_query("update `tbl_catart` set `primary_cat`='on' where art_id=$memberid");
	}
	else
		$updQur=mysql_query("update `tbl_catart` set `primary_cat`='on' where art_id=$memberid");
}else{
	$qur=sprintf("Select * from tbl_catart where cat_id=%d",$object->stripper($_POST['cat_id']));
	$ChkPrimary=$object->ExecuteQuery($qur);
	$ChkPrimaryNum=$object->NumRows($ChkPrimary);
	if($ChkPrimaryNum==1)
		$updQur=mysql_query("update `tbl_catart` set `primary_cat`='on' where art_id=$memberid");
		
}

			
if($QryinsertMemInfo)
{
	header("Location:category_article.php?msg=$msg&page=".$_POST['page']);
	exit;
	
}
		
}
//********* END CODE FOR UPDATING PROFILE **************//
//************** START DISPLAY PROFILE VALUES ************//
$SqlGetUserDetails=sprintf("select * FROM tbl_catart  where art_id=%d ",$object->stripper($_REQUEST['mid']));
$QryGetUserDetails=$object->ExecuteQuery($SqlGetUserDetails);
$QryGetUserDetailsRec=$object->FetchArray($QryGetUserDetails);


//************** END DISPLAY PROFILE VALUES ************//
if($_REQUEST['mid']=='')
	$title='Add';
else
	$title='Edit';
?>


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
                <td width="83%" height="100" align="left" class="tr5">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">                  
                  <tr>
                    <td height="20" align="left" class="content-header"> Local Do-Gooders </td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>  <form action="" method="post" name="articlefrm" enctype="multipart/form-data" onsubmit="return validatearticle();" >
				
<input type="hidden" name="userid" id="userid" value="<?php echo $_REQUEST['mid']; ?>" />
<input type="hidden" name="page" id="page" value="<?php echo $_REQUEST['page']; ?>" />

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
                            <td width="12%" align="left" class="tr2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="23%" height="10" align="left"></td>
                                <td width="76%" height="10" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Category</strong></td>
                                <td align="left">
								<?php
									//$sel_term_taxmony=mysql_query("select * from `wp_term_taxonomy` where `taxonomy`='category' and `parent`=0");
									$sel_term_taxmony=mysql_query("select * from `tbl_metropolitian_list`");
									
								?>
								<select name="cat_id" id="cat_id" style="width:200px">
								<option value="">Select Category</option>
								<?php while($sel_term_taxmony_fet=mysql_fetch_array($sel_term_taxmony)){
								//$sel_terms_fet=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$sel_term_taxmony_fet[term_id]"));
								//if($sel_terms_fet['term_id']==1) continue;
								?>
                                  <option value="<?php echo $sel_term_taxmony_fet['area_id']?>" <?php if($QryGetUserDetailsRec['cat_id']==$sel_term_taxmony_fet['area_id']) echo "selected='selected'"?> ><?php echo $sel_term_taxmony_fet['area_name']?></option>
								 <?php }?>
                                </select>                                </td>
                              </tr>
							  <tr>
                                <td height="30" align="left"><strong>Title</strong></td>
                                <td align="left"> 
                                 <input type="text" value="<?php if($QryGetUserDetailsRec['title']!='') echo stripslashes($QryGetUserDetailsRec['title']);?>"  name="title" id="title" size="80" />                         </td>
                              </tr>
							  <tr>
                                <td height="30" align="left"><strong>URL</strong></td>
                                <td align="left"> 
                                 <input type="text" value="<?php if($QryGetUserDetailsRec['url']!='') echo stripslashes($QryGetUserDetailsRec['url']);?>"  name="url" id="url" size="80" /> <br />
                                 Ex: http://www.adtingo.com</td>
                              </tr>
							  <tr>
							  	<td><strong>Image</strong></td>
								<td><input type="file" name="main_image" id="main_image" /></td>
							  </tr>
							  <tr><td colspan="2">&nbsp;</td></tr>
							  <?php if($QryGetUserDetailsRec['img']<>''){?>
							  <tr>
							  	<td valign="middle"><strong>Image</strong></td>
								<td><img src="articles/<?php echo $QryGetUserDetailsRec['img']?>" width="110" height="110" title="<?php echo stripslashes($QryGetUserDetailsRec['title']);?>" alt="<?php echo stripslashes($QryGetUserDetailsRec['title']);?>" /></td>
							  </tr>
							  <tr height="10"><td></td></tr>
							  <?php }?>
                             
                              <tr>
                                <td height="30" align="left"><strong>Content</strong></td>
                                <td align="left"> 
								 <textarea name="content" cols="50" rows="10" id="content"><?php if($QryGetUserDetailsRec['desc']!='') echo stripslashes($QryGetUserDetailsRec['desc']); ?></textarea>		  </td>
                              </tr>
                          <?php if($_REQUEST['mid']=='')   {?>
						 <tr height="10"><td></td></tr>
                                <tr>
                                  <td height="30" align="left">&nbsp;</td>
                                  <td align="left" ><input type="checkbox" value="on" name="primary_cat" id="primary_cat" <?php if($QryGetUserDetailsRec['primary_cat']=='on'){?> checked="checked"<?php }?> />&nbsp;&nbsp;<strong>Set as Primary Article </strong></td>
                                </tr>
								<?php }?>
                                <tr>
                                  <td height="30" align="left">&nbsp;</td>
                                  <td align="left" >&nbsp;</td>
                                </tr>
                                <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left" >
                                  <input name="submitproduct" type="submit" class="button" id="submitproduct" value="Submit" />                                                            </td>
                              </tr>
                              
                            </table></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                    </tr>
                  </table></form></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
	 
     <?php include('includes/footer.php'); ?>