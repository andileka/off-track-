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
			return 'Tourist Object ' . $this->PrimaryKey();
		}


		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of Tourist objects
			return Tourist::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::Tourist()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Tourist()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single Tourist object
			return Tourist::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Tourist()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Tourist()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of Tourist objects
			return Tourist::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::Tourist()->Param1, $strParam1),
					QQ::Equal(QQN::Tourist()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using QCubed Query)

			// Get the Database Object for this Class
			$objDatabase = Tourist::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`tourist`.*
				FROM
					`tourist` AS `tourist`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return Tourist::InstantiateDbResult($objDbResult);
		}
*/



		// Override or Create New Properties and Variables
		// For performance reasons, these variables and __set and __get override methods
		// are commented out.  But if you wish to implement or override any
		// of the data generated properties, please feel free to uncomment them.
/*
		protected $strSomeNewProperty;

		public function __get($strName) {
			switch ($strName) {
				case 'SomeNewProperty': return $this->strSomeNewProperty;

				default:
					try {
						return parent::__get($strName);
					} catch (Caller $objExc) {
						$objExc->incrementOffset();
						throw $objExc;
					}
			}
		}

		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'SomeNewProperty':
					try {
						return ($this->strSomeNewProperty = \QCubed\Type::Cast($mixValue, \QCubed\Type::String));
					} catch (QInvalidCastException $objExc) {
						$objExc->incrementOffset();
						throw $objExc;
					}

				default:
					try {
						return (parent::__set($strName, $mixValue));
					} catch (Caller $objExc) {
						$objExc->incrementOffset();
						throw $objExc;
					}
			}
		}
*/


		
/*
		public function Initialize()
		{
			parent::Initialize();
			// You additional initializations here
		}
*/
	}
