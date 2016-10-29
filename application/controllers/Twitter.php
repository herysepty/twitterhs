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
		$web['site_name'] = 'Timeline';
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$timelines = $connection->get("statuses/user_timeline", array('count' => 100, 'exclude_replies' => true, 'screen_name' => $_SESSION['screen_name']));
		$data['timelines'] = $timelines;
		// print_r($data);
		$this->load->view('layouts/twitter/header',$web);
		$this->load->view('layouts/twitter/navbar');
		$this->load->view('contents//twitter/timeline',$data);
		$this->load->view('layouts/twitter/footer');
	}

	public function search (){
		$web['site_name'] = 'Search';
		// print_r($data);
		$this->load->view('layouts/twitter/header',$web);
		$this->load->view('layouts/twitter/navbar');
		$this->load->view('contents//twitter/search');
		$this->load->view('layouts/twitter/footer');
	}

	public function searchResult(){
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$tweets = $connection->get("search/tweets", ["q" => $_POST['q'],"count"=>100,"result_type"=>"recent"]);
        echo json_encode($tweets->statuses);
	}
	public function getAllTweets(){
		$max_id=0;
		$tweets_all = array();
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		for ($i=0; $i < 2; $i++) 
        { 
            $tweets = $connection->get("search/tweets", ["q" => 'ahok',"count"=>2,"max_id"=>$max_id,"result_type"=>"recent"]);
            $tweets_all = array_merge($tweets_all,$tweets->statuses);
        	$tmp = end($tweets->statuses);
        	$max_id      = $tmp->id_str;
        }

        echo "<pre>";
        // print_r($tmp->id_str);
        // echo print_r(json_encode($tweets_all));
        file_put_contents('storages/'.date('Y-m-d_his').'.json',json_encode($tweets_all));
        echo "</pre>";
	}

	public function trend() {
		$web['site_name'] = 'Trends';
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$trends = $connection->get('trends/place', array('id' => 23424977));
		$trends_indonesia = $connection->get('trends/place', array('id' => 23424846));
		$trends_jakarta = $connection->get('trends/place', array('id' => 1047378));
			
		$data['trends'] = $trends;
		$data['trends_indonesia'] = $trends_indonesia;
		$data['trends_jakarta'] = $trends_jakarta;
		if (200 == $connection->getLastHttpCode()) {
			$this->load->view('layouts/twitter/header',$web);
			$this->load->view('layouts/twitter/navbar');
			$this->load->view('contents//twitter/trends',$data);
			$this->load->view('layouts/twitter/footer');
		} else {
			echo "<pre>";
			print_r($data);
			echo "<pre>";
		    // redirect('/username/'.$_SESSION['screen_name']);
		}

	}

	public function username($username)
	{
		$web['site_name'] = $_SESSION['screen_name'];
		$this->load->view('layouts/twitter/header',$web);
		$this->load->view('layouts/twitter/navbar');
		$this->load->view('contents//twitter/profile');
		$this->load->view('layouts/twitter/footer');
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
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
			$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
			$_SESSION['access_token'] = $access_token;
			$this->userInfo();
			// redirect user back to index page

			// $user_id = $user_info->id;

			if (200 == $connection->getLastHttpCode()) {
			    $_SESSION['access_token'] = $access_token;
			    unset($_SESSION['oauth_token']);
			    unset($_SESSION['oauth_token_secret']);
			    $_SESSION['status'] = 'verified';
			} else {
			    session_destroy();
			}
			header('/username/'.$_SESSION['screen_name']);
		}else
		{
			redirect('/login');
		}
	}
	public function logout() {
		session_unset();
		session_destroy();
		redirect('/');
	}

	public function directMessages() {
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$messages = $connection->get('direct_messages', ['count' => 5]);
		echo "<pre>";
		print_r($messages);
		echo "</pre>";
	}
	public function userInfo() {
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$user = $connection->get("account/verify_credentials");
		foreach ($user as $key => $value) {
			// echo $value."<br>";
			if($key != 'entities' AND $key != 'status') {
				$_SESSION[$key] = $value;
			}
		}
	}

	public function ajaxGetTrends() {
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$trends = $connection->get('trends/place', array('id' => 23424977));
		$trends_indonesia = $connection->get('trends/place', array('id' => 23424846));
		$trends_jakarta = $connection->get('trends/place', array('id' => 1047378));
			
		$data['trends'] = $trends;
		$data['trends_indonesia'] = $trends_indonesia;
		$data['trends_jakarta'] = $trends_jakarta;
		echo json_encode($data);
	}
}
