<?php
/**
 * php-pushover
 *
 * PHP service wrapper for the pushover.net API: https://pushover.net/api
 * 
 * @author Mike Preston <mike@technomonk.com> based on code by Chris Schalenborgh <chris.s@kryap.com>
 * @version 0.2
 * @package php-pushover	
 * @example test.php
 * @link https://pushover.net/api
 * @license BSD License
 */ 

namespace DarkFlib\Pushover; 

class Validate
{
	// api url
	const API_URL = 'https://api.pushover.net/1/users/validate.json';
	
	/**
	 * Application API token
	 *
	 * @var string
	 */
	private $_token;
	
	/**
	 * User API token
	 *
	 * @var string
	 */
	private $_user;
	
	/**
	 * Turn on/off debug mode
	 *
	 * @var bool
	 */
	private $_debug = false;
	
	/**
	 * Default constructor
	 */
    public function __construct ($token = null, $user = null) {
	$this->_token = (string)$token;
        $this->_user = (string)$user;
    }
	/**
	 * Set API token
	 * 
	 * @param string $token Your app API key.
	 *
	 * @return void
	 */
    public function setToken ($token) {
        $this->_token = (string)$token;
    }

	/**
	 * Get API token
	 * 
	 * @return string
	 */
    public function getToken () {
        return $this->_token;
    }

	/**
	 * Set API user
	 * 
	 * @param string $user The user's API key.
	 *
	 * @return void
	 */
    public function setUser ($user) {
        $this->_user = (string)$user;
    }

	/**
	 * Get API user
	 * 
	 * @return string
	 */
    public function getUser () {
        return $this->_user;
    }

	/**
	 * Set debug mode
	 * 
	 * @param bool $debug Enable this to receive detailed input and output info.
	 *
	 * @return void
	 */
    public function setDebug ($debug) {
        $this->_debug = (boolean)$debug;
    }

	/**
	 * Get debug mode
	 * 
	 * @return bool
	 */
    public function getDebug () {
        return $this->_debug;
    }
	
	

	/**
	 * Set sound
	 * 
	 * @param string $sound If no sound parameter is specified, the user's default tone will play. If the user has not chosen a custom sound, the standard Pushover sound will play.
	 *
	 * @return void
	 */
    public function setSound ($sound) {
        $this->_sound = (string)$sound;
    }

	/**
	 * Get sound
	 * 
	 * @return string
	 */
    public function getSound () {
        return $this->_sound;
    }
	
	/**
	 * Send message to Pushover API
	 * 
	 * @return bool
	 */
	public function send() {
		if(!Empty($this->_token) && !Empty($this->_user)) {
			
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, self::API_URL);
			curl_setopt($c, CURLOPT_HEADER, false);
			/*
			if possible, set CURLOPT_SSL_VERIFYPEER to true..
			- http://www.tehuber.com/phps/cabundlegen.phps 
			*/
			curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($c, CURLOPT_POSTFIELDS, array(
			  	'token' => $this->getToken(),
			  	'user' => $this->getUser(),
			));	
			$response = curl_exec($c);
			$output = json_decode($response,TRUE);
			
			if($this->getDebug()) {
				return array('output' => $output, 'input' => $this);
			}
			else {
				return ($output->status == 1) ? true : false;
			}
		}
	}
}
?>
