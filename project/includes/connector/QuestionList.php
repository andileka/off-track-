<?php

require(QCUBED_PROJECT_MODELCONNECTOR_GEN_DIR . '/QuestionListGen.php');

/**
 * This is the connector class for the List functionality
 * of the Question class.  This class extends
 * from the generated QuestionGen class, which lists a collection
 * of Question objects from the database.
 *
 * This file is intended to be modified. In this file, you can override the functions in the
 * QuestionGen class, and implement new functionality as need.
 * Subsequent code regenerations will NOT modify or overwrite this file.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 *
 */
class QuestionList extends QuestionListGen {
	public $intTouristId=1;
	/**
	 * Creates the columns for the table. Override to customize, or use the ModelConnectorEditor to turn on and off
	 * individual columns. This is a public function and called by the parent control.
	 */
	public function createColumns() {
		$this->createNodeColumn("Question", QQN::Question()->Question);
		$this->createCallableColumn(tr("Answer"), [$this, 'renderAnswer'])->HtmlEntities = false;
	}

	public function renderAnswer(Question $objQuestion) {
		$answer = TouristAnswer::querySingle(
						\QCubed\Query\QQ::andCondition(
								\QCubed\Query\QQ::equal(QQN::touristAnswer()->TouristId, $this->intTouristId), \QCubed\Query\QQ::equal(QQN::touristAnswer()->QuestionId, $objQuestion->Id)
						)
		);
		if ($answer) {
			$answer->Answer = ucfirst($answer->Answer);
			if($answer->Answer=='Yes') {
				return "<span style='color: green'>$answer->Answer</span>";
			} else {
				return "<span style='color: darkred'>$answer->Answer</span>";
			}
			
		}
	}

}
