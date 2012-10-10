<?php
	$wsdl = 'http://api.stormpost.datranmedia.com/services/SoapRequestProcessor?wsdl';
	$soapClient = new SoapClient($wsdl);
	$login = new SOAPHeader($wsdl, 'username', 'soap@conglomeratenetwork.com');
	$password = new SOAPHeader($wsdl, 'password', 'Password2');
	$headers = array($login, $password);
	$soapClient->__setSOAPHeaders($headers);
?>