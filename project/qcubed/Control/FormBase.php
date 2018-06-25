<?php

namespace QCubed\Project\Control;


/**
 * Class FormBase
 *
 * This form base gives you opportunities to override key functions and values for all of your forms.
 *
 * @package QCubed\Project\Control
 * @was QForm
 */
abstract class FormBase extends \QCubed\Control\FormBase
{
    ///////////////////////////
    // Form Preferences
    ///////////////////////////

    /**
     * If you wish to encrypt the resulting formstate data to be put on the form (via
     * QCryptography), please specify a key to use.  The default cipher and encrypt mode
     * on QCryptography will be used, and because the resulting encrypted data will be
     * sent via HTTP POST, it will be Base64 encoded.
     *
     * @var string EncryptionKey the key to use, or NULL if no encryption is required
     * TODO: Do this some other way, likely more specifically in the formstate handlers that use it
     */
    public static $EncryptionKey = null;

    /**
     * The QFormStateHandler to use to handle the actual serialized form.
     * Please refer configuration.inc.php file (in includes/configuration directory) to learn more
     * about what __FORM_STATE_HANDLER__ does. Though you can change it here,
     * try to change the __FORM_STATE_HANDLER__ in the configuration file alone.
     *
     * It overrides the default value in the QFormBase Class file
     *
     * @var string FormStateHandler the classname of the FormState handler to use
     */
    public static $FormStateHandler = __FORM_STATE_HANDLER__;

    /**
     * These are the list of JavaScript files that should NOT be loaded by the framework,
     * event if a particular control asks for it.
     *
     * In particular, specify any files that you know to be already loaded by a hardcoded
     * include of the javascript in your html or template files.
     *
     * @var array
     */
    protected $strIgnoreJavaScriptFileArray = array();

    /**
     * These are the list of style sheet files that should NOT be loaded by the framework,
     * event if a particular control asks for it.
     *
     * In particular, specify any files that you know to be already loaded by a hardcoded
     * include of the style sheet in your html or template files.
     *
     * @var array
     */
    protected $strIgnoreStyleSheetFileArray = array();

	public function __toString() {
		return (string) $this->strFormId;
	}
    /**
     * Return any java scripts that should be loaded always. In particular, these would
     * be javascripts that you would use in your application even if no particular control
     * asked for it. For example, if you did some manual styling with Bootstrap and you
     * needed the bootstrap javascript file.
     *
     * @return array
     */
    protected function getFormJavaScripts() {
        $a = parent::getFormJavaScripts();
        //$a[] = QCUBED_PROJECT_JS_URL . '/myJsFile.js';
        //$a[] = QCUBED_BOOTSTRAPT_JS_URL;
        return $a;
    }

    /**
     * Return any style sheet files that should be loaded always. In particular, these would
     * be javascripts that you would use in your application even if no particular control
     * asked for it. For example, if you did some manual styling with Bootstrap on a form
     * that did not have any bootstrap controls on it.
     *
     * @return array
     */

    protected function getFormStyles() {
        $a = parent::getFormStyles();
        //$a[] = QCUBED_BOOTSTRAP_CSS;
        return $a;
    }
	
	/**
     * Triggers an event handler method for a given control ID
     * NOTE: Parameters must be already validated and are guaranteed to exist.
     *
     * @param string $strControlId Control ID triggering the method
     * @param string $strMethodName Method name which has to be fired. Includes a control id if a control action.
     * @param QAction $objAction The action object which caused the event
     */
    protected function triggerMethod($strControlId, $strMethodName, \QCubed\Action\ActionBase $objAction)
    {
        $mixParameter = $_POST['Qform__FormParameter'];
        $objMethodParam = new \QCubed\Action\ActionParams($objAction, $this, $strControlId, $mixParameter);
        \QCubed\Project\Control\ControlBase::_processActionParams($objMethodParam);

        if (strpos($strMethodName, '::')) {
            // Calling a static method in a class
            $f = explode('::', $strMethodName);
            if (is_callable($f)) {
                /**
                 * To transition to actions that just take a $params array and nothing else, we use reflection
                 */
                $ref = new \ReflectionClass($f[0]);
                $argCount = $ref->getMethod($f[1])->getNumberOfParameters();

                if ($argCount > 1) {
                    $f($this->strFormId, $strControlId, $objMethodParam->Param);
                } else {
                    $f($objMethodParam);
                }
            }
        } elseif (($intPosition = strpos($strMethodName, ':')) !== false) {
            $strDestControlId = substr($strMethodName, 0, $intPosition);
            $strMethodName = substr($strMethodName, $intPosition + 1);
            $objDestControl = $this->getControl($strDestControlId);
            \QCubed\Project\Control\ControlBase::_callActionMethod($objDestControl, $strMethodName, $objMethodParam);
        } else {
            /**
             * To transition to actions that just take a $params array and nothing else, we use reflection
             */
            $ref = new \ReflectionClass(get_class($this));
            $argCount = $ref->getMethod($strMethodName)->getNumberOfParameters();

            if ($argCount > 1) {
                $this->$strMethodName($this->strFormId, $strControlId, $objMethodParam->Param, $objMethodParam);
            } else {
                $this->$strMethodName($objMethodParam);
            }
        }
    }
	
	
}
