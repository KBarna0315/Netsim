<?php

class Network extends NodeTools
{
    /**
     * Call this method to get singleton of NetworkClass.
     * @return NetworkClass
     */
    public static function Instance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new Network();
        }
        return $inst;
    }

    /**
     * NetworkClass constructor.
     * @param string/null $process is the name of the process
     * @param array/null $network are the params of the network
     */
    public function __construct($process = null, $network = null) {
        $this->process = $process;
        $this->node = $network;
        $this->getObjectInfo('Network');
    }

    /**
     * Create Network node if It is not exist
     * @param string $diag the current diagram
     * @param string $diagtype is the type of the current diagram
     * @param int $frameWidth is the Diagram Pane width in pixels.
     * @param int $frameHeight is the Diagram Pane height in pixels.
     * @param int $posLeft the left position of the new Network object according to the mouse click position
     * @param int $posTop the top position of the new Network object according to the mouse click position
     * @param array $object node assoc. array
     */
    public function createNetwork($diag, $frameWidth, $frameHeight, $posLeft, $posTop, $object) {
        $this->diag = $diag;
        $this->diagWidth = $frameWidth;
        $this->diagHeight = $frameHeight;
        $this->posLeft = $posLeft;
        $this->posTop = $posTop;
        $this->node = $object;
        $this->node['objType'] = 'Network';
        if ($this->checkObject()) {
            echo("This network is already exists!");
        } else {
                $this->addNetwork();
                $this->insertLog('Network create');
                $this->saveXMLDocuments();
        }
    }
    /**
     *
     * @param array $diagram
     * @param array $this->node params of Network
     * Path field of Network is modified
     */
    public function addNetwork() {
        $this->node['objType'] = 'Network';
        if ($icon_info = $this->getConst('cloud')) {                          //get cloud's size from catalog's const table
            $this->node['W'] = $icon_info['W'];
            $this->node['H'] = $icon_info['H'];
            if ($this->node['Type'] == 'Loopback') {
                $this->node['W'] /= 2;
                $this->node['H'] /= 2;
            }
        }
        if ($this->calcCoordNode()) {
            $this->insertNode();                                                //Insert Network entry in to Database
            $this->addNodeToDiag(true);
        }
    }

}