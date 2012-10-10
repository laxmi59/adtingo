<?php

/**
 * Braintree base class and initialization
 *
 *  PHP version 5
 *
 * @copyright  2010 Braintree Payment Solutions
 */


set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__)));

/**
 * Braintree PHP Library
 *
 * Provides methods to child classes. This class cannot be instantiated.
 *
 * @copyright  2010 Braintree Payment Solutions
 */
abstract class Braintree
{
    /**
     * @ignore
     * don't permit an explicit call of the constructor!
     * (like $t = new Braintree_Transaction())
     */
    protected function __construct()
    {
    }
    /**
     * @ignore
     *  don't permit cloning the instances (like $x = clone $v)
     */
    protected function __clone()
    {
    }

    /**
     * returns private/nonexistent instance properties
     * @ignore
     * @access public
     * @param string $name property name
     * @return mixed contents of instance properties
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_attributes)) {
            return $this->_attributes[$name];
        }
        else {
            trigger_error('Undefined property on ' . get_class($this) . ': ' . $name, E_USER_NOTICE);
            return null;
        }
    }

    public function _set($key, $value)
    {
        $this->_attributes[$key] = $value;
    }

    /**
     *
     * @param string $className
     * @param object $resultObj
     * @return object returns the passed object if successful
     * @throws Braintree_Exception_ValidationsFailed
     */
    public static function returnObjectOrThrowException($className, $resultObj)
    {
        $resultObjName = Braintree_Util::cleanClassName($className);
        if ($resultObj->success) {
            return $resultObj->$resultObjName;
        } else {
            throw new Braintree_Exception_ValidationsFailed();
        }
    }
}

include_once('Braintree/Modification.php');

include_once('Braintree/Address.php');
include_once('Braintree/AddOn.php');

include_once('Braintree/Collection.php');
include_once('Braintree/Configuration.php');
include_once('Braintree/CreditCard.php');
include_once('Braintree/Customer.php');
include_once('Braintree/Digest.php');
include_once('Braintree/Discount.php');
include_once('Braintree/EqualityNode.php');
include_once('Braintree/Exception.php');
include_once('Braintree/Http.php');
include_once('Braintree/Instance.php');

include_once('Braintree/KeyValueNode.php');
include_once('Braintree/MultipleValueNode.php');
include_once('Braintree/MultipleValueOrTextNode.php');
include_once('Braintree/PartialMatchNode.php');
include_once('Braintree/RangeNode.php');
include_once('Braintree/ResourceCollection.php');
include_once('Braintree/SSLExpirationCheck.php');
include_once('Braintree/Subscription.php');
include_once('Braintree/SubscriptionSearch.php');
include_once('Braintree/SubscriptionStatus.php');

include_once('Braintree/TextNode.php');
include_once('Braintree/Transaction.php');
include_once('Braintree/TransactionSearch.php');
include_once('Braintree/TransparentRedirect.php');
include_once('Braintree/Util.php');
include_once('Braintree/Version.php');
include_once('Braintree/Xml.php');
include_once('Braintree/Error/Codes.php');
include_once('Braintree/Error/ErrorCollection.php');
include_once('Braintree/Error/Validation.php');
include_once('Braintree/Error/ValidationErrorCollection.php');
include_once('Braintree/Exception/Authentication.php');
include_once('Braintree/Exception/Authorization.php');
include_once('Braintree/Exception/Configuration.php');
include_once('Braintree/Exception/DownForMaintenance.php');
include_once('Braintree/Exception/ForgedQueryString.php');
include_once('Braintree/Exception/NotFound.php');
include_once('Braintree/Exception/ServerError.php');
include_once('Braintree/Exception/SSLCertificate.php');
include_once('Braintree/Exception/Unexpected.php');
include_once('Braintree/Exception/UpgradeRequired.php');
include_once('Braintree/Exception/ValidationsFailed.php');
include_once('Braintree/Result/CreditCardVerification.php');
include_once('Braintree/Result/Error.php');
include_once('Braintree/Result/Successful.php');
include_once('Braintree/Test/CreditCardNumbers.php');
include_once('Braintree/Test/TransactionAmounts.php');
include_once('Braintree/Transaction/AddressDetails.php');
include_once('Braintree/Transaction/CreditCardDetails.php');
include_once('Braintree/Transaction/CustomerDetails.php');
include_once('Braintree/Transaction/StatusDetails.php');
include_once('Braintree/Xml/Generator.php');
include_once('Braintree/Xml/Parser.php');


if (version_compare(PHP_VERSION, '5.2.1', '<')) {
    throw new Braintree_Exception('PHP version >= 5.2.1 required');
}

$requiredExtensions = array('xmlwriter', 'SimpleXML', 'openssl', 'dom', 'hash', 'curl');

foreach ($requiredExtensions as $ext) {

    if (!extension_loaded($ext)) {
	echo $ext;
        throw new Braintree_Exception('The Braintree library requires the ' . $ext . ' extension.');
    }
}

// check ssl certificates
Braintree_SSLExpirationCheck::checkDates();
?>

