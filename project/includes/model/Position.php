<?php
	require(QCUBED_PROJECT_MODEL_GEN_DIR . '/PositionGen.php');

	/**
	 * The Position class defined here contains any
	 * customized code for the Position class in the
	 * Object Relational Model.  It represents the "position" table
	 * in the database, and extends from the code generated abstract PositionGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * @package My QCubed Application
	 * @subpackage Model
	 *
	 */
	class Position extends PositionGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return (string) ($this->Long . ','.$this->Lat); //mapbox reverses them
		}
		
		public static function Create($lat, $long, $height=null) {
			$position = new Position();
			$position->Lat = $lat;
			$position->Long = $long;
			$position->Height = $height;
			$position->save();
			return $position;
		}
	}
