<?php 
$nav=7;
include_once("includes/adminsessions.php");
include_once('includes/header.php');
//********* START CODE DELETING CHARTS **********//
if(isset($_REQUEST['delid']) && $_REQUEST['delid']!='')
{
	$resquery=$object->ExecuteQuery("select * from `tbl_metropolitian_list` where area_id=".$_REQUEST['delid']);
	$res=$object->FetchArray($resquery);
	$res1query=$object->ExecuteQuery("select * from `wp_terms` where term_id='".$res['cat_id']."'");
	$res1=$object->FetchArray($res1query);
	$subres=$object->ExecuteQuery("select * from `wp_term_taxonomy` where parent='".$res1['term_id']."'");
	$b=$object->DeleteData(" wp_term_taxonomy","parent='".$res1['term_id']."'"); 
	while($subres_fet=$object->FetchArray($subres)){
		$a=$object->DeleteData(" wp_terms","term_id='".$subres_fet['term_id']."'"); 
	}
	$c=$object->DeleteData(" wp_terms","term_id='".$res1['term_id']."'"); 
	$d=$object->DeleteData(" wp_term_taxonomy","term_id='".$res1['term_id']."'");
	$Getres=$object->DeleteData(" tbl_metropolitian_list","area_id=".$_REQUEST['delid']); 
	if($Getres)
	{
		header("Location:managearealist.php?msg=del&page=".$_REQUEST['page']);
		exit;
	}
}

//********** Start Code for displaying metropolitian list  *************//
	$SqlGetCharts="select * from tbl_metropolitian_list";
	if($_REQUEST['field']=='area')
	{
		$field='area_name';
		$order=$_REQUEST['order'];
		$SqlGetCharts.= " Order By ".$field." ".$order;
	}
	else
	{
		$SqlGetCharts.=" Order By area_name";
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
	
//********** End Code for displaying metropolitian list  *************//
 ?>
<table width="95%" border="0" cellspacing="0" cellpadding="0">  
  <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Manage Metropolitian Areas </td>
    <td align="right"  class="padbot5"><a href="add-edit-list.php">Add Metropolitian area </a></td>
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
    </tr>
<?php
	if($_REQUEST['msg']=="added")
	{
?>
<tr><td colspan="3" align="center" class="errer-mess2">Metropolitian area has been added successfully</td></tr>
<?php
	}
	if($_REQUEST['msg']=="update")
	{
?>
<tr><td colspan="3" align="center" class="errer-mess2">Metropolitian area has been updated successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="del")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2">Metropolitian area has been deleted successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="Deact")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2">Metropolitian area has been deactivated successfully</td></tr>

<?php
}
if($_REQUEST['msg']=="Act")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2">Metropolitian area has been activated successfully</td></tr>

<?php
}?>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td height="10"></td>
  </tr>
  <?php $pagename="managearealist.php?field=".$_GET['field']."&order=".$_GET['order']."";?>
  <tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,$pagename); ?> of <?php echo $let;?> pages        |   view
	<select name="limit" class="input2" onchange="limtval(this.value+'&field=<?php echo $_GET['field'];?>&order=<?php echo $_GET['order'];?>','managearealist');">
		<?php echo $page_num_str=$object->select_function($page_num_array,$limit);?>
      </select>
per page</td>
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
                <!--<td width="30%" align="left" class="headings">Area Id </td>-->
                <td width="48%" align="left" class="headings">Metropolitian Area Name <a href="managearealist.php?page=<?php echo $page;?>&field=area&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="managearealist.php?page=<?php echo $page;?>&field=area&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <!--<td width="25%" align="left" class="headings">End Date <a href="manageadmin.php?page=<?php //echo $page;?>&field=ed&order=ASC&limit=<?php //echo $limit;?>"><img src="images/up.gif"  /></a><a href="manageadmin.php?page=<?php //echo $page;?>&field=ed&order=DESC&limit=<?php //echo $limit;?>"><img src="images/down.gif"  /></a></td>-->
                <td width="22%" align="left" class="headings">Options</td>
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
                <!--<td align="left" class="tr1"><?php echo $ResGetCharts['area_id'];?></td>-->
                <td align="left" class="tr1"><?php echo stripslashes($ResGetCharts['area_name']);?></td>
            
                <td align="left" class="tr1"><a href="add-edit-list.php?area_id=<?php echo $ResGetCharts['area_id'];?>&page=<?php echo $page;?>"><img src="images/edit.gif" title="Edit" alt="Edit" align="absmiddle"/></a><a href="javascript:deletearealist('<?php echo $ResGetCharts['area_id'];?>','<?php echo $page;?>');"><img src="images/delete.gif" title="Delete" alt="Delete" align="absmiddle"/></a>
					</td></tr>
				<?php
			  $i++;
		}
		
	}
	else
	{ ?>
		<tr>
                <td align="center" class="tr1" colspan="4">No Categories Found</td>
       </tr>
	 <?php  }
			 
			 ?>
              
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
       <?php include('includes/footer.php'); ?>