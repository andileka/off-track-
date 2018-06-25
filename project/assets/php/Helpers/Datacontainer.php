<?php
namespace Hikify\Helpers;
//when file is included, initialise datacontainer url
if(empty($_ENV['kdatacontainer']['url'])) {
	$_ENV['kdatacontainer']['url'] = 'http://kdatacontainer.himalayasystems.be';
}

//$_ENV['kdatacontainer']['url'] = 'http://localhost/DC';
class Datacontainer {
	private static $ONLINE=true;
		
	public $standardvars;
	public $identification;
	public $http;
	
	private $owner;
	private $license;
	
	function __construct() {
		$this->owner	= 'novocar_test';
		$this->license	= '53a3bacbbcbb25529007ae3d839fd70a5163945c';
		if(!defined('CRLF')) {
			define ('CRLF', "\r\n");
		}
		$this->standardvars= array(
			'owner'		=> $this->owner,
			'license'	=> $this->license
		);
		$this->SetIdentification(); //log in
				
	}
	
	function __destruct() {
		
	}
	
	
	/**
	 * Will save a file into the remote datacontainer and return the key which can be used to reopen it
	 *
	 * @param string $field
	 * @param string $name
	 * @return int $identifier 
	 */
	function put_file($field='file', $name=false) {
		if(!$name) {
			return $this->_post(array(
									'filename' => str_replace("'",'',$_FILES[$field]['name']),
							       	'file' => file_get_contents($_FILES[$field]['tmp_name'])
							 	 ),'upload');
		} else {
			return $this->_post(array(
									'filename' => str_replace("'",'',$name),
							       	'file' => file_get_contents($name)
							 	 ),'upload');
		}
		
	}
	
	function rotateRight($hash, $degrees=90) {
		return $this->_post(array('hash'=>$hash,'degrees'=>$degrees), 'rotateRight');
	}
	/**
	 * 
	 * @param string $raw
	 * @param string $name
	 * @return string (SHA1 hash)
	 */
	public function put_file_raw($raw, $name, $action='upload') {
		if(substr($raw, 0,1)=='@') {
			error_log('document starts with @ sign: ' . QString::Truncate($raw, 150));
			throw new Exception('Could not send this document to the datacontainer.');
			//stupid curl deprecation warning hack
			return;//simply ignore files that start with @, i'm not going through the trouble of creating a file for this... seriously...
		}
		if(substr($name,0,1) == '@'){
			$name = '-'.substr($name, 1);
		}
		return $this->_post(array(
			'filename' => str_replace("'",'',$name),
			'file' => $raw
		),$action);
	}
	
	public function remove_file_by_hash($strHash) {
		if($strHash) {
			return $this->_post(array(
				'hash'=>$strHash
			), 'delete');
		}
	}
	
	/**
	 * 
	 * @param string $hash SHA1 (40 chars)
	 * @return string
	 */
	function get_url($hash) {
		return self::GetUrl($hash);
	}
	
	/**
	 * 
	 * @param string $hash SHA1 (40 chars)
	 * @param boolean $base64
	 * @return string|false
	 */
	function get_data($hash, $base64 = false){
		if(self::$ONLINE) {
			if(($data = @file_get_contents($this->get_url($hash)))){
				return $base64 ? base64_encode($data) : $data;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 * @param string $hash SHA1 (40 chars)
	 * @param boolean $newwindow
	 */
	function show_file($hash, $newwindow=true) {
	    if($newwindow) {
			QApplication::ExecuteJavaScript('qt.openWindow("'.$_ENV['kdatacontainer']['url'].'/?action=view&owner='.$this->owner.'&hash='.$hash.'");');
	    } else {
			QApplication::Redirect($this->get_url($hash));
	    }
	}
	
	function SetIdentification() {
		if(self::$ONLINE) {
			$this->identification = $this->_post($this->standardvars,'identify');			
		}
	}
	
	/**
	 * This will do the actually request to the server
	 *
	 * @param array $variables
	 * @return unknown
	 */
	private function _post($variables, $action) {
		ini_set('track_errors', '1');
		$variables['action'] = $action;
		
		$extra='/?action=' . $action;
		if($this->identification) { //als er een identification string aanwezig is, send it through
			$extra.= '&PHPSESSID='.$this->identification;
		}
		
		//alternative way, use curl
		$curl = curl_init(); 
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER	=> 1,
			CURLOPT_URL				=> $_ENV['kdatacontainer']['url'].$extra,
			CURLOPT_USERAGENT		=> 'DC PM',
			CURLOPT_POST			=> 1,
			CURLOPT_POSTFIELDS		=> $variables,
		));
		
		$data = curl_exec($curl);
		curl_close($curl);
		if($action=='identify') {
			$this->identification = $data;
		}
				
		return $data;
	}
	
	
	public static function GetQrCodeImgTag($strLabel, $strData, $strWidth='520') {
		if(self::$ONLINE) {
			$url = self::GetQrCodeUrl($strLabel, $strData, array('size'=>$strWidth,'BackgroundAlpha'=>127));
			return "<img class='QR' src='$url' width='$strWidth'/>";
		} else {
			return '';
		}
	}
	
 	public static function GetQrCodeUrl($strLabel, $strData, $arrParams=null) {
		if(self::$ONLINE) {
			$strLabel	= urlencode($strLabel);
			$strData	= urlencode($strData);
			if($arrParams) {
				$strParams = http_build_query($arrParams);
			} else {
				$strParams = '1';
			}
			return $_ENV['kdatacontainer']['url']."/?action=createqrcode&label=$strLabel&data=$strData&$strParams";
		} else {
			return '';
		}
	}
	
	public static function GetUrl($strHash, $straction = 'view') {
		if(self::$ONLINE) {
			$url		= $_ENV['kdatacontainer']['url'].'/?action='.$straction.'&owner='.'novocar_test';
			if(is_array($strHash)){
				$url .= '&hashes='.implode(',',$strHash);
			} else {
				$url .= '&hash='.$strHash;
			}
			
			return $url;
		} else {
			return '';
		}
	}
	
	public static function GetFileFromTempLocation($strHash) {
		if(self::$ONLINE) {
			return file_get_contents($_ENV['kdatacontainer']['url'].'/?action=viewtemp&owner='.Config::Get('KDATACONTAINER_OWNER').'&hash='.$strHash);
		} else {
			return '';
		}
	}
	
	/**
	 * 
	 * @param type $raw
	 * @param type $name
	 * @return string identifier
	 */
	public static function SaveRawFileToTempLocation($raw, $name='unknownfilename') {
		if(self::$ONLINE) {
			$dc			= new DatacontainerHelper();
			$identifier = $dc->put_file_raw($raw, $name,'uploadtemp');

			return $identifier;
		} 
		
	}
	
	
	public static function getStorageUsage() {
		$owner = Config::Get('KDATACONTAINER_OWNER');
		
		$curl_handle=curl_init();
		
		curl_setopt($curl_handle, CURLOPT_URL,$_ENV['kdatacontainer']['url'].'/?action=storageusage&loginkey=kdatacontainerlicense&owner='.$owner);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 200);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'PlanManager');
		$storage = curl_exec($curl_handle);
		curl_close($curl_handle);
		if($storage) {
			$storage = json_decode($storage);//should return an array where key = the owner and value is the amount of megabytes
			if($storage && isset($storage->$owner)) {
				return $storage->$owner;
			}
		}
	}
	
	public static function getServerName() {
		return $_ENV['kdatacontainer']['url'];
	}
	
	public static function isOnline() {
		return self::$ONLINE;
	}
	
	
	
	
}