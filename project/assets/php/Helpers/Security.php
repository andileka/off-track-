<?php

namespace Hikify\Helpers;
use Log;
use User;

class Security {
	/*const AUTTHENTICATED_OK						='OK';
	const AUTTHENTICATED_PERMANENTLY_INACTIVE	='PERMANENTLY_INACTIVE_DEVICE';
	const AUTTHENTICATED_INACTIVE_DEVICE			='INACTIVE_DEVICE';
	*/
	const AUTHENTICATED_OK						= 'OK';
	const AUTHENTICATED_NOT_OK					= 'NOT OK';
	const AUTHENTICATED_PERMANENTLY_INACTIVE	= 'PERMANENTLY_INACTIVE';
	const AUTHENTICATED_INACTIVE_DEVICE			= 'INACTIVE_DEVICE';
	const AUTHENTICATED_NEEDS_USER_AUTH			= "NEEDS_USER_AUTH";

	const FAILED_ATTEMPT_WAIT_X_SECONDS			= 5;
	
	public static function RandomPassword($intLength=6,$chars='abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHJKMNPQRSTUVW;,.:<>!@*()+=_-|{}[]') {
		// some functions use this to check whether a code is valid or not, so keep this as is
		// most notable: the access code uses '0123456789' as $chars and sets the code to '0000' to disable it ( SecurityHelper::CheckCode('0000') always returns false)

		return	substr(
					str_shuffle(
						str_repeat($chars, ceil($intLength / strlen($chars)))
					)
				,0,$intLength);
	}

	public static function GetIp() {
		if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			return $_SERVER['REMOTE_ADDR'];
		}
	}

	public static function IsInsyproIp() {
		\QCubed\Project\Application::Log(self::GetIp());
		return in_array(self::GetIp(), array('81.82.207.237','127.0.0.1','192.168.113.2','192.168.113.3','192.168.10.113','95.171.167.100'));
	}

	
	public static function IsAuthorised($strController = 'main', $strAction = 'index') {
		return isset($_SESSION['USER']);
	}

	/**
	 *
	 * @param string $strUsername
	 * @param string $strPassword
	 * @param type $log
	 *
	 * @return User
	 */
    public static function Login($strUsername, $strPassword){
		/*$objLastLoginLog				= Log::GetLastSuccessfullLoginFor($strUsername);
		$intRecentFailedLoginAttempts	= Log::CountRecentFailedLoginAttemptsFor($strUsername, $objLastLoginLog ? $objLastLoginLog->Datetime : null);
		
		if($intRecentFailedLoginAttempts && ($objLastFailedLoginLog		= Log::GetLastFailedLoginFor($strUsername)) ) {
			$objWaitUntil				= clone $objLastFailedLoginLog->DateTime; //we zouden de objWaitUntil nog kunnen gebruiken later om een werkelijke datetime te tonen, maar voorlopig is een seconde timer voldoende.
			$objWaitUntil->AddSeconds($intRecentFailedLoginAttempts*self::FAILED_ATTEMPT_WAIT_X_SECONDS); //1 poging fout = 1 x 5s, 2poginginen= 2x5s= 10s, 3=15, 4 = 20,...
			$intSecondsToWait			= $objWaitUntil->Difference(\QCubed\QDateTime::Now())->Seconds;
			if($intSecondsToWait > 0) {
				Log::MakeEntry(Log::LOGON_FAILED, $strUsername);
				throw new Exception('You are logging in too fast. Please try again in %d seconds.', $intSecondsToWait);
			}
		}*/
		if(($user = self::CheckLoginDetails($strUsername, $strPassword))) {
			//user logged in now log it
			self::MakeSession($user);
            Log::MakeEntry(Log::LOGON, $strUsername);
			return $user;
		} else {
			//unsuccesful login attempts
			Log::MakeEntry(Log::LOGON_FAILED, $strUsername);
		}
	}
	
	private static function CheckLoginDetails($strEmail, $strPassword) {
		if( $strEmail != '' && $strPassword != '' && ($user		= \User::LoadByEmail($strEmail))){
			if($user->Password == sha1($strPassword.$user->Salt)) {
				return $user;//all is well
			}
			if($user->Password == sha1($strPassword) || $user->Password == md5($strPassword)) {
				//also good, but saltify the password before allowing access
				$user->SetSaltedPassword($strPassword);
				return $user;
			}
		}
		throw new \Exception('STOP');
		
	}

	private static function MakeSession(User $user){
		// prevent session fixation
		session_regenerate_id();

		$_SESSION['USER']		= $user->Id;
		$_SESSION['COUNTRY']	= 'BE';
	}

    public static function DestroySession($unset=true) {
		if(\QCubed\Project\Control\FormBase::$FormStateHandler === '\QCubed\FormState\FileHandler'){
			\QCubed\FormState\FileHandler::DeleteFormStateForSession();
		}
		if(\QCubed\Project\Control\FormBase::$FormStateHandler === '\QCubed\FormState\DatabaseHandler'){
			\QCubed\FormState\DatabaseHandler::DeleteFormStateForSession();
		}
		if($unset) {
			session_unset();
		}
		session_destroy();
		session_start();
	}

    public static function Encrypt($text, $key){
		return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $text, MCRYPT_MODE_CBC, md5(md5($key)));
    }

    public static function Decrypt($text, $key){
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), $text, MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    }

	/**
	 *
	 * @return User
	 */
	public static function GetLoggedInUser($objOptionalClauses=null) {
		if(!isset($_SESSION['USER'])) {
			\QCubed\Project\Application::Redirect('index.php');
		}
		return \User::Load($_SESSION['USER'], $objOptionalClauses);
	}

	
}
