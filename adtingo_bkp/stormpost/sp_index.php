<?php
/*
	$wsdl = 'http://api.stormpost.datranmedia.com/services/SoapRequestProcessor?wsdl';
	 $xml = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://services.web.stormpost.skylist.com" xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/">
   <soapenv:Header>
      <authInfo xsi:type="soap:authentication" xmlns:soap="http://skylist.com/services/SoapRequestProcessor">
         <username xsi:type="xsd:string">soap@conglomeratenetwork.com</username>
         <password xsi:type="xsd:string">Password2</password>
      </authInfo>
   </soapenv:Header>
   <soapenv:Body>
      <ser:createSendTemplate soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
         <sendTemplateBean xsi:type="soap:SendTemplateBean" xmlns:soap="http://skylist.com/services/SoapRequestProcessor">
            <!--You may enter the following 28 items in any order-->
            <title xsi:type="soapenc:string">SOAP Mail 9/17/2010</title>
            <externalID xsi:type="soapenc:string"></externalID>
            <subject xsi:type="soapenc:string">Adtingo Subject</subject>
            <fromEmail xsi:type="soapenc:string">shekar@ritwik.com</fromEmail>
            <fromName xsi:type="soapenc:string">Adtingo</fromName>
            <toEmail xsi:type="soapenc:string">shekar@ritwik.com</toEmail>
            <toName xsi:type="soapenc:string">shekar</toName>
            <replyToEmail xsi:type="soapenc:string">shekar@ritwik.com</replyToEmail>
            <replyToName xsi:type="soapenc:string">Adtingo</replyToName>
            <encoding xsi:type="soapenc:string">quoted-printable</encoding>
            <charset xsi:type="soapenc:string">ISO-8859-1</charset>
            <blockDomains xsi:type="soap:ArrayOf_soapenc_string" soapenc:arrayType="soapenc:string[]"/>
            <trackType xsi:type="soapenc:string">ALL</trackType>
            <openTrackType xsi:type="soapenc:string">HTML</openTrackType>
            <clickStreamType xsi:type="soapenc:string">NONE</clickStreamType>
            <purgeLists xsi:type="soap:ArrayOf_xsd_int" soapenc:arrayType="xsd:int[]"/>
            <purgeSuppressionLists xsi:type="soap:ArrayOf_xsd_int" soapenc:arrayType="xsd:int[]"/>
            <campaignID xsi:type="xsd:int"></campaignID>
            <brandID xsi:type="xsd:int">1</brandID>
            <replyContentID xsi:type="xsd:int"></replyContentID>
            <unsubContentID xsi:type="xsd:int"></unsubContentID>
            <footerContentID xsi:type="xsd:int"></footerContentID>
            <headerContentID xsi:type="xsd:int"></headerContentID>
            <forwardFriendContentID xsi:type="xsd:int"></forwardFriendContentID>
            <advertiserName xsi:type="soapenc:string"></advertiserName>
            <unsubReportsAddress xsi:type="soapenc:string"></unsubReportsAddress>
            <unsubReportsSize xsi:type="xsd:int"></unsubReportsSize>
            <enabled xsi:type="xsd:boolean">TRUE</enabled>
         </sendTemplateBean>
         <textContent xsi:type="soapenc:string">text content text content text content</textContent>
         <htmlContent xsi:type="soapenc:string">&lt;HTML&gt;&lt;HEAD&gt;&lt;META NAME="Generator" CONTENT="EditPlus"&gt;&lt;META NAME="Author" CONTENT=""&gt;&lt;META NAME="Keywords" CONTENT=""&gt;&lt;META NAME="Description" CONTENT=""&gt;&lt;/HEAD&gt;
&lt;BODY&gt;&lt;CENTER&gt;&lt;B&gt;html content&lt;/B&gt;&lt;B&gt;html content&lt;/B&gt;&lt;B&gt;html content&lt;/B&gt;&lt;B&gt;html content&lt;/B&gt;&lt;B&gt;html content&lt;/B&gt;&lt;B&gt;html content&lt;/B&gt;&lt;/CENTER&gt;&lt;/BODY&gt;&lt;/HTML&gt;</htmlContent>
      </ser:createSendTemplate>
   </soapenv:Body>
</soapenv:Envelope>';

	$soap = new SoapClient($wsdl);

	#var_dump($soap->__getFunctions());
	$address = "shekar@ritwik.com";
	echo $result = $soap->getRecipientByAddress($address'shekar@ritwik.com');
*/
$wsdl = 'http://api.stormpost.datranmedia.com/services/SoapRequestProcessor?wsdl';
$soapClient = new SoapClient($wsdl);

$login = new SOAPHeader($wsdl, 'username', 'soap@conglomeratenetwork.com');
$password = new SOAPHeader($wsdl, 'password', 'Password2');
$headers = array($login, $password);

$soapClient->__setSOAPHeaders($headers);

 #$ap_param = 'shekar@ritwik.com';
                   
        // Call RemoteFunction ()
        $error = 0;
        try {
           echo  $info = $soapClient->__call("getSendTemplateContent", array('2','TEXT'));
		   #echo  $info = $soapClient->__call("getRecipientByAddress", array($ap_param));
        } catch (SoapFault $fault) {
            $error = 1;
            print("
            alert('Sorry, blah returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring.". We will now take you back to our home page.');
            window.location = 'main.php';
            ");
        } 

/*

        $soapClient = new SoapClient("http://api.stormpost.datranmedia.com/services/SoapRequestProcessor?wsdl");
   
        // Prepare SoapHeader parameters
        $sh_param = array('username'=>'soap@conglomeratenetwork.com','password'=>'Password2');
		$headers = array();

        $headers = new SoapHeader('http://skylist.com/services/SoapRequestProcessor', 'username', 'soap@conglomeratenetwork.com');


       # $headers[1] = new SoapHeader('http://skylist.com/services/SoapRequestProcessor', 'password', 'Password2',false);

		print_r($headers);
   
        // Prepare Soap Client
        $soapClient->__setSoapHeaders(array($headers));

		$headers1 = array();

        $headers1 = new SoapHeader('http://skylist.com/services/SoapRequestProcessor', 'password', 'Password2');


       # $headers[1] = new SoapHeader('http://skylist.com/services/SoapRequestProcessor', 'password', 'Password2',false);

		print_r($headers1);
   
        // Prepare Soap Client
        $soapClient->__setSoapHeaders(array($headers1));


		print_r($soapClient);
   

        // Setup the RemoteFunction parameters
        $ap_param = array('address' => 'shekar@ritwik.com');
                   
        // Call RemoteFunction ()
        $error = 0;
        try {
           echo  $info = $soapClient->__call("getRecipientByAddress", array($ap_param));
        } catch (SoapFault $fault) {
            $error = 1;
            print("
            alert('Sorry, blah returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring.". We will now take you back to our home page.');
            window.location = 'main.php';
            ");
        } 
	*/
?>