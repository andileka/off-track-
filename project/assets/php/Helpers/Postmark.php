<?php
namespace Hikify\Helpers;

use Postmark\PostmarkClient;
/**
 * Class Postmark	
 *
 * @package QCubed\Project\Control
 * @was Postmark
 */
class Postmark {
	const API_KEY		= '6fe366a7-20f9-4914-a9ab-f498817a7d35';
	
	const ADMIN_API_KEY = 'aeb01634-58ef-445f-9e6e-35fe4bdc7a8b';
	/**
	 * 
	 * @param string $sendersignature
	 * @return \Postmark\PostmarkClient
	 */
    public static function getPostmarkClient($sendersignature='m@mail.planmanager.be'){
		switch (true) {
			case strpos($sendersignature, '@mail.planmanager.be') !== false:
				return new PostmarkClient(self::API_KEY, 60);
			default:
				error_log('Unknown sender signature ' . $sendersignature);
			
		}
       
    }
	
	/**
	 * 
	 * @param string $apiUserOrKey
	 * @return \Postmark\PostmarkAdminClient
	 */
    public static function getPostmarkAdminClient(){
       return new PostmarkAdminClient(self::ADMIN_API_KEY);
    }
	/**
	 * 
	 * @return PostmarkClient
	 */
    public static function getEmail(){
        return new PostmarkClient;
    } 
	
	/**
	 * 
	 * @param string $path
	 * @param string $name
	 * @return \Postmark\Models\PostmarkAttachment
	 */
	public static function getAttachmentFromPath($path, $name, $mimetype=null) {		
		return \Postmark\Models\PostmarkAttachment::fromFile($path, $name, $mimetype);
	}
	
	/**
	 * 
	 * @param string $strTo
	 * @param string $strSubject
	 * @param string $strBody
	 * @param PostmarkAttachment $objAttachment
	 * @return \Postmark\Models\PostmarkAttachment
	 */
	public static function sendEmail($strTo, $strSubject, $strBody, $objAttachment = null) {
		$client		= self::getPostmarkClient();
		//Change sender signature to Hikify later, for now we'll use m@mail.planmanager.be

		$request	= $client->sendEmail('m@mail.planmanager.be', $strTo, $strSubject, $strBody, null, null, null, null, null, null, null, $objAttachment);
		
		return $request;
	}
	
	public static function IsValidEmailAddress($strEmail) {
		return true;
		if(strpos($strEmail, ' ')) {
			return true;
		}
		if(!strpos($strEmail, '@') || !strpos($strEmail, '.')) { //geen . of geen @ => geen geldig e-mail adres
			return false;
		}
		
		if(in_array($strEmail, array('mail@sans.be','geen@mail.be'))) { ////known invalid e-mail addresses that people insist on using.
			return false;
		}
		
		$host = explode('@', $strEmail);
		if($host && isset($host[1]) && count(dns_get_record($host[1],DNS_MX))) { //check of domein een mx record heeft
			return true;
		} else {
			return false;
		}		
	}
}
