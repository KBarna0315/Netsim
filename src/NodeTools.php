<?php

class NodeTools
{
//Globals
public $node = array(); //params of the node

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
}