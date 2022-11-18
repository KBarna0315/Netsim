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


    /**
     * Prepare 2 dim assoc. array from Catalog object table first key is the object type, second is field name
     * @param string $obj is the object type
     * @return array of object fields
     */
    public function expandObjects(&$objectTypes = null) {
        $db = DB::Instance();
        $query = "SELECT *  FROM `object`";
        $object_rows = $db->selectRows('phpcatalog', $query);
        $objectTypes = array_column($object_rows, 'Type');
        $objects = array();
        foreach ($object_rows as $object_row) {
            $objType = null;
            foreach ($object_row as $key => $value) {
                if ($key == 'Type') {
                    $objType = $value;
                } else if (isset($objType)) {
                    if (isset($value))  {
                            $objects[$objType][$key] = $value;
                        }
                    }
                }
            }
        return $objects;
    }

}

