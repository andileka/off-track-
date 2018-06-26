<?php
	require(QCUBED_PROJECT_MODEL_GEN_DIR . '/DeviceGen.php');

	/**
	 * The Device class defined here contains any
	 * customized code for the Device class in the
	 * Object Relational Model.  It represents the "device" table
	 * in the database, and extends from the code generated abstract DeviceGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * @package My QCubed Application
	 * @subpackage Model
	 *
	 */
	class Device extends DeviceGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return $this->Serial;
		}


	}
