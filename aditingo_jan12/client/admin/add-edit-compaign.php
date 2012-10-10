<?php 
$nav=8;
include("includes/adminsessions.php");
include('includes/header.php'); 


if(isset($_POST['pollquestion']) && $_POST['pollquestion']!='')
{
	//POSTED DATE CONVETED TO DB FORMAT START HERE
	$start_Date=explode("/",$_POST['startdate']);
	 $start_db_date=$start_Date[2]."-".$start_Date[0]."-".$start_Date[1];
	
	$End_Date=explode("/",$_POST['enddate']);
	 $End_db_date=$End_Date[2]."-".$End_Date[0]."-".$End_Date[1];
	//POSTED DATE CONVETED TO DB FORMAT END HERE
	
	if($_POST['poll_id']=='')
	{	
		$insertPollQuestion=sprintf("insert into tbl_poll(Question,StartDate,EndDate,PollAdded) values('%s','%s','%s','%s')",$object->stripper($_POST['pollquestion']),$start_db_date,$End_db_date,date('Y:m:d'));
		$QryinsertPollQuestion=$object->ExecuteQuery($insertPollQuestion);
		$msg="added";
	}
	else
	{
	 $updatePollQuestion=sprintf("Update tbl_poll set Question='%s', StartDate='%s', EndDate='%s' where PollID=%d",$object->stripper($_POST['pollquestion']),$object->stripper($start_db_date),$object->stripper($End_db_date),$object->stripper($_POST['poll_id']));
		$insertPollQuestion=$object->ExecuteQuery($updatePollQuestion);
		$msg="update"; 
	}
	if($insertPollQuestion)
	{
		if($_POST['page']=='') 
			$page=1;
		else
			$page=$_POST['page'];
		header("location:polls.php?msg=$msg&page=".$page);
		exit;
	}
}
	
	
	$SqlGetPollInfo=sprintf("select * from tbl_poll where PollID=%d ",$object->stripper($_REQUEST['poll_id']));
	$QryGetPollInfo=$object->ExecuteQuery($SqlGetPollInfo);
	$ResGetPollInfo=$object->FetchArray($QryGetPollInfo);
		
	//DB DATE CONVETED TO DISPLAY FORMAT START HERE
    $poll_startdt=$object->getdbdateexp($ResGetPollInfo['StartDate']);
	$poll_enddt=$object->getdbdateexp($ResGetPollInfo['EndDate']);
	//POSTED DATE CONVETED TO DB FORMAT END HERE

//********* SATRT CODE FOR DISPLAY TITLE (edit/add) ********//
if($_REQUEST['poll_id']=='')
	$title='Add';
else
	$title='Edit';

//********* END CODE FOR DISPLAY TITLE (edit/add) ********//
//********* START CODE FOR DISPLAYING NUMBER OF TRACKS ************//
	$num_tracks_str=$object->select_function($num_tracks_array,$ResGetSbucriptionInfo['TracksNum']);
//********* END CODE FOR DISPLAYING NUMBER OF TRACKS************//
?>

<form name="polls" method="POST" action="" onsubmit="return pollvalidate();">
<input name="poll_id" id="poll_id" type="hidden" value="<?php echo $_REQUEST['poll_id'];?>" />
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
                <td width="83%" height="100" align="left" class="tr5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  
                  <tr>
                    <td height="20" align="left" class="content-header"> Create Compaign</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>
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
                                <td height="30" align="left"><strong>Question</strong></td>
                                <td align="left"><textarea name="pollquestion" cols="60" rows="10" class="input2" id="pollquestion"><?php echo $ResGetPollInfo['Question'];?></textarea><br />
<br />
</td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left"><strong>Start Date</strong></td>
                                <td align="left"><input name="startdate" type="text" class="input2" id="startdate" value="<?php if($ResGetPollInfo['StartDate']!='') echo $poll_startdt;?>" />
                   </td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left"><strong>End Date</strong></td>
                                <td align="left"><input name="enddate" id="enddate" type="text" class="input2" value="<?php if($ResGetPollInfo['EndDate']!='') echo $poll_enddt;?>" />
                   </td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left">
                                  <input name="button3" type="submit" class="button" id="button3" value="Submit" />
                                </td>
                              </tr>
                              
                            </table></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                    </tr>
                  </table></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
</form>
      <?php include('includes/footer.php'); ?>