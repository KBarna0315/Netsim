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

        $servername = "localhost:3306";
        $username = "root";
        $password = "root";
        $dbname = "default";
        $name ="";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);

        }

        $sql = "INSERT INTO device(Name) VALUES ('" . $name . "')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    public function calcCoordNode() {
        $left = $this->objectInfo['Left'];
        $top = $this->objectInfo['Top'];
        $right = $this->objectInfo['Right'];
        $bottom = $this->objectInfo['Bottom'];
        if (!$this->node['W'] || !$this->node['H']) {                           //if node's W or  H is not set
            $symbolfield = $this->objectInfo['Symbol_Field'];
            // Loopback interface should look like normal network
            if($this->objType == "Network" && $this->node[$symbolfield] == "Loopback"){
                $symbolfield = "VLAN";
            }
            $this->icon = $this->node[$symbolfield];                     //Retrieve Symbol Icon Name depends on Catalog's 'Symbol_Field'
            if (empty($this->icon) || !$this->isIcon($this->icon)) {                           //if icon is not exist in ICos folder or node Symbol not given
                $this->icon = $this->objectInfo['Default_Symbol'];               //get Default_Symbol
            }
            if ($icon_info = $this->getConst($this->icon)) {                          //get node's size from catalog's const table
                $this->node['W'] = $icon_info['W'];
                $this->node['H'] = $icon_info['H'];
            } else {
                ErrorLog::log('calcCoord:: Constans is not found: ' . $this->icon);
                return false;
            }
        }
        if ($this->posLeft && $this->posTop) {                                  //if pozition is given or "0"
            $this->node[$left] = $this->posLeft - intval($this->diagMagn * $this->node['W'] / 2);
            $this->node[$top] = $this->posTop - intval($this->diagMagn * $this->node['H'] / 2);
            $this->node[$right] = $this->node[$left] + intval($this->diagMagn * $this->node['W']);
            $this->node[$bottom] = $this->node[$top] + intval($this->diagMagn * $this->node['H']);
        } else if (!is_numeric($this->node[$left]) || !is_numeric($this->node[$top]) || $this->node[$left] < 300 || $this->node[$top] < 300) {
            $this->node[$left] = 300;
            $this->node[$top] = 300;
            $this->node[$right] = $this->node[$left] + intval($this->diagMagn * $this->node['W']);
            $this->node[$bottom] = $this->node[$top] + intval($this->diagMagn * $this->node['H']);
        } else {                                                                //if Left, Top get from Coords
            if (!$this->node[$right] || ($this->node[$right] - $this->node[$left]) < 5) {
                $this->node[$right] = $this->node[$left] + intval($this->diagMagn * $this->node['W']);
            }
            if (!$this->node[$bottom] || ($this->node[$bottom] - $this->node[$top]) < 5) {
                $this->node[$bottom] = $this->node[$top] + intval($this->diagMagn * $this->node['H']);
            }
        }
        return true;
    }

}