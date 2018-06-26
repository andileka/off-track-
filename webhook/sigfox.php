<?php
class SigfoxParser {
		
	public static function processInput() {
		self::requireqcubed();
		Log::MakeEntry("SIGFOX", "connecting");

		$_SESSION['USER'] = 1;		
		Log::MakeEntry("SIGFOX", print_r($_POST,true));

		/*
		 * Array
(
    [device] => {device}
    [time] => {time}
    [data] => {data}
    [lat] => {lat}
    [long] => {lng}
    [Sequence_Number] => {seqNumber}
)

		 */
		$device = \Device::querySingle(QCubed\Query\QQ::equal(QQN::device()->Serial, $_POST['device']));
		if(!$device) {
			Log::MakeEntry("SIGFOX", "device " . $_POST['device'] . ' not found');
			return;
		}





		
		if($_POST['data']=="12") {
			$devicetourist = DeviceTourist::loadArrayByDeviceId($device->Id, QCubed\Query\QQ::expand(QQN::deviceTourist()->Tourist));
			if(!count($devicetourist)) {
				return;
			}

			$event = \Event::CreateForDeviceId($device->Id, "button pressed", $_POST['lat'], $_POST['long']);
			$devicetourist[0]->Tourist->SaveCurrentPosition($event->Position);
			
			
		} else {
			Log::MakeEntry("SIGFOX", "unexpected data " . $_POST['data']);
		}
	}
	
	private static function requireqcubed(){
		//require_once '../qcubed/includes/prepend.inc.php';
		require('../project/includes/configuration/prepend.inc.php');
	}
}
SigfoxParser::processInput();