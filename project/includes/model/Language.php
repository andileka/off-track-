<?php
	require(QCUBED_PROJECT_MODEL_GEN_DIR . '/LanguageGen.php');

	/**
	 * The Language class defined here contains any
	 * customized code for the Language class in the
	 * Object Relational Model.  It represents the "language" table
	 * in the database, and extends from the code generated abstract LanguageGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * @package My QCubed Application
	 * @subpackage Model
	 *
	 */
	class Language extends LanguageGen {
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
			$arrCities				= Language::LoadAll(\QCubed\Query\QQ::OrderBy(QQN::language()->Name));
			$listbox				= new \QCubed\Project\Control\ListBox($objParentObject, $strControlId);
			$listbox->AddItem(tr('Select a language'), null);
			foreach($arrCities as $objLanguage) {
				$listbox->AddItem((string)$objLanguage, $objLanguage->Id);
			}
			return $listbox;
		}
	}
