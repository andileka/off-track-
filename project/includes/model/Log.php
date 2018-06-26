<?php
	require(QCUBED_PROJECT_MODEL_GEN_DIR . '/LogGen.php');

	/**
	 * The Log class defined here contains any
	 * customized code for the Log class in the
	 * Object Relational Model.  It represents the "log" table
	 * in the database, and extends from the code generated abstract LogGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * @package My QCubed Application
	 * @subpackage Model
	 *
	 */
	class Log extends LogGen {
		public static function MakeEntry($action, $value) {
			$log = new Log();
			$log->Action = $action;
			$log->Value	= $value;
			$log->Datetime = \QCubed\QDateTime::now();
			$log->save();
			
		}

		public function __toString() {
			return 'nothing';
		}
	}
