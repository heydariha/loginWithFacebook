<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Facebook extends CI_Controller
{
//_________________________________________________
	function __construct()
	{

	}
/**
*Create facebook onject
*
* @ return Facebook
*/
	function fbFactory()
	{
		$obj		= get_instance();
		$fb		= new Facebook\Facebook([
				'app_id' =>$obj->config->config['facebook_app_id'],
				'app_secret' => $obj->config->config['facebook_app_secret'],
				'default_graph_version' => $obj->config->config['facebook_default_graph_version'],
				'default_access_token' => isset($_COOKIE['facebook_access_token']) ? $_COOKIE['facebook_access_token'] : $obj->config->config['facebook_app_id'].'|'.$obj->config->config['facebook_app_secret']
		]);
		return $fb;
	}
/**
*Check if use is logged
*
*@ retuen user | Null
*/
	public function checkIfLogedIn($fb)
	{
		try
		{
			$response = $fb->get('/me?fields=id,name');
			$user = $response->getGraphUser();
			return $user;
		} catch(Facebook\Exceptions\FacebookResponseException $e) 
		{
			return false;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			return false;
		}
	}
/**
*login for new users
*
*@ string Access Token
*/
	public function login($fb)
	{
		$helper = $fb->getRedirectLoginHelper();
		try
		{
			$accessToken = $helper->getAccessToken(base_url('login/callback'));
		} catch(Facebook\Exceptions\FacebookResponseException $e) 
		{
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) 
		{
			// echo 'Facebook SDK returned an error: ' . $e->getMessage();
			redirect('login');
			exit;
		}

		if (! isset($accessToken)) 
		{
			redirect('login');
			exit;
		}
		else
		{
			$oAuth2Client = $fb->getOAuth2Client();
			$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			set_cookie('facebook_access_token',(string) $longLivedAccessToken);
		}
		return $accessToken->getValue();
	}
/**
*fetching user information from facebook
*
* @ return Array
*/
	public function getUser($fb,$accessToken)
	{
		$response = $fb->get('/me?fields=id,name', $accessToken);
		$temp			= $response->getGraphUser();
		$record			= array('fb_id'=>$temp['id'],
								'fb_name'=>$temp['name'],
								'fb_profile_pic'=>"https://graph.facebook.com/v2.2/{$temp['id']}/picture",
								'fb_is_active'=>'1',
								'fb_token'=>$accessToken
								);
		return $record;
	}

}

?>