<?php

/**
 * Contains the QControl Class - one of the most important classes in the framework
 */

namespace QCubed\Project\Control;

/**
 * ProjectControl is the user overridable Base-Class for all Controls.
 *
 * This class is intended to be modified.
 * @was QControl
 */
abstract class ControlBase extends \QCubed\Bootstrap\Control {

	private $arrCallbacks;
	protected $strPreferredRenderMethod = "RenderFormGroup";

	public function UnRegister($signal) {
		unset($this->arrCallbacks[$signal]);
	}

	/**
	 *
	 * @param string $signal callback name (OnSave, OnChange, ...)
	 * @param string $slot name of callback function
	 * @param \QCubed\Project\Control\ControlBase $receiver \QCubed\Project\Control\ControlBase that has the callback function
	 */
	public function Register($signal, $slot, \QCubed\Project\Control\ControlBase &$receiver = null) {
		if (!isset($this->arrCallbacks[$signal])) {
			$this->arrCallbacks[$signal] = array();
		}

		if ($receiver) {
			$this->arrCallbacks[$signal][$slot] = array($receiver, $slot);
		} else {
			$this->arrCallbacks[$signal][$slot] = array($this->objParentControl, $slot);
		}
	}

	/**
	 *
	 * @param string $signal
	 * @param array $args
	 */
	public function Trigger($signal, $args = array()) {
		if (isset($this->arrCallbacks[$signal])) {
			foreach ($this->arrCallbacks[$signal] as $pair) {
				list($receiver, $slot) = $pair;
				if (method_exists($receiver, $slot)) {
					if (count($args) > 0) {
						call_user_func_array(array($receiver, $slot), $args);
					} else {
						$receiver->$slot();
					}
				}
			}
		}
	}

}
