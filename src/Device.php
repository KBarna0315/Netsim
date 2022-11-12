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


    public function createDevice()
    {

    }

    public function deleteDevice($name){

    }

}