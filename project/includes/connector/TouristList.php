<?php
	require(QCUBED_PROJECT_MODELCONNECTOR_GEN_DIR . '/TouristListGen.php');

	/**
	 * This is the connector class for the List functionality
	 * of the Tourist class.  This class extends
	 * from the generated TouristGen class, which lists a collection
	 * of Tourist objects from the database.
	 *
	 * This file is intended to be modified. In this file, you can override the functions in the
	 * TouristGen class, and implement new functionality as need.
	 * Subsequent code regenerations will NOT modify or overwrite this file.
	 *
	 * @package My QCubed Application
	 * @subpackage ModelConnector
	 *
	 */
	class TouristList extends TouristListGen {

		/**
		* Creates the columns for the table. Override to customize, or use the ModelConnectorEditor to turn on and off
		* individual columns. This is a public function and called by the parent control.
		*/
	   public function createColumns()
	   {
		   $this->colId = $this->createNodeColumn("Id", QQN::Tourist()->Id);
		   $this->colName = $this->createNodeColumn("Name", QQN::Tourist()->Name);
		   $this->colPassport = $this->createNodeColumn("Passport", QQN::Tourist()->Passport);
		   $this->colContactinfo = $this->createNodeColumn("Contactinfo", QQN::Tourist()->Contactinfo);
		   $this->colLanguage = $this->createNodeColumn("Language", QQN::Tourist()->Language);
		   $this->colCity = $this->createNodeColumn("City", QQN::Tourist()->City);
		   $this->colCountry = $this->createNodeColumn("Country", QQN::Tourist()->Country);

			

		}

		public function AddDeviceColumn() {
			$this->Clauses = QCubed\Query\QQ::clause(
					QCubed\Query\QQ::expand(QQN::tourist()->DeviceTourist),
					QCubed\Query\QQ::expand(QQN::tourist()->DeviceTourist->Device)
			);
			$this->createCallableColumn(tr("Device")			, [$this,'renderDevice'])->HtmlEntities = false;
		}

		public function renderDevice(Tourist $objTourist) {
			return (string)$objTourist->DeviceTourist->Device;
		}

	   
	}