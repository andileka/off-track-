<?php
namespace QCubed\Project\Control;
	class Mapbox extends \QCubed\Control\Panel{
		
		public $locations;
		
		/*
		 * Mapbox API Token
		 */
		
//		const TOKEN		= 'pk.eyJ1Ijoia3ZkdiIsImEiOiJjamMxb3EzZHYwMnp0MzBteDhhajNlZHg4In0.XW-KsA_JUK8BsRgV2XP2oQ';
		const TOKEN		= 'pk.eyJ1IjoibWF0dGhpYXoiLCJhIjoiY2ppdm5ldGRoMTI5czNqbnp1dmRuaDJqeiJ9.A70E7Lk08FqXowUqEU45Dw';
		const BASE_URL	= 'https://api.mapbox.com/';
				
		public function __construct($objParentControl) {
			parent::__construct($objParentControl);
			$this->AddCssClass("map");
			$this->AddJavascriptFile(__VIRTUAL_DIRECTORY__. "/project/assets/js/mapbox-gl.js");
			$this->AddCssFile(__VIRTUAL_DIRECTORY__."/project/assets/css/mapbox-gl.css");
			$this->AddJavascriptFile(__VIRTUAL_DIRECTORY__.'/project/assets/js/qmapbox.js');
			
			
			\QCubed\Project\Application::executeJavaScript("mapbox.init('$this->ControlId', '".self::TOKEN."')");
			
			
		}
		
		public static function GetRandomHexColor(){
			return str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
		}

		public function SetMapCenter($lat, $long) {
			\QCubed\Project\Application::executeJavaScript("mapbox.setMapCenter('$lat','$long')");
		}
		/**
		 * 
		 * @param QMapBoxCoordinate[] $arrCoordinates
		 */
		public function Draw($arrCoordinates, $arrProperties=null) {
			\QCubed\Project\Application::executeJavaScript("mapbox.DrawMap(".json_encode($arrCoordinates).','.json_encode($arrProperties).")");
		}
		/**
		 * 
		 * @param QMapBoxCoordinate[] $arrCoordinates
		 */
		public function DrawMapWithPins($arrCoordinates,$arrTourists) {
			\QCubed\Project\Application::executeJavaScript("$('#".$this->ControlId."_ctl').append('<nav id=menu></nav>')");
			\QCubed\Project\Application::executeJavaScript("mapbox.AddCoordinates(".json_encode($arrCoordinates).")");
			
			
			$x=0;
			$arrExpert;
			
			foreach($arrTourists as $objTourist){
				$arrExpert[$arrAppointments["Appointments"][$x]->Expert->User->Firstname][] = $arrAppointments["Appointments"][$x]->Place->Coordinates;
				$x++;
			}
			foreach($arrExpert as $expert => $coordinates){
				\QCubed\Project\Application::executeJavaScript("mapbox.AddLayer('".$expert."','".$this->GetRandomHexColor()."',".json_encode($coordinates).")");
			}
			/* HIERVOOR MOET ALLES GEBEUREN */
			\QCubed\Project\Application::executeJavaScript("mapbox.DrawMapWithPins()");
		}
		
		/**
		 * 
		 * @param Address[] $arrAddresses
		 * @param bool $blnRoundtrip
		 * @return Address[]
		 */
		public function OptimizeAddresses($arrAddresses, $blnRoundtrip=false) {
			$arrCoordinates					= array_map(function(\Address $objAddress) {
															return $objAddress->Coordinates;
														}, $arrAddresses);
			$arrWaypoints					= $this->GetOptimizedRoute($arrCoordinates, $blnRoundtrip);
			
			
			$arrSortedCoordinates = array();
			
			foreach(array_keys($arrWaypoints) as $key) {
				$arrSortedCoordinates[] = $arrAddresses[$key];
			}
			
			return $arrSortedCoordinates;
		}
		
		public function GetOptimizedCoordinates($arrLocations, $blnRoundtrip=false) {
			$arrGeocodes	= $this->GetGeoCodes($arrLocations);
			$arrWaypoints	= $this->GetOptimizedRoute($arrGeocodes, $blnRoundtrip);
			
			return $this->GetCoordinates($arrWaypoints);
		}
		
		/**
		 * 
		 * @param QMapBoxWaypoint[] $arrWaypoints
		 * @return type
		 */
		public function GetCoordinates($arrWaypoints){
			$arrCoordinates = array();
			foreach($arrWaypoints as $waypoint){
				$arrCoordinates[] = $waypoint->Location;
			}
			
			return ($arrCoordinates);
			
		}
		public function GetDirections($arrWaypoints){
			foreach($arrWaypoints as $row){
				$arrDirections[] = implode(',', $row->location);
			}
			$strDirections = implode(';', $arrDirections);
			return self::GetClientResponse('directions/v5/mapbox/driving/'.$strDirections.'.json',array('geometries'=>'geojson'));
		}
		
		/**
		 * 
		 * @param MapBoxCoordinate[] $arrCoordinates or array of string of coordinates
		 * @param bool $blnRoundtrip
		 * 
		 * @return QMapBoxWaypoint[]
		 */
		public function GetOptimizedRoute($arrCoordinates, $blnRoundtrip=false,$blnSteps=true){
			if(count($arrCoordinates)<=2) {
				throw new \Exception('QMapBox::GetOptimizedRoute: I need at least 2 coordinates, '. count($arrCoordinates) . ' given.');
			}
			$response = self::GetClientResponse('optimized-trips/v1/mapbox/driving/'.implode(';', ($arrCoordinates) ),	array(	
																														'source'		=>'first',
																														'destination'	=>'last',
																														'steps'			=> ($blnSteps ? 'true' : 'false'), /* Get step by step coordinates */  
																														'roundtrip'		=>($blnRoundtrip ? 'true' : 'false'),
																													)
												);
												
			$_SERVER['DEBUG']['res'] = $response;
			return MapBoxWaypoint::CreateFromArray($response->waypoints);
		}
				
		public function GetGeoCodes($arrAddresses){
			foreach($arrAddresses as $strAddress){
				$response		= self::GetClientResponse('geocoding/v5/mapbox.places/'.$strAddress.'.json');
				$ArrGeoCodes[]	= MapBoxCoordinate::CreateFromLocationArray($response->features[0]->geometry->coordinates);		
			}
			
			return $ArrGeoCodes;		
		}
		
		public static function GetClientResponse($strAction, $arrParams=array()){
			$arrParams['access_token'] = self::TOKEN;
			
			$client = new \GuzzleHttp\Client();
			try {
				$res = $client->request('GET', self::BASE_URL . $strAction.'?' . http_build_query($arrParams));
				return json_decode($res->getBody());
			} catch (Exception $e) {	}	
		}
		
	}
	
	class MapBoxCoordinate implements \JsonSerializable {
		public $Latitude;
		public $Longitude;
		
		public function __construct($x, $y) {
			$this->Longitude	= $x;
			$this->Latitude		= $y;			
		}
		
		public function __get($strName) {
			switch($strName) {
				case 'Coordinates':
					return ($this->Longitude) . ",". ($this->Latitude);
			}
			return parent::__get($strName);
		}
		
		/* check __toString toegevoegd omdat anders de implode niet werkte*/
		public function __toString() {
			return $this->Coordinates;
		}
		
		public function jsonSerialize() {
			return $this->Coordinates;
		}
		
		public function isEqualTo(MapBoxCoordinate $secondCoordinate) {
			return ($secondCoordinate->Longitude == $this->Longitude && $secondCoordinate->Latitude == $this->Latitude);
		}
		/**
		 * 
		 * @param array $r two element array
		 * @return \QMapBoxCoordinate
		 */
		public static function CreateFromLocationArray($r) {
			list($x,$y) = $r;
			return new MapBoxCoordinate($x, $y);
		}
		
		/**
		 * 
		 * @param Address $objAddress
		 * @return QMapBoxCoordinate
		 */
		public static function CreateFromAddress(\Address $objAddress) {
			$strLocation	= $objAddress->Street . ' ' . $objAddress->Nr . ', ' . $objAddress->City->PostalCode . ' ' . $objAddress->City->Name;
			$response		= Mapbox::GetClientResponse('geocoding/v5/mapbox.places/'.$strLocation.'.json');
			
			return MapBoxCoordinate::CreateFromLocationArray($response->features[0]->geometry->coordinates);		
		}
	}
	
	
	
	/**
	 * @property-read string $Coordinates Description
	 */
	class MapBoxWaypoint implements \JsonSerializable {
		/**
		 *
		 * @var QMapBoxCoordinate 
		 */
		public $Location;
		public $Name;
		
		public function __construct($strName, MapBoxCoordinate $objLocation) {
			$this->Name			= $strName;
			$this->Location		= $objLocation;
		}
		
		public function __get($strName) {
			switch($strName) {
				case 'Coordinates':
					return (string)$this->Location;
			}
			return parent::__get($strName);
		}
		public function jsonSerialize() {
			/* check location toegevoegd */
			return ($this->Location->Latitude .',' .$this->Location->Longitude);
		}
		/**
		 * 
		 * @param stdClass waypoint
		 * @return \QMapBoxCoordinate
		 */
		public static function CreateFromStdclass($waypoint) {
			return new	MapBoxWaypoint(
							$waypoint->name, 
							MapBoxCoordinate::CreateFromLocationArray($waypoint->location)
						);
		}
		
		/**
		 * 
		 * @param array $arrWaypoints
		 * @return QMapBoxWaypoint[]
		 */
		public static function CreateFromArray(array $arrWaypoints) {
			uasort($arrWaypoints,	function ($a, $b){
										if ($a->waypoint_index == $b->waypoint_index) {
											return 0;
										}
										return ($a->waypoint_index < $b->waypoint_index) ? -1 : 1;
									}
			);	
									
			
			
			return	array_map(
						function($stdClass) {
							return MapBoxWaypoint::CreateFromStdclass($stdClass);
						}, 
						$arrWaypoints
					);
		}
	}
	
	