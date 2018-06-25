<?php

namespace Hikify\Helpers;

class Convert {
	public static function removeZeroFromCellPhoneNumber($number){
		return preg_replace('/^0+/', '', $number);
	}
	
	public final static function StartsWithSubString($strString, $strStartsWith) {
			$lenStartsWith	= strlen($strStartsWith);
			if($lenStartsWith > 0) {
				$lenString	= strlen($strString);
				return ($lenString >= $lenStartsWith && substr($strString, 0, $lenStartsWith) === $strStartsWith);
			} else {
				return false;
			}
		}
	
	

	public static function capture_phonenumbers($full_string, \Country $objCountry = null) {
		
			// remove optional data, whitespaces
			$full_string = preg_replace(array("/ \(.*?\)/", "/\s*[;,]\s*/"), array("", ";"), $full_string);

			$caps = array(
				'addr' => array(),
				'fail' => array()
			);

			foreach (explode(';', $full_string) as $originalNr) {
				$number = preg_replace('/[^0-9]+/', '', $originalNr);
				if($number) {
					if(strlen($number)<= 2) {
						continue;//skip this number
					}
					if (strlen($number) <= 11 && !self::StartsWithSubString($originalNr, '+') && self::StartsWithSubString($number, '0') && !self::StartsWithSubString($number, '00')) {
						$number = self::removeZeroFromCellPhoneNumber($number);					
						$number = \Country::GetPhoneCode($objCountry) . $number;					
					}

					$number			= self::removeZeroFromCellPhoneNumber($number);
					$caps['addr'] = $number;
				} else {
					$caps['fail'] = $originalNr;
				}
			}
			return $caps['addr'];
		}
		
	/**
	 * This should convert numbers that are stored in the database to a human readable format
	 *
	 * @param string $strOriginalNumber
	 * @return string
	 */
	public static function toHumanReadablePhoneNumber($strOriginalNumber) {
		/*
		http://www.phpliveregex.com/ is quite handy to test regexes
		 *
		 */
		$regexes = array(
			//uk
			"/(44)(1[0-9]{3})([0-9]{5}|[0-9]{6})/"				=> '+$1 $2 $3',
			"/(44)(11[0-9])([0-9]{3})([0-9]{4})/"				=> '+$1 $2 $3',
			"/(44)(1[0-9]1)([0-9]{3})([0-9]{4})/"				=> '+$1 $2 $3',
			"/(44)(1[0-9]{4})([0-9]{4}|[0-9]{5})/"				=> '+$1 $2 $3',

			"/(44)(2[0-9])([0-9]{4})([0-9]{4})/"				=> '+$1 $2 $3 $4',

			"/(44)(3[0-9]{2})([0-9]{3})([0-9]{4})/"				=> '+$1 $2 $3 $4',
			"/(44)(5|7)([0-9]{3})([0-9]{6})/"					=> '+$1 $2 $3 $4',
			"/(44)(800)([0-9]{6})/"								=> '+$1 $2 $3',
			"/(44)(8|9[0-9]{2})([0-9]{3})([0-9]{4})/"			=> '+$1 $2 $3 $4',

			//belgium
			"/(32)(4[0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/"	=> "+$1 $2/$3.$4.$5",//mobile 473 83 37 15		
			"/(32)(8|90[0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/"=> "+$1 $2$3 $4 $5",	// 0800  xx xxx 
			"/(32)(9|90[0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/"=> "+$1 $2$3 $4 $5",	// 090x  xx xxx 
			"/(32)(70)([0-9]{3})([0-9]{3})/"					=> "+$1 $2/$3.$4",
			"/(32)(78)([0-9]{6})([0-9]{3})/"					=> "+$1 $2/$3.$4",//070 344 344

			"/(32)(2|3|4|9)([0-9]{3})([0-9]{2})([0-9]{2})/"		=> "+$1 $2/$3.$4.$5",
			"/(32)([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/"	=> "+$1 $2/$3.$4.$5",
			"/(32)([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/"	=> "+$1 $2/$3.$4.$5",
			
			//the netherlands
			"/(31)(0800)([0-9]{4})/"							=> "+$1 $2 $3",//mobile 0800
			"/(31)(6)([0-9]{4})([0-9]{4})/"						=> "+$1 $2 $3 $4",//mobile 06 xxxx xxxx...
			"/(31)([0-9]{2})([0-9]{3})([0-9]{4})/"				=> "+$1 $2 $3 $4",//mobile 06 ...
		);
		/*
		https://en.wikipedia.org/wiki/Telephone_numbers_in_the_United_Kingdom#Format
		http://www.area-codes.org.uk/formatting.php
		*/

		return preg_replace(array_keys($regexes), array_values($regexes), $strOriginalNumber);

	}

	
}