<?php

class NodeTools extends CommonTools
{
//Globals
public $node = array(); //params of the node
    private $tableSchema = array();

    /**
     * Call this method to get singleton of NodeToolsClass.
     * @return NodeTools
     */
    public static function Instance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new NodeTools();
        }
        return $inst;
    }

    /**
     * Insert node into project database
     * @return boolean true if insert is successfull
     */
    public function insertNode() {


        $fields = [];
        $values = [];
        $queryParams = [];


    }
}