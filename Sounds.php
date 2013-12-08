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

class Sounds
{
	// api url
	const API_URL = 'https://api.pushover.net/1/sounds.json';
	
	/**
	 * Application API token
	 *
	 * @var string
	 */
	private $_token;
	
	/**
	 * Turn on/off debug mode
	 *
	 * @var bool
	 */
	private $_debug = false;
	
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
	 * Send message to Pushover API
	 * 
	 * @return bool
	 */
	public function send() {
		if(!Empty($this->_token)) {
			
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, self::API_URL.'?token='.$this->getToken());
			curl_setopt($c, CURLOPT_HEADER, false);
			/*
			if possible, set CURLOPT_SSL_VERIFYPEER to true..
			- http://www.tehuber.com/phps/cabundlegen.phps 
			*/
			curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($c);
			$output = json_decode($response,true);
			
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
