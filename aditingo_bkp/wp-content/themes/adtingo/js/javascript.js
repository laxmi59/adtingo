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
	//alert("test")
	/*if(trim(document.getElementById('member_username').value)=='')
	{
		sErrStr +=" Username \n";
		if(sFieldName == "")
		sFieldName="member_username";
	}*/
	var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if((document.getElementById('member_email').value)=='')
    {
    	sErrStr += "Email Address \n";
	    if(sFieldName == "")
    	sFieldName="member_email";
    }
    if((document.getElementById('member_email').value)!='')
    {
    	if(emailexp.test(document.getElementById('member_email').value)==0)
        {
        	sErrStr += "Invalid Email Address \n";
		    if(sFieldName == "")
		    sFieldName="member_email";
        }
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

//********* START CODE FOR VALIDATING CLIENT REGISTRATION-STEP2 FORM ***********//

function validateregisstrationform()
{
	var form= document.regisstration;
	var sFieldName;

	showError =  '';
	
	if(form.fname.value =='') 
	{
		showError += "First Name \n";
	
	} 
	if(form.lname.value =='') 
	{
		showError += "Last Name \n";
	
	} 
	
	/*<!--if(form.fullname.value =='') 
	{
		showError += "Full Name \n";
	
	} -->*/
var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

//    if((document.getElementById('email').value)=='')
//        {
//          showError += "Email Address \n";
//    if(sFieldName == "")
//    sFieldName="email";
//        }
//    if((document.getElementById('email').value)!='')
//        {
//    if(emailexp.test(document.getElementById('email').value)==0)
//        {
//          showError += "Invalid Email Address \n";
//    if(sFieldName == "")
//    sFieldName="email";
//        }
//        }
	
	
	if(form.username.value == '') 
	{
	  showError += "User Name \n";
	}
	if(form.usererr.value==1)
	{
		showError +="Username already exists.  Please enter another Username \n";
		
	}
	if(form.pass.value == '') 
	    {
     	  showError += "Password \n";
        }
	if(form.city.value == '') 
	    {
     	  showError += "Home City \n";
        }	
	
	if(form.month.value == '' || form.year.value == '') 
	    {
     	  showError += "Date of Birth \n";
        } 
	 
	if ( ( form.gender[0].checked == false ) && ( form.gender[1].checked == false ) )
        {
          showError += "Gender \n";
     
	    } 
	if(form.zip.value == '') 
	    {
     	 showError += "Zip Code \n";
        } 
	if(form.education.value == '') 
	    {
     	 showError += "Education  \n";
        }
	if(form.income.value == '') 
	    {
     	 showError += "Income  \n";
        }
	else if(isNaN(form.income.value)) 
	    {
         showError += "Invalid Income  \n";
        }
	if(form.interest.value == '') 
	    {
     	showError += "Interests and Activities  \n";
        } 
	 
	/*if(document.getElementById('record1').checked==false &&  document.getElementById('record2').checked==false && document.getElementById('record3').checked==false &&  document.getElementById('record4').checked==false &&  document.getElementById('record5').checked==false &&  document.getElementById('record6').checked==false &&  document.getElementById('record7').checked==false &&  document.getElementById('record8').checked==false &&  document.getElementById('record9').checked==false &&  document.getElementById('record10').checked==false &&  document.getElementById('record11').checked==false &&  document.getElementById('record12').checked==false &&  document.getElementById('record13').checked==false &&  document.getElementById('record14').checked==false &&  document.getElementById('record15').checked==false &&  document.getElementById('record16').checked==false &&  document.getElementById('record17').checked==false &&  document.getElementById('record18').checked==false) 
	    {
     	showError += "Subscriptions List\n";
        } */
    if (showError != "")
	    {
		alert("Please enter the following fields \n\n"+showError);
		//document.getElementById(showError).focus();
		return false;
	
	    } 
    
	if ( showError == '' ) 
	    {
			return true;
	    } 
		else 
		{
		 alert(showError);
		 return false;
	    }
	document.regisstration.action="login.php";
	document.regisstration.submit();
}

//********* END CODE FOR VALIDATING CLIENT REGISTRATION-STEP2 FORM ***********//

function validateformStep1()
{
		var sErrStr = ""; 
  	 	var sFieldName = "";
		var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

	if(trim(document.getElementById('email').value)=='')
	{
		sErrStr +=" Email address \n";
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
	if(document.registration.emailerr.value==1)
	{
			sErrStr +=" Email Address is already exists.  Please enter another Email Address \n";
			if(sFieldName == "")
			sFieldName="email";
	}
	if(trim(document.getElementById('zipcode').value)=='')
	{
		sErrStr +=" Zipcode \n";
		if(sFieldName == "")
		sFieldName="zipcode";
	}
	
	
		var count=0;
	for(i=0;i<document.registration.metropolitian_area.length;i++)
	{
		if(document.registration.metropolitian_area[i].checked==true)
		{
			count=count+1;
			document.getElementById('metroIds').value=document.registration.metropolitian_area[i].value+':'+document.getElementById('metroIds').value;
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
	document.registration.target="";
	document.registration.action="";
	document.registration.submit();

	
}
//********* END CODE FOR VALIDATING CLIENT REGISTRATION FORM ***********//

function editformvalidate()
{
	//alert("test");
	var form= document.regisstration;
	var sFieldName='';
	var showError =  '';
	var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	
	if(trim(document.getElementById('email').value)=='')
	{
		showError +=" Email address \n";
		if(sFieldName == "")
		sFieldName="email";
	
	}
	
	if(trim(document.getElementById('email').value)!='')
	{
		if(emailexp.test(document.getElementById('email').value)==0)
		{
			showError +=" Invalid Email Address \n";
			if(sFieldName == "")
			sFieldName="email";
		}
	}
	if(trim(document.getElementById('emailerr').value)==1)
	{
			showError +="Email Address already exists.  Please enter another Email Address \n";
			if(sFieldName == "")
			sFieldName="email";
	}
	if(trim(document.getElementById('pass').value) == '') 
	 {
     	  showError += "Password \n";
		  if(sFieldName == "")
		   sFieldName="pass";
        }
	
	if(trim(document.getElementById('zipcode').value) == '') 
	    {
     	 showError += "Zip Code \n";
		   if(sFieldName == "")
		   sFieldName="zipcode";
        } 
	
 
	/*var count=0;//alert(document.regisstration.metropolitian_area.length);
	for(i=0;i<document.regisstration.metropolitian_area.length;i++)
	{
		if(document.regisstration.metropolitian_area[i].checked==true)
		{
			count=count+1;//alert(count);
			document.getElementById('metroIds').value=document.regisstration.metropolitian_area[i].value+':'+document.getElementById('metroIds').value;
		}
	}
	//alert(document.getElementById('metroIds').value);
	if(count==0)
	{
			//alert(count);
		showError +=" Metropolitian Area \n";
		if(sFieldName == "")
		sFieldName="metropolitian_area1";
	
	}*/
	var count=0;
	for(i=0;i<document.registration.metropolitian_area.length;i++)
	{
		if(document.registration.metropolitian_area[i].checked==true)
		{
			count=count+1;
			document.getElementById('metroIds').value=document.registration.metropolitian_area[i].value+':'+document.getElementById('metroIds').value;
		}
	}
	//alert(document.getElementById('metroIds').value);
	if(count==0)
	{
		showError +=" Metropolitian Area \n";
		if(sFieldName == "")
		sFieldName="metropolitian_area1";
	}
   if(showError != "")
	{
		alert("Please enter the following fields \n\n"+showError);//alert(sFieldName);
		document.getElementById(sFieldName).focus();
		return false;

	} 

	//document.regisstration.action="login.php";
//	document.regisstration.submit();
    return true;
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
			   if(res!="")
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

//function emailcheck()
//{
//	 var h=document.registration.email.value;
//	 var req=createRequest();
//	 req.open("GET","member_emailverify.php?reg_email="+h,true);
//	 req.send(null);
//	 req.onreadystatechange=function()
//	 {
//		 //alert("hi");
//		 	
//    if(req.readyState==4  && req.status==200)
//		  {
//			   var res=req.responseText;
//			   if(res!="")
//				{
//					document.signupform.emailerr.value=1;
//				}
//				else
//				{
//					document.signupform.emailerr.value=0;
//				}
//				return false;
//		  } 
//	 } 
//}
function usernamechk(h,id)
{
	 var req=createRequest();
	 req.open("GET","member_emailverify.php?reg_username="+h,true);
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;//alert(res);
			   if(res!="")
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
function validatecontactform()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	
	if(trim(document.getElementById('contact_name').value)=='') 
	{
		sErrStr +=" Name \n";
		if(sFieldName == "")
		sFieldName="contact_name";
	
	} 
	var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

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
        	sErrStr +=" Email \n";
			if(sFieldName == "")
				sFieldName="email";
	     }
    }
	if(trim(document.getElementById('contact_subject').value) == '') 
	{
	  sErrStr +=" Subject \n";
		if(sFieldName == "")
		sFieldName="contact_subject";
	}
	if(trim(document.getElementById('contact_message').value) == '') 
	{
	  sErrStr +=" Message \n";
		if(sFieldName == "")
		sFieldName="contact_message";
	}
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
}
