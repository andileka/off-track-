<?php
	require(QCUBED_PROJECT_MODEL_GEN_DIR . '/CountryGen.php');

	/**
	 * The Country class defined here contains any
	 * customized code for the Country class in the
	 * Object Relational Model.  It represents the "country" table
	 * in the database, and extends from the code generated abstract CountryGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * @package My QCubed Application
	 * @subpackage Model
	 *
	 */
	class Country extends CountryGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return $this->NameEn;
		}


		/**
		 *
		 * @param \QCubed\Project\Control\ControlBase $objParentObject
		 * @param string $strControlId
		 * @return \QCubed\Project\Control\ListBox
		 */
		public static function GetListBox($objParentObject, $strControlId=null) {
			$arrCities				= Country::LoadAll(\QCubed\Query\QQ::OrderBy(QQN::country()->NameEn));
			$listbox				= new \QCubed\Project\Control\ListBox($objParentObject, $strControlId);
			$listbox->AddItem(tr('Select a country'), null);
			foreach($arrCities as $objCountry) {
				$listbox->AddItem((string)$objCountry, $objCountry->Id);
			}
			return $listbox;
		}
	}
