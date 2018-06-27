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
