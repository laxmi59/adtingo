// JavaScript Document

function validateloginform()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	
	if(trim(document.getElementById('member_username').value)=='')
	{
		sErrStr +=" Username \n";
		if(sFieldName == "")
		sFieldName="member_username";
	}
	if(trim(document.getElementById('member_pwd').value)=='')
	{
		sErrStr +=" Password \n";
		if(sFieldName == "")
		sFieldName="member_pwd";
	}
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
}

function AddSubFilter(elementID)
 {
	 if(navigator.appName == "Netscape")
{
 document.getElementById(elementID).style.display = 'table-row';
}
 if(navigator.appName == "Microsoft Internet Explorer")
{
 document.getElementById(elementID).style.display = 'inline';
}
 }
 function validatechangepwd()
{
	
	var sErrStr = ""; 
   	var sFieldName = "";
	
	if(trim(document.getElementById('oldpassword').value)=='')
	{
		sErrStr +=" Old password \n";
		if(sFieldName == "")
		sFieldName="oldpassword";
	}
	if(trim(document.getElementById('newpwd').value)=='')
	{
		sErrStr +=" New password \n";
		if(sFieldName == "")
		sFieldName="newpwd";
	}
	if(trim(document.getElementById('connewpwd').value)=='')
	{
		sErrStr +=" Confirm  password \n";
		if(sFieldName == "")
		sFieldName="connewpwd";
	}
	if(trim(document.getElementById('newpwd').value)!='' && (document.getElementById('connewpwd').value)!='')
	{
		if(trim(document.getElementById('newpwd').value)!=document.getElementById('connewpwd').value)
		{
		sErrStr +=" New password and confirm password should be same\n";
		if(sFieldName == "")
		sFieldName="newpwd";
		}
	}
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
	document.changePasswordForm.action="change-password.php";
	document.changePasswordForm.submit();
}

function DelSubFilter(elementID)
 {
	 //alert(document.getElementById(elementID).style.display);
	 document.getElementById(elementID).style.display = 'none';
 }
 
 //********* Start Code For Trim Function **********//
function ltrim(s)
{
   return s.replace(/^\s*/,"");
}
function rtrim(s)
{
 return s.replace(/\s*$/,""); 
}
function trim(s)
{
  return rtrim(ltrim(s)); 
}
//********* End Code For Trim Function **********//

//********* START CODE FOR VALIDATING ADMIN LOGIN FORM **********//
function validateadminfrm()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	
	if(trim(document.getElementById('username').value)=='')
	{
		sErrStr +=" Username \n";
		if(sFieldName == "")
		sFieldName="username";
	}
	if(trim(document.getElementById('password').value)=='')
	{
		sErrStr +=" Password \n";
		if(sFieldName == "")
		sFieldName="password";
	}
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
}
//********* END CODE FOR VALIDATING ADMIN LOGIN FORM ***********//


//************ START CODE FOR VALIDATION CHANGE PASSWORD FORM *********//

//************ END CODE FOR VALIDATION CHANGE PASSWORD FORM *********//

//*********** START CODE FOR CANCLE BUTTON ************//
function canclepwdfrm()
{
	window.location.href="memberss.php";
}
//*********** END CODE FOR CANCLE BUTTON ************//


//******* START CODE FOR VALIDATING CATEGORYNAME *********//
function validatecategoryname()
{
	if(trim(document.getElementById('categoryname').value)=="")
	{
		alert("Please enter Category Name");
		document.getElementById('categoryname').focus()
		return false;
	}
	
}
//******* END CODE FOR VALIDATING CATEGORYNAME *********//

//******* START CODE FOR VIEWING PAGE PER LIMIT *******//

