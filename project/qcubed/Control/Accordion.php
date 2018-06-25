<?php

namespace QCubed\Project\Control;

use QCubed\Control\ControlBase;
use QCubed\Control\DataRepeater;
use QCubed\Control\FormBase;
use QCubed\Exception\Caller;
use QCubed\Html;
use QCubed\Type;
use QCubed as Q;
/**
 * Class Accordion
 *
 * Accordion class - You may modify it to contain your own modifications to the
 * Accordion throughout the framework.
 *
 * @package QCubed\Project\Control
 * @was Accordion
 */
class Accordion extends \QCubed\Bootstrap\Accordion {

	/**
	 * Close all panels by default
	 */
	protected $intCurrentOpenItem = -1;
	
	 /**
     * Renders the given html with an anchor wrapper that will make it toggle the currently drawn item. This should be called
     * from your drawing callback when drawing the heading. This could span the entire heading, or just a portion.
     *
     * @param string $strHtml
     * @param bool $blnRenderOutput
     * @return string
     */
	
    public function renderToggleHelper($strHtml, $blnRenderOutput = true)
    {
		
		if ($this->intCurrentItemIndex == $this->intCurrentOpenItem) {
            $strClass = '';
            $strExpanded = 'true';
        } else {
            $strClass = 'collapsed';
            $strExpanded = 'false';
        }
        $strCollapseId = $this->strControlId . '_collapse_' . $this->intCurrentItemIndex;

        $strOut = Html::renderTag('a',
                ['class'=>$strClass,
                'data-toggle'=>'collapse',
                'data-parent'=>'#' . $this->strControlId,
                'href'=>'#' . $strCollapseId,
                'aria-expanded'=>$strExpanded,
                'aria-controls'=>$strCollapseId],
                $strHtml, false, true);

        if ($blnRenderOutput) {
            echo $strOut;
            return '';
        } else {
            return $strOut;
        }
    }

	
}
