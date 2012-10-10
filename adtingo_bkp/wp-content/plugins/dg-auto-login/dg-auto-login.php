<?php
/*
Plugin Name: AutoLogin
Plugin URI: 
Description: This plugin allows to auto-login from friend sites. 
This would be useful when you want your visitors to see some private posts which are not visible otherwise.
Author: Dharmavirsinh Jhala
Version: 1.0
Author URI: http://www.digitss.com
*/
function dg_auto_login() 
{
    if (!is_user_logged_in()) 
	{
	$uid="admin";
		// Allow guest login from Friend URLs. Please specify list of all websites from which guest login is allowed.
		// You can choose/specify different user to auto-login them from different websites.
		$aFriend[] = array('URL' => 'http://adtingo.com/', 'USER' => $uid);
	/*	$aFriend[] = array('URL' => 'http://www.digitss.com', 'USER' => 'guest');
		$aFriend[] = array('URL' => 'http://www.dgtss.com', 'USER' => 'guest');
		$aFriend[] = array('URL' => 'http://blogs.dgtss.com', 'USER' => 'guest');*/
		
		
		// Check from what website user is landing on the wordpress blog
		$sReferer = strtolower($_SERVER['HTTP_REFERER']);
		
		// Set autologin false by default
		$bAutoLogin = false;
		
		// Check whether visit is referred from one of the friend URL?
		foreach($aFriend as $aConfig)
		{
			// we want to prevent cheat/attach here so that no one can add these URLs in query string and try to fool us;
			// So we are considering only "Friend-URL + 5" characters of Referring URL; rest of querysting will be ignored while
			// Searching FriendURL in ReferralURL; :)
			$sReferer = substr($sReferer, 0, strlen($aConfig['URL']) + 5);
			
			if(strpos($sReferer, $aConfig['URL']) !== false)
			{
				$bAutoLogin = true;
				$sUser = $aConfig['USER'];
				break;
			}
		}
		
		// Now proceed to autologin if friend website has reffered here.
		// This is just guest login you can create any other user and specify that user here those credientials will be granted 
		// once user visits from one of friend site. Even you can code such that for every friend 
		if($bAutoLogin === true)
		{
			if($sUser != "")
			{
				// Get User's data based on Username to initialize User session
				$User = get_userdatabylogin($sUser);
				$iUserID = $User->ID;
		  
				// Process auto-login
				wp_set_current_user($iUserID, $sUser);
				wp_set_auth_cookie($iUserID);
				do_action('wp_login', $sUser);
			}
		}
    }
}
// add a hook
add_action('init', 'dg_auto_login');
?>