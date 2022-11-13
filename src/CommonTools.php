<?php

/**
 *
 */
class CommonTools
{
    protected $process = null;                     //set to protected 2020-05-24!!!
    public $objectTypes = array();
    public $objects = array();
    public $objType = null;
    public $table = null;
    public $objectInfo = array();
    public $diagTypes = array();
    public $diag = null;
    public $diagMagn = null;
    public $diagWidth = null;                                                   //diagram width in pixel
    public $diagHeight = null;                                                  //diagram height in pixel
    public $posLeft = null;
    public $posTop = null;
    public $diagLabel = array();                                                //diagram label
    public $labels = array();                                                   //panel or rack labels
    public $labelCounter = 0;
    public $logEvent = true;


    /**
     * Call this method to get singleton of CommonToolsClass.
     * @return CommonTools
     */
    public static function Instance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new CommonTools();
        }
        return $inst;
    }

    /**
     * Private constructor so nobody else can instantiate it.
     */
    public function __construct() { //Not sure private maybe better
        $this->initCommonTools();
    }

    private function initCommonTools() {
        $objTypes = array(); //lehet $objtypes
        //TODO: expandObjects create
        $objects = $this->expandObjects($objTypes); //lehet $objtypes
        $this->objects = $objects;
        $this->objectTypes = $objTypes;//lehet $objtypes mabye typo
    }
}

