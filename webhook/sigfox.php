<?php
class SigfoxParser {
		
	public static function processInput() {
		self::requireqcubed();

		Log::MakeEntry("SIGFOX1", "Connecting");
		
		$_SESSION['USER'] = 1;
		$rawdata					= file_get_contents('php://input');
		Log::MakeEntry("SIGFOX2", $rawdata);
		Log::MakeEntry("SIGFOX3", print_r($_POST,true));

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
		if(!isset($_POST['device'])) {
			Log::MakeEntry("SIGFOX4", "post variable device not found");
			return;
		}
		$device = \Device::querySingle(QCubed\Query\QQ::equal(QQN::device()->Serial, $_POST['device']));
		if(!$device) {
			Log::MakeEntry("SIGFOX5", "device " . $_POST['device'] . ' not found');
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
			Log::MakeEntry("SIGFOX6", "unexpected data " . $_POST['data']);
		}
	}
	
	private static function requireqcubed(){
		//require_once '../qcubed/includes/prepend.inc.php';
		require('../project/includes/configuration/prepend.inc.php');
	}
}
SigfoxParser::processInput();