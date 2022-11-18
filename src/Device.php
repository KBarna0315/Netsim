<?php
/**
 * Device Class
 *
 * Description: The Device related functions will be placed here
 *
 * @author Kiskovács Barna
 */


class Device extends NodeTools
{
//Globals
    public $device = array();

    /**
     * Call this method to get singleton of DeviceClass.
     * @return Device
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Device();
        }
        return $inst;
    }

    //Contructor

    /**
     * Create device if not exists
     * Called by Add New Node function
     * @param string $diag the current diagram
     * @param int $frameWidth is the Diagram Pane width in pixels.
     * @param int $frameHeight is the Diagram Pane height in pixels.
     * @param int $posLeft the left position of the new Device object according to the mouse click position
     * @param int $posTop the top position of the new Device object according to the mouse click position
     * @param array $object node assoc. array
     */
    public function createDevice(string $diag, int $frameWidth = 0, int $frameHeight = 0, int $posLeft = 0, int $posTop = 0,array $object = null)
    {
        $this->diag = $diag;
        $this->diagWidth = $frameWidth;
        $this->diagHeight = $frameHeight;
        $this->posLeft = $posLeft;
        $this->posTop = $posTop;
        if ($object) {
            $this->node = $object;
        }
        $this->addDevice();
    }

    public function deleteDevice($name){

    }

    public function addDevice() {
        $this->node['objType'] = 'Device';

        //Postition számolás?
        $this->calcCoordNode();

        $this->addNodeToDiag(true);


    }

}