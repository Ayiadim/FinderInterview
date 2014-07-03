<?php

require_once('twitteroauth.php');

Class TwitterConnector
{
	private $consumerKey;
	private $consumerSecret;
	private $oAuthToken;
	private $oAuthSecret;
	
	/* Constructor */
	public function TwitterConnector($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret)
	{
		$this->consumerKey = $consumerKey;
		$this->consumerSecret = $consumerSecret;
		$this->oAuthToken = $oAuthToken;
		$this->oAuthSecret = $oAuthSecret;
	}
	
	function Connect($username, $count)
	{
		$Auth = new TwitterOAuth($this->consumerKey, $this->consumerSecret, $this->oAuthToken, $this->oAuthSecret);
	
		$data = $Auth->get('https://api.twitter.com/1.1/statuses/user_timeline.json' , array('screen_name' => $username , 'count' => $count));

		echo "Statistics for User: " . $username . "<br/>";
		echo "Last " . $count . " Tweets: <br/>";
		$i = 1;
		foreach($data as $tweet)
		{
			echo $i . ". " . $tweet->text . "<br/>";
			$i++;
		}
		
		$userinfo = $Auth->get("https://api.twitter.com/1.1/users/show.json?screen_name=".$username);
		echo "Total number of Tweets: " . intval($userinfo->statuses_count) . "<br/>";
		echo "Following: " . intval($userinfo->friends_count) . "<br/>";
		echo "Followers: " . intval($userinfo->followers_count) . "<br/>";
	}
	
}

?>