function updatebillingdetails()
{
	
	document.updateaccount.target="";
	document.updateaccount.action="";
	document.updateaccount.submit();


}
	function updateaccountdetails()
{
	
	var sErrStr = ""; 
   	var sFieldName = "";
	//var emailexp=/^[a-zA-Z]{1}[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,3}$/;
	var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	var imgexp=/.jpg|\.JPG|\.jpeg|\.gif|\.png$/;//regular expression which accets specified image extensions only
	var urlRegxp = /^(http:\/\/www.|https:\/\/www.|ftp:\/ \/www.|www.){1}([\w]+)(.[\w]+){1,2}$/; //regular expression which accets specified url extensions only
	
	if(trim(document.getElementById('full_name').value)=='')
	{
		sErrStr +=" Full Name \n";
		if(sFieldName == "")
		sFieldName="full_name";
	}
	
	if(trim(document.getElementById('email').value)=='')
	{
		sErrStr +=" Email Address\n";
		if(sFieldName == "")
		sFieldName="email";
	}
	
	if(trim(document.getElementById('email').value)!='')
	{
		if(emailexp.test(document.getElementById('email').value)==0)
		{
			sErrStr +=" Invalid Email Address \n";
			if(sFieldName == "")
			sFieldName="email";
		}
	}
	
	/*if(trim(document.getElementById('username').value)=='')
	{
		sErrStr +=" Username \n";
		if(sFieldName == "")
		sFieldName="username";
	}*/
	/*if(document.updateaccount.usererr.value==1)
	{
			sErrStr +=" Username is already exists.  Please enter another Username \n";
			if(sFieldName == "")
			sFieldName="username";
	}*/
	if(document.updateaccount.emailerr.value==1)
	{
			sErrStr +=" Email Address is already exists.  Please enter another Email Address \n";
			if(sFieldName == "")
			sFieldName="email";
	}
	/*if(trim(document.getElementById('password').value)=='')
	{
		sErrStr +=" Password \n";
		if(sFieldName == "")
		sFieldName="password";
	}*/
	
	if(trim(document.getElementById('companyname').value)=='')
	{
		sErrStr +=" Company Name \n";
		if(sFieldName == "")
		sFieldName="companyname";
	}
	if(trim(document.getElementById('timezone').value)=='')
	{
		sErrStr +=" Time Zone \n";
		if(sFieldName == "")
		sFieldName="timezone";
	}
	if(trim(document.getElementById('metropolitian_list').value)=='')
	{
		sErrStr +=" Metropolitan Area\n";
		if(sFieldName == "")
		sFieldName="metropolitian_list";
	}
	
	
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
	document.updateaccount.target="";
	document.updateaccount.action="";
	document.updateaccount.submit();

}





function limtval(val,pagename)
{
		//alert(querystrg);
		
	window.location.href=pagename+".php?limit="+val;
	
}
//******* END CODE FOR VIEWING PAGE PER LIMIT *******//

//******* START CODE FOR VIEWING PAGE PER LIMIT *******//

function limtvaltracks(val,pagename,uid)
{
	window.location.href=pagename+".php?uid="+uid+"&limit="+val;
}
//******* END CODE FOR VIEWING PAGE PER LIMIT *******//

//******* START CODE FOR VIEWING PAGE PER LIMIT *******//

function limtval_fea(val,pagename)
{
	window.location.href=pagename+".php?limit_cust="+val;
}
//******* END CODE FOR VIEWING PAGE PER LIMIT *******//

//******* START CODE FOR VIEWING PAGE PER LIMIT *******//

function limtval_cust(val,pagename)
{
	window.location.href=pagename+".php?limit_cust="+val;
}
//******* END CODE FOR VIEWING PAGE PER LIMIT *******//
//******* START CODE FOR VIEWING PAGE PER LIMIT *******//

function deleteCatName(catid,page)
{
		var agree = confirm('Are you sure you want to delete this Category?')
	if(agree)
	  window.location.href="categories.php?delid="+catid+"&page="+page;

	
}
//Function for deleting subsciption record start here

//******* START CODE FOR DELETING CHART *******//

function deleteAdmin(admin,page)
{
		var agree = confirm('Are you sure you want to delete this Admin?')
	if(agree)
	  window.location.href="manageadmin.php?delid="+admin+"&page="+page;

	
}
//******* END CODE FOR DELETING CHART *******//
function deletecat(catid,page)
{
		var agree = confirm('Are you sure you want to delete this Category?')
	if(agree)
	  window.location.href="managecat.php?delid="+catid+"&page="+page;

	
}
//******* START CODE FOR DELETING CHART TRACKS *******//
function deletearealist(area,page)
{
		var agree = confirm('Are you sure you want to delete this Metropolitian area?')
	if(agree)
	  window.location.href="managearealist.php?delid="+area+"&page="+page;

	
}
function deleteChartTracks(chartid,trackid,page)
{
		var agree = confirm('Are you sure you want to delete this Track?')
	if(agree)
	  window.location.href="add-edit-chart.php?chartid="+chartid+"&delid="+trackid+"&page="+page;

	
}


//******* END CODE FOR DELETING CHART TRACKS *******//

//******* START CODE FOR deleting Customer *******//

function deletecustomer(userid,page)
{
		var agree = confirm('Are you sure you want to delete this Customer?')
	if(agree)
	  window.location.href="customer.php?delid="+userid+"&page="+page;

	
}
//Function for deleting Customer 

//******* START CODE FOR deleting Poll *******//

