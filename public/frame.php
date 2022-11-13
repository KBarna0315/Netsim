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
</head>


<style>
    body {
        width: 100%;
        height: 100%;
        font-family: "Open Sans", sans-serif;
        padding: 0;
        margin: 0;
    }

    #context-menu {
        position: fixed;
        z-index: 10000;
        width: 150px;
        background-color: #666;
        border-radius: 5px;
        transform: scale(0);
        transform-origin: top left;
    }

    #context-menu.visible {
        transform: scale(1);
        transition: transform 200ms ease-in-out;
    }

    #context-menu .item {
        padding: 8px 10px;
        font-size: 15px;
        color: #eee;
        cursor: pointer;
        border-radius: inherit;
    }

    #context-menu .item:hover {
        background: #343434;
    }
</style>

<body>
<div id="nui_mainframe">
    <div id="nui_header">
        <div class="nui_project_blocker_overlay"></div>
        <div id="nui_tools">
<!--            <a href="javascript:saveDiag();" style="display:inline-block;"><img src="assets/icons/SaveToolbar24.svg" title="<?php /*echo AnytoolsClass::concatShortcutKeyText('Diagram Save', 'saveDiag');*/?>" class="button-big"></a>
            <a href="javascript:diagramResize('zoomIn');"><img src="assets/icons/ZoomIn24.svg" title="Zoom In" class="button-big"></a>
            <a href="javascript:diagramResize('zoomOut');"><img src="assets/icons/ZoomOut24.svg" title="Zoom Out" class="button-big"></a>
            <a href="javascript:diagramResize('zoomFit');"><img src="assets/icons/Zoom24.svg" title="<?php /*echo AnytoolsClass::concatShortcutKeyText('Zoom Fit', 'zoomFit');*/?>" class="button-big"></a>
-->

            <a href=""><img src="assets/icons/SaveToolbar24.svg" title="Save Diagram" class="button-big" alt="ToolbarSave"></a>
            <a href=""><img src="assets/icons/ZoomIn24.svg" title="Zoom In" class="button-big" alt="ToolbarZoomIn"></a>
            <a href=""><img src="assets/icons/ZoomOut24.svg" title="Zoom Out" class="button-big" alt="ToolbarZoomOut"></a>
            <a href=""><img src="assets/icons/Zoom24.svg" title="Zoom Fit" class="button-big" alt="ToolbarZoomfit"></a>
        </div>

    </div>

    <div id="nui_inner">

    </div>

<div id="context-menu" onmouseup="this.style.display = 'none';" style="position: absolute;">
    <div class="item">Add new Node</div>
    <div class="item">Create Link</div>
    <div class="item">Delete Link</div>
</div>

<script>
    const contextMenu = document.getElementById("context-menu");
    const scope = document.querySelector("body");

    const normalizePozition = (mouseX, mouseY) => {
        // ? compute what is the mouse position relative to the container element (scope)
        let {
            left: scopeOffsetX,
            top: scopeOffsetY,
        } = scope.getBoundingClientRect();

        scopeOffsetX = scopeOffsetX < 0 ? 0 : scopeOffsetX;
        scopeOffsetY = scopeOffsetY < 0 ? 0 : scopeOffsetY;

        const scopeX = mouseX - scopeOffsetX;
        const scopeY = mouseY - scopeOffsetY;

        // ? check if the element will go out of bounds
        const outOfBoundsOnX =
            scopeX + contextMenu.clientWidth > scope.clientWidth;

        const outOfBoundsOnY =
            scopeY + contextMenu.clientHeight > scope.clientHeight;

        let normalizedX = mouseX;
        let normalizedY = mouseY;

        // ? normalize on X
        if (outOfBoundsOnX) {
            normalizedX =
                scopeOffsetX + scope.clientWidth - contextMenu.clientWidth;
        }

        // ? normalize on Y
        if (outOfBoundsOnY) {
            normalizedY =
                scopeOffsetY + scope.clientHeight - contextMenu.clientHeight;
        }

        return { normalizedX, normalizedY };
    };

    scope.addEventListener("contextmenu", (event) => {
        event.preventDefault();

        const { clientX: mouseX, clientY: mouseY } = event;

        const { normalizedX, normalizedY } = normalizePozition(mouseX, mouseY);

        contextMenu.classList.remove("visible");

        contextMenu.style.top = `${normalizedY}px`;
        contextMenu.style.left = `${normalizedX}px`;

        setTimeout(() => {
            contextMenu.classList.add("visible");
        });
    });

    scope.addEventListener("click", (e) => {
        // ? close the menu if the user clicks outside of it
        if (e.target.offsetParent != contextMenu) {
            contextMenu.classList.remove("visible");
        }
    });
</script>

    <div id="nui_right">

    </div>

    <div id="nui_alignbar">

    </div>

    <div id="nui_left_upper">

    </div>

<div id="nui_left_lower">
    <div id="nui_inspector-type">
        <span id="nui_inspectorHeaderText"></span>
    </div>
    <form id="nui_inspector-form">
        <div id="container_insp_Name"> <!--Ide még kellene: oncontextmenu="showInspectorRightClickMenu()"-->
            <label for="insp_Name" title="Name">Name:</label>
            <input id="insp_Name" name="Name" value="PlaceHolderName" type="text">
        </div>
        <div id="container_insp_Type"> <!--Ide még kellene: oncontextmenu="showInspectorRightClickMenu()"-->
            <label for="insp_Type" title="Type">Type:</label>
            <input id="insp_Type" name="Type" value="PlaceHolderType" type="text">
        </div>
        <div id="container_insp_IPaddr"> <!--Ide még kellene: oncontextmenu="showInspectorRightClickMenu()"-->
            <label for="insp_IPaddr" title="IPaddr">IP Address:</label>
            <input id="insp_IPaddr" name="IPaddr" value="" type="text">
        </div>
        <div id="container_insp_Netmask"> <!--Ide még kellene: oncontextmenu="showInspectorRightClickMenu()"-->
            <label for="insp_Netmask" title="Netmask">Netmask:</label>
            <input id="insp_Netmask" name="Netmask" value="255.255.252.0" type="text">
        </div>
        <div id="container_insp_MAC"> <!--Ide még kellene: oncontextmenu="showInspectorRightClickMenu()"-->
            <label for="insp_MAC" title="MAC">MAC:</label>
            <input id="insp_MAC" name="MAC" value="" type="text">
        </div>
    </form>
    <div id="nui_inspectorMenuContainer" class="rightButtonMenu">
        <div id="nui_renameInspectorObject" class="menu-item" onclick="renameInspectorObject()">Rename Object</div>
        <div id="nui_objTypeChange" class="menu-item" onclick="objTypeChange()">Object Type Change</div>
    </div>
    <div id="objectTypeContainer" class="rightButtonMenu">
    </div>
</div>
<div id="nui_horizontal_dragbar"></div>
<div id="nui_vertical_dragbar"></div>
<div id="nui_align_dragbar"></div>

</div>

</body>


</html>
