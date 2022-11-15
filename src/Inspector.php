<?php

class Inspector
{
    /**
     * Call this method to get singleton of InspectorClass
     * @return Inspector
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Inspector();
        }
        return $inst;
    }

    /**
     * Private constructor so nobody else can instantiate it
     */
    private function __construct() {

    }

    /**
     * Set defaults for Node add inspector when Node doesn't have own function for it
     *
     * @param string $object is the object with keys-values, containing defaults from field table. This is modified here to set more defaults
     * @param string $selectedObjType is the type of the selected object on the diagram when starting obj add
     * @param string $selectedObjName is the name of the selected object on the diagram when starting obj add
     * @param string $diagName is the name of the diagram where the obj add was started
     */
    private function setNewNodeInspectorDefaults(&$object, $selectedObjType, $selectedObjName, $diagName) {
        $object['Site'] = "def";
        $object['Name'] = "def" . '-' . substr(md5(rand()), 0, 3);
    }

    public function getInspectorAddObject($objType, $selectedObjType, $selectedObjName, $diagName, $diagType, $posX, $posY) {
        if (!$objType) {
            $objType = $this->objType;
        }

        if ($objType == 'Device' || $objType == 'TV' ||  $objType == 'Phone') {
            $this->setNewNodeInspectorDefaults($object, $selectedObjType, $selectedObjName, $diagName);
        }

        $object['objType'] = $objType;
        return array('object' => $object, 'fields' => $fields);
    }

    /**
     * Create new object with given params
     *
     * @param string $objType is the type of the object will be:PC,TV,Router,Switch,Phone
     * @param array $object is the object with (field => value) pairs
     * @param string $diag is the diag to add the object on
     * @param int $width is the width of the diag to add the object on
     * @param int $height is the height of the diag to add the object on
     * @param int $posX is the X position of the new object to add
     * @param int $posY is the Y position of the new object to add
     * @param bool $isLog true if a log has to be created in log table
     * @param string $selectedObjName is the name of the selected object while doing the creation //Needs for the copy
     * @param string $selectedObjType is the type of the selected object while doing the creation
     * @return bool|void
     */
    public function createNewObject(string $objType, array $object, string $diag, int $width = null, int $height = null, int $posX = null, int $posY = null, bool $isLog = true, string $selectedObjName = '',string  $selectedObjType = '')
    {
        $success = false;
        if ($objType == 'Device') {
            $obj = new Device();
            $success = $obj->createDevice($diag, $width, $height, $posX, $posY, $object);
        }
        //All the other creation based action comes here

        return $success;
    }
}