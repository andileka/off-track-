<?php
	require(QCUBED_PROJECT_MODEL_GEN_DIR . '/UserGen.php');

	/**
	 * The User class defined here contains any
	 * customized code for the User class in the
	 * Object Relational Model.  It represents the "user" table
	 * in the database, and extends from the code generated abstract UserGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * @package My QCubed Application
	 * @subpackage Model
	 *
	 */
	class User extends UserGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return 'User Object ' . $this->PrimaryKey();
		}


		/**
		 * Load a single User object,
		 * by Email Index(es)
		 * @param string $strEmail
		 * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
		 * @return User
		*/
		public static function loadByEmail($strEmail, $objOptionalClauses = null)
		{
			return User::QuerySingle(
					\QCubed\Query\QQ::Equal(QQN::User()->Email, $strEmail)
				,
				$objOptionalClauses
			);
		}
	}
