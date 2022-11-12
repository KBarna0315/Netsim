<!DOCTYPE html>
<?php
?>

<html>


<head>
    <title>NetSim</title>
    <link re="stylesheet" type="text/css" href="assets/css/general_stylesheet.css"/>
    <link re="stylesheet" type="text/css" href="assets/css/template.css"/>
    <link re="stylesheet" type="text/css" href="assets/css/ui.css"/>

    <script type="text/javascript" src="assets/js/diagram.js"></script>
    <script type="text/javascript" src="assets/js/function.js"></script>
    <script type="text/javascript" src="assets/js/inspector.js"></script>

</head>


<body>
    <div id="nui_mainframe"> <!--This is everythig on the page -->
        <div id="nui_header"> <!--Header option bar -->
            <!--Zoom options on diag -->
                <!--Zoom in -->
                <!--Zoom out -->
                <!--Zoom fit -->
            <!--End of Zoom options on diag -->

        </div>

        <div id="nui_inner">
            <!-- Needed for form submit without redirect -->
            <iframe style="display: none;" name="nui_dummyframe" id="nui_dummyframe"></iframe>


        </div>

        <div id="nui_diagram"  ondrop="drop(event)" ondragover="allowDrop(event)">

        </div>
        <!-- Right click mouse button menu -->
        <div id="nui_rightbuttonmenu" class="rightButtonMenu" onmouseup="this.style.display = 'none';" style="position: absolute;">
            <div id="nui_addnewnode" onmousedown="showAddObjectInspector(true);" class="menu-item"> <!-- Add new device to the diag -->
                <div class="menu-item-container">
                    <span class="menu-item-name">Add New Node</span>
                    <!-- <span class="menu-item-shortcut"><?php echo AnytoolsClass::getShortcutKeyText('addNewNode'); ?></span>-->
                </div>
            </div>
            <div id="nui_addnewlink" onmousedown="showAddObjectInspector(false);" class="menu-item"> <!-- Connect devices with a link-->
                <div class="menu-item-container">
                    <span class="menu-item-name">Add New Link</span>
                    <span class="menu-item-shortcut"><?php echo AnytoolsClass::getShortcutKeyText('addNewLink'); ?></span>
                </div>
                <div id="nui_deleteselectednodes" onmousedown="deleteSelectedNodes();" class="menu-item"> <!-- Delete selected device -->
                    <div class="menu-item-container">
                        <span class="menu-item-name">Delete Selected Objects</span>
                        <span class="menu-item-shortcut"><?php echo AnytoolsClass::getShortcutKeyText('deleteSelectedObjects'); ?></span>
                    </div>
                </div>


        </div>









    </div>


</body>



</html>
