<?php

 /**
 * +------------------------------------------------------------------------------------+
 * |																					|
 * | Authify Client Class.  Runs only on PHP 5 and above.  Requires CURL				|
 * |																					|	
 * | Authify Client Class make it faster and easier for users to access your website.	|
 * | Handles the UI, authentication, and import user profile							|
 * | and registration data for your website,											|
 * | You can choose to request JSON data or other type of request format.				|
 * |																					|
 * | Instanciate Authify Client with your API key and your SECRET key. 					|
 * |	Reference																		|
 * | $authifyObject = new authifyClientRest("APIKEY", 									|
 * |               "SECRET KEY");														|
 * |																					|
 * |	Code example																	|
 * | $authifyObject = new authifyClientRest("7935asdfqw43f34f393f5", 		 			|
 * |               "a3f4f3f34f34f4asf4sdfas0aeb");									 	|
 * +------------------------------------------------------------------------------------+
 */

/**
* This is version 9.5
*/
//
//The following code will 
//display_errors directive 
//
# error_reporting(E_ALL);
 
 
class authifyClientRest{

	private $url;
	private $item;
	private $idpselected;
	private $state;
	private $api_key;
	private $secret_key;
	private $authify_checksum;
	private $authify_requesttoken; //TODO:
	private $shared_key;
	private $LUid;
	private $settings=array();
	private $curl;
	private $service='require_login';



	/**
	 * Setup "credentials" authifyClientRest with our "credentials"
	 * This will automatically pull in any parameters,to validate them against the
	 * session signature.
	 * @param api_key                  your API key
	 * @param secret                   your API secret
	 *
	 */
	public function __construct($api_key,$secret_key='secret_key',$url='') {
		 include(dirname(__FILE__)."/authify_config.php");

		 $this->state="login";
		 $this->settings=$authifySettings;
		 $this->api_key=$api_key;
		 $this->secret_key=$secret_key;
		 if(empty($url))
			$this->url=(($_SERVER['SERVER_PROTOCOL']=='HTTP/1.1')?"http://":"https://"). $_SERVER['HTTP_HOST'] ."". $_SERVER['REQUEST_URI'];
		 else		
			$this->url=$url;

	}

	/**
	 * GetProperties: function returning the value(s) of the parameter(s)               
	 * @param value                   one element or string
	 *
	 * Exemple 1 (One parameter):
	 *		$authifyObject->GetProperties('state');
	 * @return a value:
	 *			 logout
	 *
	 * Exemple 2 (String separates with comma):
	 *		$authifyObject->GetProperties('state,item');
	 * @return an associative array:
	 *		 Array
	 *			(
	 *				[state] => login
	 *				[item] => liveid,gmail,facebook,googleapps,myspace,nordea,telia,bankid,yahoo,twitter,openid,inloggningse
	 *			)
	 *
     *	Exemple 3 (an array)
	 *		$authifyObject->GetProperties(array('state','uid'));
	 *  @return an array:
	 * 			 Array
	 *				(
     *					[state] => logout
     *					[uid] => 66
	 *				 )
	 *
	 */
	
	public function GetProperties($value){
		 if(json_decode($this->GetResponse())){
		 foreach((is_array($value))?$value:explode(',', $value) as $v){
		 	$a[$v] = json_decode($this->GetResponse())->data[0]->$v;
		 }
		 return (count($a)!=1)?$a:$a[$v];	
		}
 return '';		
	}
	 
	 public function SetMapping(){
		$this->service='require_login_mapping';
	}
	
	/**
	 * getRespons function 
	 * @param format           format request
	 * the default format is json
	 * @return a request as the format choose
	 */
	 public function GetResponse($format='json'){
		 
		 
		 $authify_response_token = (isset($_GET['authify_response_token']))?$_GET['authify_response_token']:'';
		 if (!$authify_response_token) $authify_response_token = (isset($_SESSION['authify_response_token']))?$_SESSION['authify_response_token']:'';

		 /* Backward compability for old implementations */
		 if (!$authify_response_token) $authify_response_token = (isset($_GET['authify_reponse_token']))?$_GET['authify_reponse_token']:'';
		 
		$post_elements = array(
			'secret_key'=>$this->secret_key,
			'api_key'   =>$this->api_key,
			'uri'       =>$this->url,
			'authify_checksum'=> $authify_response_token,
			'function'=>'GetResponse',
			'protocol'=>$format,
			'v'=>$this->settings['version']
			);
		return $this->authifyrest_curl_request_post($this->settings['authify_server_url'][$this->GetServerUp()]."json/",$post_elements);
		
	 }
	 
