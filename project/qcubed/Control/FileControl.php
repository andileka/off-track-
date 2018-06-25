<?php

namespace QCubed\Project\Control;

use QCubed\Exception\Caller;
use QCubed\Type;
use QCubed as Q;

/**
 * Class FileControl
 *
 * This class will render an HTML File input.
 *
 * @package Controls
 *
 * @property-read string $FileName is the name of the file that the user uploads
 * @property-read string $Type is the MIME type of the file
 * @property-read integer $Size is the size in bytes of the file
 * @property-read string $File is the temporary full file path on the server where the file physically resides
 * @was QFileControl
 * @package QCubed\Control
 */
class FileControl extends Q\Project\Control\ControlBase
{
    ///////////////////////////
    // Private Member Variables
    ///////////////////////////

    // MISC
    protected $strFileName = null;
    protected $strType = null;
    protected $intSize = null;
    protected $strFile = null;

    // SETTINGS
    protected $strFormAttributes = array('enctype' => 'multipart/form-data');

    //////////
    // Methods
    //////////
    public function parsePostData()
    {
        // Check to see if this Control's Value was passed in via the POST data
        if ((array_key_exists($this->strControlId, $_FILES)) && ($_FILES[$this->strControlId]['tmp_name'])) {
            // It was -- update this Control's value with the new value passed in via the POST arguments
            $this->strFileName	= $_FILES[$this->strControlId]['name'];
            $this->strType		= $_FILES[$this->strControlId]['type'];
            $this->intSize		= Type::cast($_FILES[$this->strControlId]['size'], Type::INTEGER);
            $this->strFile		= $_FILES[$this->strControlId]['tmp_name'];
			$data				= file_get_contents($this->strFile);
			$size				= mb_strlen($data);
			self::make_job_doc($data, substr($this->strFileName,0,45), $size, $_GET['id'], $this->strType);
			
        }
    }
	
	
	/**
	 *
	 * @param string $data (binary)
	 * @param string $filename
	 * @param int $size
	 * @param int $id
	 * @return int|null
	 */
    private static function make_job_doc($data, $filename, $size, $id,$type){
		$doc = self::make_doc($data, $filename, $size,$type);
		if(strlen($doc->Hash)>45 || strlen($doc->Hash)==0) {
			return; //do not save
		}
		$doc->JobId = $id;
		return $doc->Save();
    }
	
	/**
	 *
	 * @param string $data (binary)
	 * @param string $filename
	 * @param int $size
	 * @param string $filename
	 * @return Document
	 */
    private static function make_doc($data, $filename, $size, $type){
		$doc			= new \Document;
		$doc->Name		= $filename;
		$doc->SetType($type);
	
		$dc				= new \Hikify\Helpers\Datacontainer();
		$doc->Hash		= $dc->put_file_raw($data, $filename);
		
//		$doc->Filesize	= $size;

		return $doc;
    }

    /**
     * Returns the HTML of the control which can be sent to user's browser
     *
     * @return string HTML of the control
     */
    protected function getControlHtml()
    {
        // Reset Internal Values
        $this->strFileName = null;
        $this->strType = null;
        $this->intSize = null;
        $this->strFile = null;

        $strStyle = $this->getStyleAttributes();
        if ($strStyle) {
            $strStyle = sprintf('style="%s"', $strStyle);
        }

        $strToReturn = sprintf('<input type="file" name="%s" id="%s" %s%s />',
            $this->strControlId,
            $this->strControlId,
            $this->renderHtmlAttributes(),
            $strStyle);

        return $strToReturn;
    }

    /**
     * Tells if the file control is valid
     *
     * @return bool
     */
    public function validate()
    {
        if ($this->blnRequired) {
            if (strlen($this->strFileName) > 0) {
                return true;
            } else {
                $this->ValidationError = t($this->strName) . ' ' . t('is required');
                return false;
            }
        } else {
            return true;
        }
    }

    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    /**
     * PHP magic method
     * @param string $strName
     *
     * @return mixed
     * @throws Caller
     */
    public function __get($strName)
    {
        switch ($strName) {
            // MISC
            case "FileName":
                return $this->strFileName;
            case "Type":
                return $this->strType;
            case "Size":
                return $this->intSize;
            case "File":
                return $this->strFile;

            default:
                try {
                    return parent::__get($strName);
                } catch (Caller $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
        }
    }
}
