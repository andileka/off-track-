<?php
	require(QCUBED_PROJECT_MODEL_GEN_DIR . '/TouristGen.php');

	/**
	 * The Tourist class defined here contains any
	 * customized code for the Tourist class in the
	 * Object Relational Model.  It represents the "tourist" table
	 * in the database, and extends from the code generated abstract TouristGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * @package My QCubed Application
	 * @subpackage Model
	 *
	 */
	class Tourist extends TouristGen {
		//ENUM('safe', 'requested help', 'acknowledged help request', 'rescue on the way')
		const SAFE						='safe';
		const REQUESTED_HELP			='requested_help';
		const ACKNOWLEDGE_HELP_REQUEST	='acknowledged_help_request';
		const RESCUE_ON_THE_WAY			='rescue_on_the_way';
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return $this->Name;
		}

		/**
		 *
		 * @param \QCubed\Project\Control\ControlBase $objParentObject
		 * @param string $strControlId
		 * @return \QCubed\Project\Control\ListBox
		 */
		public static function GetListBox($objParentObject, $strControlId=null) {
			$arrCities				= Tourist::LoadAll(\QCubed\Query\QQ::OrderBy(QQN::tourist()->Name));
			$listbox				= new \QCubed\Project\Control\ListBox($objParentObject, $strControlId);

			foreach($arrCities as $objTourist) {
				$listbox->AddItem((string)$objTourist, $objTourist->Id, true);
			}
			return $listbox;
		}

		/**
		 *
		 * @param \QCubed\Project\Control\ControlBase $objParentObject
		 * @param string $strControlId
		 * @return \QCubed\Project\Control\ListBox
		 */
		public static function GetNicknameListBox($objParentObject, $strControlId=null) {
			$arrAnimals				= array('Kangaroo', 'Koala', 'Rat', 'Badger', 'Pelican', 'Snail', 'Lion');
			sort($arrAnimals);

			$listbox				= new \QCubed\Project\Control\ListBox($objParentObject, $strControlId);

			foreach($arrAnimals as $strAnimal) {
				$listbox->AddItem(ucfirst($strAnimal), $strAnimal);
			}
			return $listbox;
		}

		/**
		 *
		 * @param \QCubed\Project\Control\ControlBase $objParentObject
		 * @param string $strControlId
		 * @return \QCubed\Project\Control\ListBox
		 */
		public static function GetStatusListBox($objParentObject, $strControlId=null) {
			$arrStatus				= array(self::SAFE,self::REQUESTED_HELP,self::ACKNOWLEDGE_HELP_REQUEST,self::RESCUE_ON_THE_WAY);

			$listbox				= new \QCubed\Project\Control\ListBox($objParentObject, $strControlId);

			foreach($arrStatus as $strStatus) {
				$listitem = new QCubed\Control\ListItem(ucfirst($strStatus), $strStatus);
				$listbox->addItem($listitem);
			}
			return $listbox;
		}


		public function save($blnForceInsert = false, $blnForceUpdate = false) {
			if(!$this->Status) {
				$this->Status = self::SAFE;
			}
			return parent::save($blnForceInsert, $blnForceUpdate);
		}
		public function MoveTo($lat, $long, QCubed\QDateTime $datetime=null) {
			$devicetourist = DeviceTourist::loadArrayByTouristId($this->Id);
			if(!count($devicetourist)) {
				return;
			}
			
			$event = \Event::CreateForDeviceId($devicetourist[0]->DeviceId, 'location check in',$lat, $long, $datetime);

			$this->SaveCurrentPosition($event->Position);
		}

		public function SaveCurrentPosition(Position $objPosition) {
			$this->Position = $objPosition;
			$this->Save();
		}
	}
