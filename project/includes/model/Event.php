<?php
	require(QCUBED_PROJECT_MODEL_GEN_DIR . '/EventGen.php');

	/**
	 * The Event class defined here contains any
	 * customized code for the Event class in the
	 * Object Relational Model.  It represents the "event" table
	 * in the database, and extends from the code generated abstract EventGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * @package My QCubed Application
	 * @subpackage Model
	 *
	 */
	class Event extends EventGen {
		const LOCATIONCHECKIN		= "location check in";
		const BUTTONPRESS			= "button pressed";
		const FALL					= "fall detected";

		const STATUS_TOBESEEN		= 'to be seen';
		const STATUS_SEENBYADMIN	= 'seen by admin';
		const STATUS_ACTIONTAKEN	= 'action taken';
		const STATUS_ALLOK			= 'all ok';
		const STATUS_NOTAPPLICABLE	= 'not applicable';

		const SIGFOX_EVENT_BUTTON	= 12;
		const SIGFOX_EVENT_FALL		= 00;
		const SIGFOX_EVENT_CHECKIN	= 01;
		
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return $this->Datetime->format('Y-m-d H:i') . ' ' . $this->Type;
		}

		public function save($blnForceInsert = false, $blnForceUpdate = false) {
			if(is_null($this->Datetime)) {
				$this->Datetime	= QCubed\QDateTime::now();
			}
			
  			return parent::save($blnForceInsert, $blnForceUpdate);
		}
		/**
		 *
		 * @param int $intDeviceId
		 * @param string $type
		 * @param float $lat
		 * @param float $long
		 * @return \Event
		 */
		public static function CreateForDeviceId($intDeviceId, $type, $lat, $long, $datetime=null) {
			$event				= new Event();
			$event->DeviceId	= $intDeviceId;
			$event->Position	= Position::Create($lat, $long);
			$event->Type		= $type;
			if($datetime) {
				$event->Datetime = $datetime;
			}
			$event->save();
			return $event;
		}
	}
