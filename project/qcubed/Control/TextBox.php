<?php

namespace QCubed\Project\Control;

use QCubed as Q;

/**
 * Class TextBox
 * @package QCubed\Project\Control
 * @was QTextBox
 */
class TextBox extends \QCubed\Control\TextBoxBase
{
    // Feel free to specify global display preferences/defaults for all QTextBox controls
    /** @var string Default CSS class for the textbox */
    protected $strCssClass = 'textbox';
	protected $strLeftHtml;
	
	public function __construct($objParentObject, $strControlId = null)
    {
        parent::__construct($objParentObject, $strControlId);

        /**
         * This is the default purifier, used to purify text coming from users to make sure it doesn't contain
         * malicious cross site scripts. If you install Html Purifier, it will use that one. Otherwise, it will do its
         * best with just putting html entities on what is coming through, which is not very good. You really should install
         * html purifier.
         */

        if (class_exists('HTMLPurifier')) {
            $this->strCrossScripting = self::XSS_HTML_PURIFIER;
        } else {
            $this->strCrossScripting = self::XSS_HTML_ENTITIES;
        }

    }

	/**
     * @return string
     */
    protected function setLeftFontAwesomeIcon($strClass)
    {
        $this->strLeftHtml = "<span class='input-group-addon'><i class='$strClass'></i></span>";		
    }

	/**
     * @return string
     */
    protected function getLeftHtml()
    {
		if($this->strLeftHtml) {
			return $this->strLeftHtml;
		} elseif ($this->strLeftText) {
            return sprintf('<span class="input-group-addon">%s</span>', QString::htmlEntities($this->strLeftText));
        } elseif ($this->pnlLeftButtons) {
            return $this->pnlLeftButtons->render(false);
        }
        return '';
    }
    /**
     * Returns the generator corresponding to this control.
     *
     * @return Q\Codegen\Generator\GeneratorBase
     */
    public static function getCodeGenerator() {
        return new Q\Codegen\Generator\TextBox(__CLASS__);
    }
	
	public function renderFormGroup($blnDisplayOutput = true) {
		
//		<div class="form-group">
//                <label>US phone mask:</label>
//
//                <div class="input-group">
//                  <div class="input-group-addon">
//                    <i class="fa fa-phone"></i>
//                  </div>
//                  <input class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" type="text">
//                </div>
//                <!-- /.input group -->
//              </div>
		
//		$this->addWrapperCssClass("input-group");
//		$this->HtmlBefore							= "<span class='input-group-addon'><i class='fas fa-tachometer-alt'></i></span>";
		return parent::renderFormGroup($blnDisplayOutput);
	}

}
