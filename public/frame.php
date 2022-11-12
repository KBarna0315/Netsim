<!DOCTYPE html>
<?php
?>

<html lang="en">


<head>
    <title>NetSim</title>
    <link rel="stylesheet" type="text/css" href="assets/css/general_stylesheet.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/template.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/ui.css"/>

    <script type="text/javascript" src="assets/js/diagram.js"></script>
    <script type="text/javascript" src="assets/js/functions.js"></script>
    <script type="text/javascript" src="assets/js/inspector.js"></script>


    <script type="text/javascript">
        //Ide jönnek majd a különböző scriptek (php) mikor jelenítse meg a jobb katt menüt mikor hideolja

/*        globalContainer.lastLogCreateAndUpdateId = 0;
        globalContainer.checkOutDiags = {};
        let timer;
        globalContainer.fingers = 0;
        let touchduration = 500; //length of time we want the user to touch before we do something

        window.addEventListener("touchstart", function (evt){
            globalContainer.fingers++;
            clearTimeout(timer);
            timer = setTimeout(function() {
                if (globalContainer.fingers == 3){
                    showRightMenu(evt, "nui_rightbuttonmenu");
                } else if (globalContainer.fingers == 1){
                    dblClickDocument(evt);
                }
            }, touchduration);
        }, false);
        this.addEventListener("keydown", keyDownFrame, false);

        function keyDownFrame(evt) {
            if (evt.keyCode == 27) { // ESC Key Code
                if (globalContainer.rightbuttonmenu) {
                    hideRightMenu();
                }
            }
        }*/


    </script>
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

        <div id="nui_diagram" ondrop="drop(event)" ondragover="allowDrop(event)">

        </div>
    </div>
    <!-- Right click mouse button menu -->
    <div id="nui_rightbuttonmenu" class="rightButtonMenu" onmouseup="this.style.display = 'none';"
         style="position: absolute;">
        <div id="nui_addnewnode" onmousedown="showAddObjectInspector(true);" class="menu-item">
            <!-- Add new device to the diag -->
            <div class="menu-item-container">
                <span class="menu-item-name">Add New Node</span>
                <!-- Shortcut if im going create one -->
            </div>
        </div>
        <div id="nui_addnewlink" onmousedown="showAddObjectInspector(false);" class="menu-item">
            <!-- Connect devices with a link-->
            <div class="menu-item-container">
                <span class="menu-item-name">Add New Link</span>
                <!-- Shortcut if im going create one -->
            </div>
            <div id="nui_deleteselectednodes" onmousedown="deleteSelectedNodes();" class="menu-item">
                <!-- Delete selected device -->
                <div class="menu-item-container">
                    <span class="menu-item-name">Delete Selected Objects</span>
                    <!-- Shortcut if im going create one -->
                </div>
            </div>

        </div>
    </div>


</body>


</html>
