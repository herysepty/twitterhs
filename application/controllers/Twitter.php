<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH .'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');	
		$this->load->library('session');
	}
	public function index()
	{
		$this->load->view('layouts/twitter/header');
	}

	public function username($username)
	{

	}

	public function login()
	{
		if (!isset($_SESSION['access_token'])) {
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
			$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => URL_CALLBACK_TWITTER));
			$_SESSION['oauth_token'] = $request_token['oauth_token'];
			$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
			$url = $connection->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
			header('Location: ' . $url);

		} else {
			$access_token = $_SESSION['access_token'];
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
			$user = $connection->get("account/verify_credentials");
			// echo $user->screen_name;
			echo "<pre>";
			print_r($user);
			echo "</pre>";
		}

	}

	public function callback()
	{
		if (isset($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] == $_SESSION['oauth_token'])
		{	
			$request_token = [];
			$request_token['oauth_token'] = $_SESSION['oauth_token'];
			$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
			$connection = new TwitterOAuth(Consumer_Key, Consumer_Secret, $request_token['oauth_token'], $request_token['oauth_token_secret']);
			$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
			$_SESSION['access_token'] = $access_token;
			// redirect user back to index page
			// header('Location: ./');

			// $user_id = $user_info->id;

			if (200 == $connection->getLastHttpCode()) {
			    $_SESSION['access_token'] = $access_token;
			    unset($_SESSION['oauth_token']);
			    unset($_SESSION['oauth_token_secret']);
			    $_SESSION['status'] = 'verified';
			} else {
			    session_destroy();
			}
		}else
		{
			header('Location: login.php');
		}
	}

	public function logout() {
		session_unset();
		session_destroy();
		header('Location: ../index.php');
	}
}
