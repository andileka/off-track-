<?php
namespace Hikify\Helpers;
class Sms {
	const ENDPOINT	= 'https://smsapi.insypro.com/server.php?wsdl';

    public function  __construct() {

    }

	public static function CleanupSmsText($original_text) {
		/*$unsupported = array('&nbsp;' => '', '€' => 'EUR ', '£' => 'GBP ', //according to callr, the pound is in the spec, so we dont need to replace it
				'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
				'É' => 'E', 'È' => 'E', 'Ë' => 'E', 'Ê' => 'E',
				'á' => 'a', 'à' => 'a', 'â' => 'a', 'ä' => 'a',
				'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ä' => 'A',
				'&' => ' ', "\n\n" => "\n");*/
		$unsupported = array(
			'  '		=> ' ',//double space, replace by single
			'&nbsp;'	=> '', //weird html tag, strip it out
			"\n\n"		=> "\n",//double enters, remove them.
			'&'			=> ' ', //probably only a problem for spryng or our local phones ?
			
			//below is a replacement array from callr (callr does the replacement automatically). This converts everything to the GSM_03.38 spec: https://en.wikipedia.org/wiki/GSM_03.38.
			'À'=>'A',
			'Á'=>'A',
			'Â'=>'A',
			'Ã'=>'A',
			'È'=>'E',
			'Ê'=>'E',
			'Ë'=>'E',
			'Ì'=>'I',
			'Í'=>'I',
			'Î'=>'I',
			'Ï'=>'I',
			'Ð'=>'D',
			'Ò'=>'O',
			'Ó'=>'O',
			'Ô'=>'O',
			'Õ'=>'O',
			'Ù'=>'U',
			'Ú'=>'U',
			'Û'=>'U',
			'Ý'=>'Y',
			'Ÿ'=>'Y',
			'á'=>'a',
			'â'=>'a',
			'ã'=>'a',
			'ê'=>'e',
			'ë'=>'e',
			'í'=>'i',
			'î'=>'i',
			'ï'=>'i',
			'ð'=>'o',
			'ó'=>'o',
			'ô'=>'o',
			'õ'=>'o',
			'ú'=>'u',
			'û'=>'u',
			'µ'=>'u',
			'ý'=>'y',
			'ÿ'=>'y',
			'ç'=>'c',
			'Þ'=>'y',
			'°'=>'o',
			'˚'=>'o',
			'⁰'=>'o',
			'∘'=>'o',
			'¨'=>'-',
			'^'=>'-',
			'«'=>'"',
			'≪'=>'"',
			'《'=>'"',
			'»'=>'"',
			'≫'=>'"',
			'》'=>'"',
			'|'=>'I',
			'ǀ'=>'I',
			'∣'=>'I',
			'❘'=>'I',
			'\\'=>'/',
			'‚'=>',',
			'،'=>',',
			'⸲'=>',',
			'⹁'=>',',
			'、'=>',',
			'，'=>',',
			'„'=>',',
			'…'=>'.',
			'‘'=>'\'',
			'“'=>'"',
			'”'=>'"',
			'•'=>'.',
			'‐'=>'-',
			'‑'=>'-',
			'‒'=>'-',
			'–'=>'-',
			'—'=>'-',
			'⁃'=>'-',
			'−'=>'-',
			'´'=>'\'',
			'′'=>'\'',
			'`'=>'\'',
			'‵'=>'\'',
			'€'=>'e',
			'’'=>'\'',
			'ʼ'=>'\'',
			' '=>' ',
			'['=>'(',
			']'=>')',
			'{'=>'(',
			'}'=>')',
		);

		return trim(str_replace(array_keys($unsupported), array_values($unsupported), strip_tags($original_text)), "\n"); //don't display html crap in sms
	}

	/**
	 * This will fire an async request to the virtual phone, this will cause the sms to get picked up immediately. But it won't wait for a response.
	 */
	public static function asyncVirtualPhone() {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,				'https://smsapi.insypro.com/virtualphone.php');
		curl_setopt($curl, CURLOPT_FAILONERROR,		false);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION,	true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,	false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,	false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,	false);
		curl_setopt($curl, CURLOPT_TIMEOUT_MS,		100);

		curl_exec($curl);
	}
	
    public static function sendSMS($to,$text, $reference, $dttSendDateTime) {
		$objServerClient	= @new \SoapClient(self::ENDPOINT, array( 'exceptions' => true,'trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE  ));
		//clone the date to avoid changing it outside this function, remove the timezone if we have one
		$dttSendDateTime	= clone $dttSendDateTime;
		$data				= $objServerClient->Send('planmanager','planmanagerdefaultpass',$to,$text, $reference,$dttSendDateTime->format("Y-m-d\TH:i:s"));

		self::asyncVirtualPhone();
		return true;
	}

}