	/**
	 * require_login function
	 *
	 * Makes all the necessary requests to authenticate
	 * the current user to the server.
	 * @param string $idp choosen by The current user.
	 *
	 */
	public function RequireLogin($idp='facebook', $loginparameterx = '',$localUserId='',$url=''){
		
		$i=0;
        $arrayloginparameterx='';
        foreach((is_array($loginparameterx))?$loginparameterx:explode(',', $loginparameterx) as $value) {$arrayloginparameterx.=(($i)?':':'').$value; $i++;}

		if( ! strcmp( $this->state, 'login' ) ){
			$this->idpselected = $idp;
           
            
			$authify_request_token_hash =(md5(SHA1($this->api_key.$this->secret_key.time().rand())));
			
			$post_elements = array(
				'shared_key' 		=> $this->shared_key,//TODO:
				'secret_key' 		=> $this->secret_key,
				'api_key'    		=> $this->api_key,
				'uri'        		=> ($url=='') ? $this->url : $url,
				'authify_request_token' 	=> $authify_request_token_hash,//TODO:
				'idp'        		=> $this->idpselected,
				'luid'       		=> $localUserId,
				'gappsdomain' 		=> $arrayloginparameterx,
 		        'loginparameters' 	=> $arrayloginparameterx,
				'function'         	=> $this->service,
				'reseller_id'      	=> $this->settings['reseller_id'],
				
			    'v'=>$this->settings['version']
				);
                
                
				$curl_request_state = $this->authifyrest_curl_request_post( $this->settings['authify_server_url'][$this->GetServerUp()] . "request/", $post_elements );
		}
		$this->state=$this->GetProperties('state');
        header("Location: ".$this->settings['authify_server_url'][$this->GetServerUp()]."tokenidx.php?authify_request_token=".$authify_request_token_hash);//TODO:
		
		
	}
	
	/**
	 * SendDataToAuthify function
	 *
	 * Send data format XML to authify sever
	 * use XML valid version 1.0
	 * @return bool TRUE if the storing was terminated successfully, FALSE otherwise.
	 */	
	public function SendDataToAuthify($xml = ''){
			 
			 $authify_response_token = $_GET['authify_response_token'];
			 if (!$authify_response_token) $authify_response_token = $_SESSION['authify_response_token'];

			 /* Backward compability for old implementations */
			 if (!$authify_response_token) $authify_response_token = $_GET['authify_reponse_token'];
			 
				$post_elements = array(
					'extradata' 		=> $xml,
					'secret_key' 		=> $this->secret_key,
					'api_key'    		=> $this->api_key,
					'authify_reponse_token' => $authify_response_token,
					'function'         	=> 'ExtradataProfiles',
			        'v'=>$this->settings['version']
				);
				return $curl_request_state = $this->authifyrest_curl_request_post( $this->settings['authify_server_url'][$this->GetServerUp()] . "store/", $post_elements );
			}
			
	/**
	 * require_logout function
	 *
	 * Terminates the current user's session,
	 *
	 * @return bool TRUE if the session was terminated successfully, FALSE otherwise.
	 */
	public function RequireLogout($authify_response_token = ''){
	
	
		if (!$authify_response_token) $authify_response_token = (!isset($_SESSION['authify_response_token']))?NULL:$_SESSION['authify_response_token'];
		 
		/* Backward compability for old implementations */
		if (!isset($_SESSION['authify_response_token'])) $authify_response_token = $_GET['authify_response_token'];
		
		
		$elements = array('authify_checksum'=>$authify_response_token,'v'=>$this->settings['version']);
		
		$this->authifyrest_curl_request_post($this->settings['authify_server_url'][$this->GetServerUp()]."out/",$elements);
		
	}

	
	
	public function setSPUserId($localUserId){
		$this->LUid=$localUserId;
	}


	
	private function authifyrest_curl_request_post($server_addr,$params){

		if (function_exists('curl_init')) {
			$useragent = $this->settings['useragent'] . phpversion();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $server_addr);
			// this have to come before the POSTFIELDS set!
			curl_setopt($ch, CURLOPT_POST, 1 );
			if (strpos($server_addr, 'https://') === 0) {
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			}
			// passing an array gets curl to use the multipart/form-data content type
			$params['ip_ad']= (empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP']);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_ENCODING, "UTF-8");
			curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
			$result = curl_exec($ch);
			curl_close($ch);
		} else {
			$result =$this->settings['curl_msg'] ;
		}
		return $result;
	}
	
	private function http_check_url($url, $timeout = 10)
	{
		if (function_exists('curl_init')) {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_NOBODY, TRUE);
			if (strpos($url, 'https://') === 0) {
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			}
			if (!curl_exec($ch)) {
				return FALSE;
			}
			$ret = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			return in_array($ret, array(200, 301, 302));
		
			}
		else {
			return false;
		}
		
	}

	private function GetServerUp(){
		$urls = $this->settings['authify_server_url'];
		$url='';
		for ($i=-1;$url<count($urls);$url++){
		$urlserver=(isset($urls[$url]))?$urls[$url]:'';
			if ($this->http_check_url($urlserver))
			{
			return($url);
			}
		}
	}

}


?>