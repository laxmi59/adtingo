// JavaScript Document

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
		sErrStr +=" UserName \n";
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
		alert("Please enter following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
}
//********* END CODE FOR VALIDATING ADMIN LOGIN FORM ***********//


//************ START CODE FOR VALIDATION CHANGE PASSWORD FORM *********//
function validatechpwd()
{
	var msg="";
	var field="";
	if(trim(document.getElementById('opassword').value)=="")
	{
		msg +="Old Password \n";
		field="opassword";
	}
	if(trim(document.getElementById('npassword').value)=="")
	{
		msg +="New Password \n";
		if(field=="")
		field="npassword";
	}
	var val=document.getElementById('npassword').value;
	if(document.getElementById('npassword').value!="")
	{
		if(val.length<6)
		{
			msg +="New Password should contain atleast 6 characters \n";
			if(field=="")
			field="npassword";
		}
	}
	if(trim(document.getElementById('cnpassword').value)=="")
	{
		msg +="Confirm New Password \n";
		if(field=="")
		field="cnpassword";
	}
	if(trim(document.getElementById('cnpassword').value)!="")
	{
		if(trim(document.getElementById('cnpassword').value)!=trim(document.getElementById('npassword').value))
		{
			msg +="Confirm New Password and Password should be same \n";
			if(field=="")
			field="cnpassword";
		}
	}
	if(msg!="")
	{
		alert("Please enter following fields \n\n"+ msg);
		if(field!="")
		{
			document.getElementById(field).focus();
		}
		return false;
	}
}

//************ END CODE FOR VALIDATION CHANGE PASSWORD FORM *********//

//*********** START CODE FOR CANCLE BUTTON ************//
function canclepwdfrm()
{
	window.location.href="artists.php";
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

function limtval(val,pagename,querystrg)
{
		alert(querystrg);
	window.location.href=pagename+".php?limit="+val+querystrg;
}
//******* END CODE FOR VIEWING PAGE PER LIMIT *******//

//******* START CODE FOR VIEWING PAGE PER LIMIT *******//

function deleteCatName(catid,page)
{
		var agree = confirm('Are you sure you want to delete this Category?')
	if(agree)
	  window.location.href="categories.php?delid="+catid+"&page="+page;

	
}
//******* END CODE FOR VIEWING PAGE PER LIMIT *******//

//******* START CODE FOR VIEWING PAGE NUM ENTERED IN TEXT BOX *******//

function pagelist(val)
{
		window.location.href="categories.php?page="+val;

	
}
//******* END CODE FOR VIEWING PAGE NUM ENTERED IN TEXT BOX *******//

//******* START CODE FOR VALIDATING ADD PRIMARY GENERE FROM PAGE  *******//

function validatePrimaryGenere()
{
	if(trim(document.getElementById('PrimaryGenre').value)=="")
	{
		alert("Please enter Primary Genre");
		document.getElementById('PrimaryGenre').focus()
		return false;
	}
}
//******* END CODE FOR VALIDATING ADD PRIMARY GENERE FROM PAGE  *******//

//******* START CODE FOR DELETING PRIMARY GENERE ***********//
function deletePrimName(pid,page)
{
	var agree = confirm('Are you sure you want to delete this Primary Genere?')
	if(agree)
	  window.location.href="primarygenres.php?delid="+pid+"&page="+page;
}

//******* END CODE FOR DELETING PRIMARY GENERE ***********//

//******* START CODE FOR UPDATING PRIMARY GENERE ORDER***********//
function deletePrimName(pid,page)
{
	var agree = confirm('Are you sure you want to delete this Primary Genere?')
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
		//alert(res);
		//var page_id=<?php echo $_REQUEST['page_id'];?>;
		//alert(document.getElementById('imgreplace_'+page_id).innerHTML);
		document.getElementById('imgreplace').innerHTML=res;
	
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
	var agree = confirm('Are you sure you want to delete this Secondary Genere?')
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
		document.getElementById('imgreplace').innerHTML=res;
	
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

//******* END CODE FOR UPDATING SECONDARY GENERE ORDER***********//








 