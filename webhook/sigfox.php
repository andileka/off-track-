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



		Log::MakeEntry("SIGFOX6", "device toursist lookup" . $device->Id);
		$devicetourist = \DeviceTourist::loadArrayByDeviceId($device->Id, QCubed\Query\QQ::expand(QQN::deviceTourist()->Tourist));
		if(!count($devicetourist)) {
			Log::MakeEntry("SIGFOX7", "device toursist lookup " . $device->Id . 'NOT FOUND');
			return;
		}
		$objTourist = $devicetourist[0]->Tourist;
		Log::MakeEntry("SIGFOX8", "Tourist found " . $objTourist);
		$intEvent = (int)$_POST['data'];
		Log::MakeEntry("SIGFOX9", "Event " . $intEvent);
		switch($intEvent) {
			case \Event::SIGFOX_EVENT_BUTTON_SINGLE:
			case \Event::SIGFOX_EVENT_BUTTON:
				Log::MakeEntry("SIGFOX_10", "BUTTON");
				$event = \Event::CreateForDeviceId($device->Id, \Event::BUTTONPRESS, $_POST['lat'], $_POST['long']);
				$objTourist->Status = Tourist::REQUESTED_HELP;
				$objTourist->Save();
				\Hikify\Helpers\Sms::sendSMS('+32473833715', 'Someone is in trouble, please send help!', 9999, \QCubed\QDateTime::now());
				//$objTourist->SaveCurrentPosition($event->Position);
				break;
			case \Event::SIGFOX_EVENT_FALL:
				Log::MakeEntry("SIGFOX_11", "BUTTON");
				$event = \Event::CreateForDeviceId($device->Id, \Event::FALL, $_POST['lat'], $_POST['long']);
				$objTourist->Status = Tourist::REQUESTED_HELP;
				$objTourist->Save();
				\Hikify\Helpers\Sms::sendSMS('+32473833715', 'Someone is in trouble, please send help!', 9999, \QCubed\QDateTime::now());
				//$objTourist->SaveCurrentPosition($event->Position);
				break;
			case \Event::SIGFOX_EVENT_CHECKIN:
				/*Log::MakeEntry("SIGFOX_12", "BUTTON");
				$event = \Event::CreateForDeviceId($device->Id, \Event::LOCATIONCHECKIN, $_POST['lat'], $_POST['long']);
				$objTourist->SaveCurrentPosition($event->Position);*/
				break;
			default:
				Log::MakeEntry("SIGFOX6", "unexpected data " . $intEvent);
				break;
		}
		Log::MakeEntry("SIGFOX_DONE", "DONE");
	}
	
	private static function requireqcubed(){
		//require_once '../qcubed/includes/prepend.inc.php';
		require('../project/includes/configuration/prepend.inc.php');
	}
}
SigfoxParser::processInput();