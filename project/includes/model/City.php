<?php
	require(QCUBED_PROJECT_MODEL_GEN_DIR . '/CityGen.php');

	/**
	 * The City class defined here contains any
	 * customized code for the City class in the
	 * Object Relational Model.  It represents the "city" table
	 * in the database, and extends from the code generated abstract CityGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * @package My QCubed Application
	 * @subpackage Model
	 *
	 */
	class City extends CityGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return $this->PostalCode . ' ' . $this->Name ;
		}

		public static function FillByCountryId($objListbox, $intCountryId) {
			$objListbox->removeAllItems();
			
			$arrCities				= City::loadArrayByCountryId($intCountryId, \QCubed\Query\QQ::OrderBy(QQN::city()->Name));
			$objListbox->AddItem(tr('Select a city'), null);
			foreach($arrCities as $objCity) {
				$objListbox->AddItem((string)$objCity, $objCity->Id);
			}

		}
		/**
		 *
		 * @param \QCubed\Project\Control\ControlBase $objParentObject
		 * @param string $strControlId
		 * @return \QCubed\Project\Control\ListBox
		 */
		public static function GetListBox($objParentObject, $strControlId=null, $intCountryId=null) {
			$objListbox				= new \QCubed\Project\Control\ListBox($objParentObject, $strControlId);
			if(!$intCountryId) {
				return $objListbox;
			}

			self::FillByCountryId($objListbox, $intCountryId);

			return $objListbox;
		}
	}
