<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Account Settings | Campaign Monitor</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />

</head>
<body id="admin" class="accountsettings">
<!--header-->
   <?php include('includes/account-header.php'); ?>  
 
<!--body-->
 
<div id="case">
   
   
  <div class="shadowWrap">
    <div class="shadowMidLeft">
      <div class="shadowMidContent">
        <div id="dashboard">
           
          <div id="clientActivity">
            <div id="activityBG">
              <div id="activityContent">
                <div id="clientBlankSlate">
                  <h1>Welcome to Campaign Monitor</h1>
                  <p>You're currently in the Manage Clients section of your account.
                    To get you started, we've added test as the first client you'll be 
                    sending campaigns for. You can add as many clients as you like.</p>
                  <div class="instructions">
                    <table width="100%" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td class="instructionsCTA" nowrap="nowrap"><a href="step1.php"><img src="images/create-first-campaign.gif" alt="Create your first campaign"/></a></td>
                          <td width="100%"><p>Once you start creating and sending 
                              campaigns, this page will list all the activity across your account.</p></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <h1>Latest Activity</h1>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr class="noHighlight">
                      <th class="headerDarkGreyLeft"><span>Recent updates across your 
                        account</span></th>
                      <th class="headerDarkGreyRight"> <span> <a href="#">Subscribe</a> <a href="#"><img src="images/activity-rss.gif" alt="RSS feed" class="supporting" /></a>
                        
                        </span> </th>
                    </tr>
                  </tbody>
                </table>
                <table class="activity" width="100%" cellpadding="0" 
cellspacing="0">
                  <tbody>
                    <tr>
                      <td class="activityAction" width="100%">You haven't done anything 
                        in your account lately, but as soon as you do we'll keep track of it 
                        here.</td>
                    </tr>
                    <tr>
                      <td><br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/></td>
                    </tr>
                  </tbody>
                </table>
                <div class="clearActivity"></div>
              </div>
            </div>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="shadowBottomLeft">
    <div class="shadowMidLeft"></div>
  </div>
</div>
<!--footer-->
  <?php include('includes/footer.php'); ?> 
</body>
</html>
