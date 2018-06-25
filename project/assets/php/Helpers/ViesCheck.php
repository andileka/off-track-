<?php

namespace Hikify\Helpers;

use DragonBe\Vies\Vies;
use DragonBe\Vies\ViesException;
use DragonBe\Vies\ViesServiceException;

/**
 * Class ViesCheck
 *
 * @package QCubed\Project\Control
 * @was Vies
 */
class ViesCheck {

	public $ViesResult;
	/**
	 * 
	 * @param string $strCountryCode
	 * @param string $strVatNumber
	 */
	public static function GetViesData($strCountryCode="BE", $strVatNumber){
		$Vies = new Vies();
		/* CHECK IF SERVICE IS ACTIVE */
		self::CheckHeartBeat($Vies);
		
		try {
				
                $result = $Vies->validateVat($strCountryCode, $strVatNumber);
				if(!$result->isValid()){echo "Number not valid";exit;}
				
				$ViesResult						= new \phpDocumentor\Reflection\Types\Object_();
				$ViesResult->Name				= $result->getName();
				$ViesResult->Address			= $result->getAddress();
				$ViesResult->Country			= $result->getCountryCode();
				$ViesResult->Vatnumber			= $result->getVatNumber();
				$ViesResult->Valid				= $result->isValid();
				
				$GetCity = self::GetArrayCityAddress($result->getAddress(),$result->getCountryCode());
				$ViesResult->City				= $GetCity["City"];
				$ViesResult->Street				= $GetCity["Street"];
				
				return $ViesResult;
				
            } catch (ViesServiceException $e) {                         // - Recoverable exception.
                echo $e->getMessage();                                  //   There is probably a temporary problem with back-end VIES service.
            } catch (ViesException $e) {                                // - Unrecoverable exception.
                echo $e->getMessage();                                  //   Invalid country code etc.
            }

//            echo PHP_EOL;
		
		
	}
	public static function GetArrayCityAddress($strCity, $strCountryCode){
		$arr = [];
		/* GET CITY REGEX */
		$regex = "/\d+\s(.*)/";
		/* GET ADDRESS REGEX */
		/* STREET SPACE NUMBER */
		$regexStreet = "/(.*)\s\d+/";
		switch($strCountryCode){
			case "NL":
				/* CITYZIP HAS TEXT */
				$regex = "/\s\d+\w\s(.*)/";
			break;
		}
		
		preg_match($regexStreet,$strCity, $Cities);
		if(!$Cities){return;}
//		
		$arr['Street'] = $Cities[1];
		$arr['City'] = str_replace($arr['Street'],'',$strCity);
		
		return $arr;
		
	}
	public static function CheckHeartBeat($Vies){
		if (false === $Vies->getHeartBeat()->isAlive()) {
			echo "Vies API Not available";
			exit;
		}
	}

}