function deletePoll(pollid,page)
{
		var agree = confirm('Are you sure you want to delete this Poll?')
	if(agree)
	  window.location.href="polls.php?delid="+pollid+"&page="+page;

	
}
//End CODE FOR deleting Poll

//******* START CODE FOR deleting Gift Code *******//

function deleteGift(giftid,page)
{
		var agree = confirm('Are you sure you want to delete this Gift Certificate ?')
	if(agree)
	  window.location.href="gift-certificate.php?delid="+giftid+"&page="+page;

	
}
//End CODE FOR deleting Gift Code 

//******* START CODE FOR deleting member *******//

function deleteartist(userid,page)
{
	var agree = confirm('Are you sure you want to delete this Member?');
	if(agree)
	  window.location.href="members.php?delid="+userid+"&page="+page;

	
}
function deleteCampaign_list(cid,page)
{
	var agree = confirm('Are you sure you want to delete this Campaign?');
	if(agree)
	  window.location.href="manage_Campaigns_list.php?delid="+cid+"&page="+page;

	
}
function deletearticle(userid,page)
{
	var agree = confirm('Are you sure you want to delete this Article?');
	if(agree)
	  window.location.href="category_article.php?delid="+userid+"&page="+page;

	
}

function deleteCampaign(cid,page)
{
	var agree = confirm('Are you sure you want to delete this Campaign?');
	if(agree)
	  window.location.href="manage_campaign.php?delid="+cid+"&page="+page;

	
}
//Function for deleting member 
//******* START CODE FOR deleting Client *******//

function deleteClient(userid,page)
{
	var agree = confirm('Are you sure you want to delete this Client?');
	if(agree)
	  window.location.href="clientsdetails.php?delid="+userid+"&page="+page;

}
//Function for deleting Client 

function deleteSubCriptionName(sub_id,page)
{
		var agree = confirm('Are you sure you want to delete this Subscription?')
	if(agree)
	  window.location.href="subsciptions.php?delid="+sub_id+"&page="+page;
}
//Function for deleting subsciption record end here


//Function for deleting Product 

function deleteProduct(sub_id,page)
{
		var agree = confirm('Are you sure you want to delete this Product?')
	if(agree)
	  window.location.href="merchandise.php?delid="+sub_id+"&page="+page;
}
//Function for deleting Product record end here

//Function for deleting subsciption record start here
function deletePostedComment(comm_id)
{
		var agree = confirm('Are you sure you want to delete this Comment?')
	if(agree)
	  window.location.href="manage-comments.php?delid="+comm_id;
}
//Function for deleting subsciption record end here


//******* END CODE FOR VIEWING PAGE PER LIMIT *******//

//******* START CODE FOR VIEWING PAGE NUM ENTERED IN TEXT BOX *******//

function pagelist(val,pagename,limit)
{
	window.location.href=pagename+"&page="+val+"&limit="+limit;
}
//******* END CODE FOR VIEWING PAGE NUM ENTERED IN TEXT BOX *******//

//******* START CODE FOR VALIDATING ADD PRIMARY GENERE FROM PAGE  *******//

function validatePrimaryGenere()
{
	var msg="";
	var field="";
	if(trim(document.getElementById('CategoryName').value)=="")
	{
		msg +="Select Category \n";
		field="CategoryName";
	}
	if(trim(document.getElementById('PrimaryGenre').value)=="")
	{
		msg +="Primary Genre\n";
		field="PrimaryGenre";
	}
	if (msg != "")
	{
		alert("Please enter the following fields \n\n"+msg);
		document.getElementById(field).focus();
		return false;
	}
	
}
//******* END CODE FOR VALIDATING ADD PRIMARY GENERE FROM PAGE  *******//

//******* START CODE FOR DELETING PRIMARY GENERE ***********//
function deletePrimName(pid,page)
{
	var agree = confirm('Are you sure you want to delete this Primary Genre?')
	if(agree)
	  window.location.href="primarygenres.php?delid="+pid+"&page="+page;
}

//******* END CODE FOR DELETING PRIMARY GENERE ***********//

//******* START CODE FOR UPDATING PRIMARY GENERE ORDER***********//
function deletePrimName(pid,page)
{
	var agree = confirm('Are you sure you want to delete this Primary Genre?')
	if(agree)
	  window.location.href="primarygenres.php?delid="+pid+"&page="+page;
}

