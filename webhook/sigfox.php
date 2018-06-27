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




		$devicetourist = \DeviceTourist::loadArrayByDeviceId($device->Id, QCubed\Query\QQ::expand(QQN::deviceTourist()->Tourist));
		if(!count($devicetourist)) {
			return;
		}
		$objTourist = $devicetourist[0]->Tourist;

		switch($_POST['data']) {
			case \Event::SIGFOX_EVENT_BUTTON:
				$event = \Event::CreateForDeviceId($device->Id, \Event::BUTTONPRESS, $_POST['lat'], $_POST['long']);
				$objTourist->Status = Tourist::REQUESTED_HELP;
				//$objTourist->SaveCurrentPosition($event->Position);
				break;
			case \Event::SIGFOX_EVENT_FALL:
				$event = \Event::CreateForDeviceId($device->Id, \Event::FALL, $_POST['lat'], $_POST['long']);
				$objTourist->Status = Tourist::REQUESTED_HELP;
				//$objTourist->SaveCurrentPosition($event->Position);
				break;
			case \Event::SIGFOX_EVENT_CHECKIN:
				$event = \Event::CreateForDeviceId($device->Id, \Event::LOCATIONCHECKIN, $_POST['lat'], $_POST['long']);
				$objTourist->SaveCurrentPosition($event->Position);
				break;
			default:
				Log::MakeEntry("SIGFOX6", "unexpected data " . $_POST['data']);
				break;
		}
	}
	
	private static function requireqcubed(){
		//require_once '../qcubed/includes/prepend.inc.php';
		require('../project/includes/configuration/prepend.inc.php');
	}
}
SigfoxParser::processInput();