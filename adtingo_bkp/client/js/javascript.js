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

//********* START CODE FOR VALIDATING MEMBER LOGIN FORM **********//
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
//********* END CODE FOR VALIDATING MEMBER LOGIN FORM ***********//

//********* START CODE FOR VALIDATING FORGOT PASSWORD FORM ***********//
function validatepwd()
	{
		var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		if(trim(document.forgotpwd.emailaddress.value)=="")
			{
			  alert("Please enter email address");   
			  document.forgotpwd.emailaddress.focus();
			  return false;
			   
			}
			if(trim(document.getElementById('emailaddress').value)!='')
			{
				if(emailexp.test(document.getElementById('emailaddress').value)==0)
				{
					  alert("Invalid Email address");   
					  document.forgotpwd.emailaddress.focus();
					  document.forgotpwd.emailaddress.select();
					  return false;
				}
			}
				
			return true;

	}
//********* END CODE FOR VALIDATING FORGOT PASSWORD FORM ***********//



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

function client_emailcheck()
{
	 var h=document.updateaccount.email.value;
	 var req=createRequest();
	 req.open("GET","client_emailverify.php?client_reg_email="+h,true);
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;
			   if(res!="")
				{
					document.updateaccount.emailerr.value=1;
				}
				else
				{
					document.updateaccount.emailerr.value=0;
				}
				return false;
		  } 
	 } 
}

function emailcheck()
{
	 var h=document.signupform.email.value;
	 var req=createRequest();
	 req.open("GET","emailverify.php?reg_email="+h,true);
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;
			   if(res!="")
				{
					document.signupform.emailerr.value=1;
				}
				else
				{
					document.signupform.emailerr.value=0;
				}
				return false;
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

function client_user_check()
{
	 var h=document.updateaccount.username.value;
	 var req=createRequest();
	 req.open("GET","client_emailverify.php?client_user_chk="+h,true);
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;
			   if(res!="")
				{
					document.updateaccount.usererr.value=1;
				}
				else
				{
					document.updateaccount.usererr.value=0;
				}
				return false;
		  } 
	 } 
}
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

function validatestep1()
{
if(trim(document.getElementById('metropolitian_list').value)=='')
	{
		alert("Please Select Metropolitan Area");
		return false;
	}
	else
	return true;
}
//******* START CODE FOR VIEWING PAGE PER LIMIT *******//

function limtval(val,pagename)
{
		//alert(querystrg);
		
	window.location.href=pagename+".php?limit="+val;
	
}
//******* END CODE FOR VIEWING PAGE PER LIMIT *******//
function sendallcheck()
{

	if(document.getElementById("sendall").checked==true)
	{
		document.signupForm4.random_number.disabled = true; 
		document.signupForm4.random_number.value="";
	}
	else
	{	
		document.signupForm4.random_number.disabled = false;; 
	}
}
function Campaign_Sending_options()
{
	if(document.getElementById("sendimmediately").checked==true)
	{
		
		document.getElementById("schedule_date").disabled = true;
	}
	else
	{	
		
		document.getElementById("schedule_date").disabled = false;
	}
}
function SubmitPaymentForm()
{
	document.payment_gateway.action="";
	document.payment_gateway.submit();
}

//******* START CODE FOR deleting member *******//

function deleteCampaign(userid,page)
{
	var agree = confirm('Are you sure you want to delete this Campaign?');
	if(agree)
	  window.location.href="overview.php?delid="+userid+"&page="+page;

	
}
//Function for deleting member 
//******* START CODE FOR VIEWING PAGE NUM ENTERED IN TEXT BOX *******//

function pagelist(val,pagename,limit)
{
	window.location.href=pagename+"&page="+val+"&limit="+limit;
}
//******* END CODE FOR VIEWING PAGE NUM ENTERED IN TEXT BOX *******//


function updatebillingdetails()
{
	
	document.updateaccount.target="";
	document.updateaccount.action="";
	document.updateaccount.submit();


}