//******* START CODE FOR UPDATING PRIMARY GENERE ORDER***********//
function updateprimGenereOrder()
{
	var sort_order=document.getElementById('sort_order').value;
	
	xmlHttp=getXmlHttpObject();
	if(xmlHttp==null)
	{
		alert("This Bowser Doesn't Support AJAX!");
		return;
	}
	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET","includes/ajax.php?mode=primgensort_order&sort_order="+sort_order,"true"); 
	xmlHttp.send(null);
}
function stateChanged()
{// alert(val)

	if (xmlHttp.readyState==4)
	{ 
		res=xmlHttp.responseText; 
		//var page_id=<?php echo $_REQUEST['page_id'];?>;
		//alert(document.getElementById('imgreplace_'+page_id).innerHTML);
		//document.getElementById('imgreplace').innerHTML=res;
	
	}
}
function getXmlHttpObject()
{
	try {
		xmlHttp=new XMLHttpRequest();
	 
	}
	catch(e) {
		try{
		 xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			xmlHttp=new ActiveXobject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

//******* END CODE FOR UPDATING PRIMARY GENERE ORDER***********//

//******* START CODE FOR VALIDATING ADD SECONDARY GENERE FROM PAGE  *******//

function validateSecondaryGenerefrm()
{
	if(trim(document.getElementById('SecondaryGenere').value)=="")
	{
		alert("Please enter Secondary Genre");
		document.getElementById('SecondaryGenere').focus()
		return false;
	}
}
//******* END CODE FOR VALIDATING ADD SECONDARY GENERE FROM PAGE  *******//


//******* START CODE FOR DELETING SECONDARY GENERE ***********//
function deleteSecName(sid,page)
{
	var agree = confirm('Are you sure you want to delete this Secondary Genre?')
	if(agree)
	  window.location.href="secondarygenres.php?delid="+sid+"&page="+page;
}

//******* END CODE FOR DELETING SECONDARY GENERE ***********//


//******* START CODE FOR UPDATING SECONDARY GENERE ORDER***********//
function updatesecGenereOrder()
{
	var sort_order=document.getElementById('sort_order').value;
	
	xmlHttp=getXmlHttpObject();
	if(xmlHttp==null)
	{
		alert("This Bowser Doesn't Support AJAX!");
		return;
	}
	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET","includes/ajax.php?mode=secgensort_order&sort_order="+sort_order,"true"); 
	xmlHttp.send(null);
}
function stateChanged()
{// alert(val)

	if (xmlHttp.readyState==4)
	{ 
		res=xmlHttp.responseText; 
		//alert(res);
		//var page_id=<?php echo $_REQUEST['page_id'];?>;
		//alert(document.getElementById('imgreplace_'+page_id).innerHTML);
		//document.getElementById('imgreplace').innerHTML=res;
	
	}
}
function getXmlHttpObject()
{
	try {
		xmlHttp=new XMLHttpRequest();
	 
	}
	catch(e) {
		try{
		 xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			xmlHttp=new ActiveXobject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

function getXmlHttpObject()
{
	try {
		xmlHttp=new XMLHttpRequest();
	 
	}
	catch(e) {
		try{
		 xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			xmlHttp=new ActiveXobject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

//********** END CODE FOR DELETE ADV BANNER IMAGE IN EDIT PAGE ***********//




function chk_numanddotonly(val)
{
	
	//var val=document.getElementById('sub_price').value;
	
	for(i=0; i<val.length; i++) 
		 {    
			ascii=val.charCodeAt(i);
			
				if(!(ascii>=48&&ascii<=57||ascii==46||ascii==36))
				{
					
					return true;
				}
		 }
	
}
function chk_numonly(val)
{
	
	//var val=document.getElementById(field).value;
	
	for(i=0; i<val.length; i++) 
		 {    
		
			ascii=val.charCodeAt(i);
				if(!(ascii>=48&&ascii<=57))
				{
					return true;
				}
		 }
}




function url_validate() 
{
       	if(((document.sociallinks.twitter.value.indexOf("http://",0) == -1) && (document.sociallinks.twitter.value.indexOf("www.",0) == -1)) || (document.sociallinks.twitter.value=="http://") || (document.sociallinks.twitter.value.indexOf(' ')==7))
         {
               return true;
   	 }
}

//********* END CODE FOR VALIDATING  SOCIAL LINKS *************//

//********* START CODE FOR VALIDATING  CHECKBOXES IN MESSAGES *************//



				
function createRequest()
{
	var xmlHttp=null;
	try
	{
	// Firefox, Opera 8.0+, Safari
	xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
	// Internet Explorer
	try
	{
	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e)
	{
	try
	{
	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	catch (e)
	{
	alert("Please update your browser version, It seems your using older version.");
	return false;
	}
	}
	}

	
	return xmlHttp;
}

function chk_numanddot(field)
{
	
	var val=document.getElementById('amount').value;
	
	for(i=0; i<val.length; i++) 
		 {    
			ascii=val.charCodeAt(i);
			
				if(!(ascii>=48&&ascii<=57||ascii==46||ascii==36))
				{
					
					return true;
				}
		 }
	
}



function submitenter(myfield,e)
 {
	 
        var keycode;
        
        if (window.event)
        {
			
                keycode = window.event.keyCode;
        }
        else if(e)
        {
		
                 keycode = e.which;
        }
        else 
        {
			
                return true;
        }
        if (keycode == 13)
           {
                validateloginfrm();
           return false;
           }
        
        else
           return true;
}

//********** END CODE FOR VALIDATING ADD PRODUCT FORM **********//

//********* START CODE FOR VALIDATIONG ADD/REMOVE TRACKS FOR CHARTS ***********//




  function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//********* END CODE FOR VALIDATIONG ADD/REMOVE TRACKS FOR CHARTS ***********//

//******* START CODE FOR VALIDATING CHARGE BACK FORM *********//
function validatechargebckfrm()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	
	
	
	//alert(document.getElementById('BannerSize').value);
	//alert(document.getElementById('bannertype').value);
	if(trim(document.getElementById('Dateback').value)=='')
	{
		sErrStr +=" Date \n";
		if(sFieldName == "")
		sFieldName="Dateback";
	}
	if(trim(document.getElementById('Dateback').value)!='')
	{
		var seldate=document.getElementById('Dateback').value;			
		var mydate_array=seldate.split("/");	
		var myDate=new Date();
		myDate.setFullYear(mydate_array[2],mydate_array[0],mydate_array[1]);
		var today = new Date();
		if (myDate<today)
		{
			sErrStr +=" Invalid Date \n";
			if(sFieldName == "")
			sFieldName="Dateback";
		}
	
	} 
	if(trim(document.getElementById('Amount').value)=='')
	{
		sErrStr +=" Amount \n";
		if(sFieldName == "")
		sFieldName="Amount";
	}
	if(trim(document.getElementById('Amount').value)!='')
	{

		if(validateNum(trim(document.getElementById("Amount").value))==false)
		{
			sErrStr +=" Invalid Amount \n";
			if(sFieldName == "")
			sFieldName="Amount";
		}

	}
	if(document.getElementById('Transaction').value=='')
	{
		if(trim(document.getElementById('Transaction').value)=='')
		{
			sErrStr +=" Transaction ID \n";
			if(sFieldName == "")
			sFieldName="Transaction";
		}
	}
	
	if(trim(document.getElementById('Notes').value)=='')
	{
		sErrStr +=" Notes \n";
		if(sFieldName == "")
		sFieldName="Notes";
	}

	
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}

}


//***** START CODE FOR SUBMITING THE FORM VALUES INTO POPUP WINDOW *********//
function thePopupWindows(windowsname)
{
	if(trim(document.getElementById('searchword').value)=='')
	{
		alert("Please enter search text");
		document.getElementById('searchword').focus();
		return false;
	}
									
	var win = window.open('', windowsname, 'width=400,height=200,resizable=yes,scrollbars=yes,status=yes');
	return true;
}
//***** END CODE FOR SUBMITING TH EFORM VALUES INTO NPOPUP WINDOW *********//

//*********** Start COde For Checkbox Check All Functinality ********//



//*********** End COde For Checkbox Check All Functinality ********//

//******** Start COde for is Checkbox Checked or Not ********//
function validateischkd()
{
	
	var totalusers=false;

	if(document.getElementById('noofrecords').value=='1')
	{
		if(document.formlist.selcontacts.checked==true)
		totalusers =true;
	}
	else
	{
		for(var i=0; i <document.formlist.selcontacts.length; i++)
		{
			if(document.formlist.selcontacts[i].checked==true)
			{
				totalusers =true;
			}
		}
	}

	if(!(totalusers))
	{
		alert("Please select atleast one Track") 
		return false;
	}
	

	//var agree = confirm('Are you sure you want to delete this client?')
	//if(agree)
	  window.location = "";
	//else
		//return false;
	

}
//******** End COde for is Checkbox Checked or Not ********//

//*** START CODE VALIDATING CHART FORM *************//
function validateadmin()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	
	var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	if(trim(document.getElementById('username').value)=='')
	{
		sErrStr +=" Username \n";
		if(sFieldName == "")
		sFieldName="username";
	}
	if(trim(document.getElementById('password').value)=='')
	{
		sErrStr +=" Password \n";
		if(sFieldName == "")
		sFieldName="password";
	}		

	if(trim(document.getElementById('confirmpassword').value)=='')
	{
		sErrStr +=" Confirm password \n";
		if(sFieldName == "")
		sFieldName="confirmpassword";
	}		
	
	if((trim(document.getElementById('password').value)!='')&&(trim(document.getElementById('confirmpassword').value)!=''))
	{
		if(trim(document.getElementById('password').value)!=trim(document.getElementById('confirmpassword').value))
		{
			sErrStr +=" Password and Confirm Password do not match \n";
			if(sFieldName == "")
			sFieldName="confirmpassword";
		}		
	}
	if(trim(document.getElementById('email').value)=='')
	{
		sErrStr +=" Email \n";
		if(sFieldName == "")
		sFieldName="email";
	}		

	if((trim(document.getElementById('email').value)!='')&&(emailexp.test(document.getElementById('email').value)==0))
	{
		sErrStr +="Invalid Email \n";
		if(sFieldName == "")
		sFieldName="email";
	}		



	if (sErrStr != "")
	{
		alert("Please enter  the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
}
//*** END CODE VALIDATING CHART FORM *************//

function validateImport()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	
	var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	if(trim(document.getElementById('csvfile').value)=='')
	{
		sErrStr +=" upload file \n";
		if(sFieldName == "")
		sFieldName="csvfile";
	}
var csvexp=/.csv|\.csv$/;
	if((trim(document.getElementById('csvfile').value)!='')&&(csvexp.test(document.getElementById('csvfile').value)==0))
	{
		sErrStr +="Invalid File \n";
		if(sFieldName == "")
		sFieldName="csvfile";
	}		



	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
}

//***************START CODE FOR SLIDE SHOT BANNERS**********//
/*function slideit(val,val1)
{ 
    alert(val);
	for (i=0;i<val1;i++)
	{
	var "image"+val1+"=new Image()
	"image"+val1+".src=val;
	
	var step=1;
	
	//if browser does not support the image object, exit.
	if (!document.images)
	return document.images.slide.src=eval("image"+step+".src")
	if (step<val1)
	step++
	else
	step=1
	//call function "slideit()" every 2.5 seconds
	setTimeout("slideit()",1000)
	}
}

slideit()
*/
//***************END CODE FOR SLIDE SHOT BANNERS**********//


//validation for adding comments in order of admin section start here
function checkcommentbox()
{
	if(document.addcomment.add_admin_comments.value=="")
	{
		alert("Please enter comments");
		document.addcomment.add_admin_comments.focus();
		return false;
	}
	return true;
}
function validateprofilefrm_admin()
{
	
	var sErrStr = ""; 
   	var sFieldName = "";
	//var emailexp=/^[a-zA-Z]{1}[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,3}$/;
	var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	var imgexp=/.jpg|\.JPG|\.jpeg|\.gif|\.png$/;//regular expression which accets specified image extensions only
	var urlRegxp = /^(http:\/\/www.|https:\/\/www.|ftp:\/ \/www.|www.){1}([\w]+)(.[\w]+){1,2}$/; //regular expression which accets specified url extensions only
	
	if(trim(document.getElementById('full_name').value)=='')
	{
		sErrStr +=" Full Name \n";
		if(sFieldName == "")
		sFieldName="full_name";
	}
	
	if(trim(document.getElementById('email').value)=='')
	{
		sErrStr +=" Email Address\n";
		if(sFieldName == "")
		sFieldName="email";
	}
	
	if(trim(document.getElementById('email').value)!='')
	{
		if(emailexp.test(document.getElementById('email').value)==0)
		{
			sErrStr +=" Invalid Email Address \n";
			if(sFieldName == "")
			sFieldName="email";
		}
	}
	
	if(trim(document.getElementById('username').value)=='')
	{
		sErrStr +=" Username \n";
		if(sFieldName == "")
		sFieldName="username";
	}
	if(document.signupform.usererr.value==1)
	{
			sErrStr +=" Username is already exists.  Please enter another Username \n";
			if(sFieldName == "")
			sFieldName="username";
	}
	if(document.signupform.emailerr.value==1)
	{
			sErrStr +=" Email Address is already exists.  Please enter another Email Address \n";
			if(sFieldName == "")
			sFieldName="email";
	}
	if(trim(document.getElementById('password').value)=='')
	{
		sErrStr +=" Password \n";
		if(sFieldName == "")
		sFieldName="password";
	}
	
	if(trim(document.getElementById('companyname').value)=='')
	{
		sErrStr +=" Company Name \n";
		if(sFieldName == "")
		sFieldName="companyname";
	}
	if(trim(document.getElementById('timezone').value)=='')
	{
		sErrStr +=" Time Zone \n";
		if(sFieldName == "")
		sFieldName="timezone";
	}
	if(trim(document.getElementById('metropolitian_list').value)=='')
	{
		sErrStr +=" Metropolitan Area\n";
		if(sFieldName == "")
		sFieldName="metropolitian_list";
	}
	
	
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
	document.signupform.target="";
	document.signupform.action="";
	document.signupform.submit();
}
//validation for adding comments in order of admin section end here








function validateprofilefrm()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	//var emailexp=/^[a-zA-Z]{1}[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,3}$/;
	var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	var imgexp=/.jpg|\.JPG|\.jpeg|\.gif|\.png$/;//regular expression which accets specified image extensions only
	var urlRegxp = /^(http:\/\/www.|https:\/\/www.|ftp:\/ \/www.|www.){1}([\w]+)(.[\w]+){1,2}$/; //regular expression which accets specified url extensions only
	
	if(trim(document.getElementById('full_name').value)=='')
	{
		sErrStr +=" Full Name \n";
		if(sFieldName == "")
		sFieldName="full_name";
	}
	
	if(trim(document.getElementById('email').value)=='')
	{
		sErrStr +=" Email \n";
		if(sFieldName == "")
		sFieldName="email";
	}
	
	if(trim(document.getElementById('email').value)!='')
	{
		if(emailexp.test(document.getElementById('email').value)==0)
		{
			sErrStr +=" Invalid Email Address \n";
			if(sFieldName == "")
			sFieldName="email";
		}
	}
	if(document.signupform.errormess.value=='1')
	{
		sErrStr +=" Email Aadress is already exists. Please enter another email \n";
		if(sFieldName == "")
		sFieldName="email";
	}
	if(trim(document.getElementById('username').value)=='')
	{
		sErrStr +=" Username \n";
		if(sFieldName == "")
		sFieldName="username";
	}
	if(trim(document.getElementById('password').value)=='')
	{
		sErrStr +=" Password \n";
		if(sFieldName == "")
		sFieldName="password";
	}
	if(trim(document.getElementById('companyname').value)=='')
	{
		sErrStr +=" Company Name \n";
		if(sFieldName == "")
		sFieldName="companyname";
	}
	if(trim(document.getElementById('timezone').value)=='')
	{
		sErrStr +=" Time Zone \n";
		if(sFieldName == "")
		sFieldName="timezone";
	}
	if(trim(document.getElementById('metropolitian_list').value)=='')
	{
		sErrStr +=" Metropolitian Area \n";
		if(sFieldName == "")
		sFieldName="metropolitian_list";
	}
	
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
	document.signupform.target="";
	document.signupform.action="";
	document.signupform.submit();
}
function storeId(val,id,field)
{
	if(document.getElementById(id).checked==true)
	document.getElementById(field).value=val+':'+document.getElementById(field).value;
	//alert(document.getElementById(field).value);
}

function emailcheck(cid)
{
	 var h=document.profilrfrm.email.value;
	 var req=createRequest();
	 req.open("GET","emailverify.php?reg_email="+h+"&cid="+cid,true);
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;
				//alert(res);
			   if(trim(res)!="")
				{
					//document.getElementById("errmail").innerHTML=res;
					document.profilrfrm.errormess.value=1;
				}
				else
				{
					
					//document.getElementById("errmail").innerHTML="";
					document.profilrfrm.errormess.value=0;
				}
			
			return false;
		  } 
	 } 
}


//Member form validation start here
function validatemember()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	//var emailexp=/^[a-zA-Z]{1}[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,3}$/;
	var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	var imgexp=/.jpg|\.JPG|\.jpeg|\.gif|\.png$/;//regular expression which accets specified image extensions only
	var urlRegxp = /^(http:\/\/www.|https:\/\/www.|ftp:\/ \/www.|www.){1}([\w]+)(.[\w]+){1,2}$/; //regular expression which accets specified url extensions only
	
	if(trim(document.getElementById('full_name').value)=='')
	{
		sErrStr +=" First Name \n";
		if(sFieldName == "")
		sFieldName="full_name";
	}
	if(trim(document.getElementById('lastname').value)=='')
	{
		sErrStr +=" Last Name \n";
		if(sFieldName == "")
		sFieldName="lastname";
	}
	if(trim(document.getElementById('email').value)=='')
	{
		sErrStr +=" Email \n";
		if(sFieldName == "")
		sFieldName="email";
	}
	
	if(trim(document.getElementById('email').value)!='')
	{
		if(emailexp.test(document.getElementById('email').value)==0)
		{
			sErrStr +=" Invalid Email Address \n";
			if(sFieldName == "")
			sFieldName="email";
		}
	}
	if(document.getElementById('emailerr').value==1)
	{
			sErrStr +="Email Address already exists.  Please enter another Email Address \n";
			if(sFieldName == "")
			sFieldName="email";
	}
	if(trim(document.getElementById('username').value)=='')
	{
		sErrStr +=" Username \n";
		if(sFieldName == "")
		sFieldName="username";
	}
	if(document.getElementById('usererr').value==1)
	{
			sErrStr +="Username already exists.  Please enter another Username\n";
			if(sFieldName == "")
			sFieldName="username";
	}
	if(trim(document.getElementById('password').value)=='')
	{
		sErrStr +=" Password \n";
		if(sFieldName == "")
		sFieldName="password";
	}
	if(trim(document.getElementById('city').value)=='')
	{
		sErrStr +=" Home City \n";
		if(sFieldName == "")
		sFieldName="city";
	}
	if(document.getElementById('month').value=='' || document.getElementById('year').value=='')
	{
		sErrStr +=" Date of Birth \n";
		if(sFieldName == "")
		sFieldName="month";
	}
 	var total=0;
		for(var i=0; i <document.profilrfrm.gender.length; i++)
		{
			if(document.profilrfrm.gender[i].checked==true)
			{
				total =1;
			}
			
		}
if(total==0)
{
		sErrStr +=" Gender \n";
		if(sFieldName == "")
		sFieldName="gender";
}
if(document.getElementById("zipcode").value=='')
	{
		sErrStr +=" Zip Code \n";
		if(sFieldName == "")
		sFieldName="zipcode";
	}
	if(trim(document.getElementById('zipcode').value)!='')
	{
		if(/[^A-Za-z\d ]/.test(document.getElementById('zipcode').value))
		{
			sErrStr +=" Invalid Zipcode. Enter only letter and numeric characters \n";
			if(sFieldName == "")
			sFieldName="zipcode";
		}
	}
	if(trim(document.getElementById('education').value)=='')
	{
		sErrStr +=" Education \n";
		if(sFieldName == "")
		sFieldName="education";
	}
	if(trim(document.getElementById('income').value)=='')
	{
		sErrStr +=" Income \n";
		if(sFieldName == "")
		sFieldName="income";
	}
	if(trim(document.getElementById('activities').value)=='')
	{
		sErrStr +=" Intrest And Activities \n";
		if(sFieldName == "")
		sFieldName="activities";
	}
	var count=0;
	for(i=0;i<document.profilrfrm.metropolitian_area.length;i++)
	{
		if(document.profilrfrm.metropolitian_area[i].checked==true)
		{
			count=count+1;
			document.getElementById('metroIds').value=document.profilrfrm.metropolitian_area[i].value+':'+document.getElementById('metroIds').value;
		}
	}
	//alert(document.getElementById('metroIds').value);
	if(count==0)
	{
		sErrStr +=" Metropolitian Area \n";
		if(sFieldName == "")
		sFieldName="metropolitian_area1";
	}
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
	document.profilrfrm.target="";
	document.profilrfrm.action="";
	document.profilrfrm.submit();
}
//Member form validation end here



function validatecategories()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	
	
	if(trim(document.getElementById('metropolitin_area').value)=='')
	{
		sErrStr +=" Metropolitan  Area \n";
		if(sFieldName == "")
		sFieldName="metropolitin_area";
	}
	if(trim(document.getElementById('catname').value)=='')
	{
		sErrStr +=" Category Name \n";
		if(sFieldName == "")
		sFieldName="catname";
	}		

	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
}


function validateMetroArealist()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	
	
	if(trim(document.getElementById('areaname').value)=='')
	{
		sErrStr +=" Metropolitan  Area \n";
		if(sFieldName == "")
		sFieldName="areaname";
	}
	
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
}
function member_emailcheck(h,id)
{

	 var req=createRequest();//alert(req);
	
	req.open("GET","member_emailverify.php?member_reg_email="+h,true);
	req.send(null);
	req.onreadystatechange=function()
	{
		//alert("hi");
		 //	alert(req.readyState);alert(req.status);
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;//alert(res);
			   if(trim(res)!="")
				{
					document.getElementById(id).value=1;
				}
				else
				{
					document.getElementById(id).value=0;
				}
				//return false;
		  } 
	 } 
}


function usernamechk()
{
	 var h=document.signupform.username.value;
	 var req=createRequest();
	 req.open("GET","emailverify.php?reg_username="+h,true);
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;
			   
			   if(res!="")
				{
					document.signupform.usererr.value=1;
				}
				else
				{
					document.signupform.usererr.value=0;
				}
				return false;
		  } 
	 } 
}

