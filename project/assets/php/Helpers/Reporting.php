<?php

namespace Hikify\Helpers;

use TxTextControl\ReportingCloud\ReportingCloud;

/**
 * Class Reporting
 *
 * @package QCubed\Project\Control
 * @was Reporting
 */
class Reporting {

	private $reportingCloud;
	private $arrTags = array();
	/**
	 *
	 * Credentials reporting.cloud
	 */
	private static $username = 'domienj@gmail.com';
	private static $password = '5uPP0rt!';
	
	public static function GetShareDocument($strTemplateName) {
		$requestUrl = "https://api.reporting.cloud/v1/document/share?templateName=".$strTemplateName;
		$auth = base64_encode(self::$username.':'.self::$password);
		// Base cURL option
		$curlOpt = array();
		$curlOpt[CURLOPT_URL] = $requestUrl;
		$curlOpt[CURLOPT_RETURNTRANSFER] = TRUE;
		$curlOpt[CURLOPT_SSL_VERIFYPEER] = TRUE;
		$curlOpt[CURLOPT_HEADER] = false;
		$curlOpt[CURLOPT_ACCEPT_ENCODING] = true;
			
		$curlOpt[CURLOPT_HTTPHEADER] = array(
			    "Authorization: Basic ".$auth,
				"Cache-Control: no-cache"			
			);
		
		$curlHandle = curl_init();
		curl_setopt_array($curlHandle, $curlOpt);
		return curl_exec($curlHandle);

	}

	public static function GetTemplatesListbox($objParent) {

		$reportingCloud = self::Connect();

		$listbox = new \QCubed\Project\Control\ListBox($objParent);
		$listbox->SelectionMode	= 'Multiple';
		$listbox->Name = tr('Templates');
		$listbox->AddItem(tr('Select template'), null);

		foreach ($reportingCloud->getTemplateList() as $arrTemplate) {
			$listbox->AddItem($arrTemplate['template_name'], $arrTemplate['template_name']);
		}

		return $listbox;
	}
	
	public static function GetTemplatesList() {

		$reportingCloud = self::Connect();
		$arrTemplateList = array();

		foreach ($reportingCloud->getTemplateList() as $arrTemplate) {
			$arrTemplateList[] = $arrTemplate['template_name'];
		}
		
		return $arrTemplateList;
	}
	
	public static function DeleteTemplate($strTemplateName) {
		$reportingCloud = self::Connect();
		$reportingCloud->deleteTemplate($strTemplateName);
	}

	public static function MergeReportData($strTemplateName,$arrTags) {
		$mergeSettings = [
		  'creation_date'              => time(),
		  'last_modification_date'     => time(),
		  'remove_empty_images'        => true,
		  ];
		
		$binaryData	= self::Connect()->mergeDocument($arrTags, 'PDF', $strTemplateName, null, false, $mergeSettings);
		$destinationFile = sprintf(explode(".",$strTemplateName)[0].'_%d.pdf', date('YmdHi'));
		$destinationFilename = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $destinationFile;
		\QCubed\Project\Application::Log(sys_get_temp_dir() . DIRECTORY_SEPARATOR . $destinationFile);
		file_put_contents($destinationFilename, $binaryData);
		
		return \Postmark\Models\PostmarkAttachment::fromRawData($binaryData[0], $destinationFile);
		
		//self::GetMergeableFields($strTemplateName);
	}
	
	public static function GetMergeableFields($strTemplateName, $arrTags){
		/* Get all mergeable fields for templatename in ReportingCloud */
		return self::FillMergeableFields((self::Connect()->getTemplateInfo($strTemplateName)), $arrTags, $strTemplateName);
	} 
	
	public static function FillMergeableFields($arrFields,$arrTags,$strTemplateName){
		foreach($arrFields['merge_fields'] as $field){
			$ArrMergedFields[$field['name']] = $arrTags[$field['name']]; 
			//\QCubed\Project\Application::Log(json_encode($field['name']));
		}
		return self::MergeReportData($strTemplateName,$ArrMergedFields);
	}
	/**
	 * 
	 * @param type $file path tmp file
	 */
	public static function UploadFileToCloud($file, $name){
		self::Connect()->uploadTemplateFromBase64(base64_encode(file_get_contents($file)), $name);
	}

	private static function Connect() {
		$reportingCloud = new ReportingCloud([
			'username' => self::$username,
			'password' => self::$password,
		]);

		return $reportingCloud;
	}

}
