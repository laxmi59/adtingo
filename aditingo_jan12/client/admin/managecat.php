<?php 
$nav=6;
include("includes/adminsessions.php");
include('includes/header.php');
//********* START CODE DELETING CHARTS **********//
if(isset($_REQUEST['delid']) && $_REQUEST['delid']!='')
{
	$Getres=$object->DeleteData(" tbl_categories","cat_id=".$_REQUEST['delid']); 
	if($Getres)
	{
		header("Location:managecat.php?msg=del&page=".$_REQUEST['page']);
		exit;
	}
}




//********** Start Code for displaying Charts  *************//

	$SqlGetCharts="select * from tbl_categories,tbl_metropolitian_list  WHERE tbl_categories.area_id=tbl_metropolitian_list.area_id";
	if($_REQUEST['areaid']!='')
	{		
		$SqlGetCharts.= " AND   tbl_categories.area_id =".$_REQUEST['areaid'];
	}
	
	if($_REQUEST['field']=='cat')
	{
		$field='cat_name';
		$order=$_REQUEST['order'];
		$SqlGetCharts.= " Order By ".$field." ".$order;
	}
	
	else
	{
		$SqlGetCharts.=" Order By cat_id DESC";
	}
	 $QryGetCharts=$object->ExecuteQuery($SqlGetCharts);
	$cols=$object->NumRows($QryGetCharts);
	
	if(!isset($_REQUEST['page']))
		$page=1;	
	else
		$page=$_REQUEST['page'];
	
	
	$let=ceil($cols/$limit);
	
	$getPaginationRecords=$object->paginationTop($cols,$limit,$page);
	$SqlGetCharts=$SqlGetCharts." LIMIT $getPaginationRecords,$limit";
	
	//echo $SqlGetCatGener;
	$QryGetCharts=$object->ExecuteQuery($SqlGetCharts);
	
	
	
//********** End Code for displaying categories genres  *************//
 ?>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Categories </td>
    <td align="right"  class="padbot5"><a href="add-edit-cat.php">Add Category </a></td>
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
    </tr>
	<?php
 if($_REQUEST['msg']=="added")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Category has been added successfully</font></td></tr>
<?php
}if($_REQUEST['msg']=="update")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Category has been updated successfully</font></td></tr>
<?php
}
if($_REQUEST['msg']=="del")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Category has been deleted successfully</font></td></tr>
<?php
}
if($_REQUEST['msg']=="Deact")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Category has been deactivated successfully</font></td></tr>

<?php
}
if($_REQUEST['msg']=="Act")
{
?>
<tr><td colspan="3" align="center"><font style='font-family:Arial;font-weight:bold;color:#336600; font-size:13px;'>Category has been activated successfully</font></td></tr>

<?php
}?>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
  <?php $pagename="managecat.php?field=".$_GET['field']."&order=".$_GET['order']."";?>
   <tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,$pagename); ?> of <?php echo $let;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtval(this.value+'&field=<?php echo $_GET['field'];?>&order=<?php echo $_GET['order'];?>','managecat');">
		<?php echo $page_num_str=$object->select_function($page_num_array,$limit);?>
      </select>
per page</td><td align="right">Select Metropolitian Area: <select name="arealist" id="arealist" onchange="return shortareaList(this.value);">
<option value="">All</option> 
<?php echo $area_list=$object->Getmetropolitianareas($_REQUEST['areaid']);?>

</select></td>
    </tr>
  <tr>
    <td height="10"></td>
  </tr>
</table>
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table">
            <thead>
              <tr>
                <td width="33%" align="left" class="headings">Category Name  </td>
                <td width="43%" align="left" class="headings">Metropolitan Areas  <a href="managecat.php?page=<?php echo $page;?>&field=cat&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="managecat.php?page=<?php echo $page;?>&field=cat&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <!--<td width="25%" align="left" class="headings">End Date <a href="manageadmin.php?page=<?php //echo $page;?>&field=ed&order=ASC&limit=<?php //echo $limit;?>"><img src="images/up.gif"  /></a><a href="manageadmin.php?page=<?php //echo $page;?>&field=ed&order=DESC&limit=<?php //echo $limit;?>"><img src="images/down.gif"  /></a></td>-->
                <td width="24%" align="left" class="headings">Action</td>
              </tr>
			 <?php 
			 
			 $i=0;
	if($cols>0)
	{	
		while($ResGetCharts=$object->FetchArray($QryGetCharts))
		{
			
			if($i%2==0)
				$class="tr1";
			else
				$class="tr2";
			?>
			
			<tr>
                <td align="left" class="tr1"><?php echo stripslashes($ResGetCharts['cat_name']);?></td>
                <td align="left" class="tr1"><?php echo $ResGetCharts['area_name'];?></td>
            
                <td align="left" class="tr1"><a href="add-edit-cat.php?catid=<?php echo $ResGetCharts['cat_id'];?>&page=<?php echo $page;?>"><img src="images/edit.gif" title="Edit" alt="Edit" align="absmiddle"/></a><a href="javascript:deletecat('<?php echo $ResGetCharts['cat_id'];?>','<?php echo $page;?>');"><img src="images/delete.gif" title="Delete" alt="Delete" align="absmiddle"/></a></td></tr>
				<?php
			  $i++;
		}
		
	}
	else
	{ ?>
		<tr>
        <td align="center" class="tr1" colspan="4">No Categories Found</td>
        </tr>
	 <?php 
	}
			 
			 ?>
              
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
       <?php include('includes/footer.php'); ?>