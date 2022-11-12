//Globals
globalContainer.frameWidth = 0;
globalContainer.frameHeight = 0;
globalContainer.zoomX = 0;
globalContainer.zoomY = 0;
globalContainer.zooming = false;



function init() {
    globalContainer.isCheckedOutForAddObject = false;
    globalContainer.fingers = 0;

    globalContainer.opacity = "0.3";
    //globalContainer.isCopyPressed = false;

   // globalContainer.shownPopups = [];

    // If a path is selected, it stores the id
    globalContainer.selectedPathID = null;

    // Used for drawing path shape
    globalContainer.polylineStartPoint = null;

    // The size of the line breakpoint rectangles
    globalContainer.lineBreakPointRectSize = 6;

    // Used as UNDO stack and it is given to server side when saving
    globalContainer.redrawStack = [];

    // Needed to stop dragging when double clicking node
    globalContainer.isNavigatingOngoing = false;

    var svgMagn = document.getElementById("magn");
    if (!svgMagn) {
        return;
    }
    globalContainer.magn = svgMagn.getAttribute("m"); //get svg magn
    globalContainer.rightSelectedName = "NULL";
    globalContainer.rightSelectedType = "NULL";
    if (globalContainer.currDiag !== document.getElementById("description").getAttribute("Diagram")) {
        diagramResize("zoomFit");
    }

    globalContainer.currDiag = document.getElementById("description").getAttribute("Diagram");

    // If current user checked the diagram out, it should be checked in on reload
    checkInDiagram(globalContainer.currDiag);

    globalContainer.currDiagType = document.getElementById("description").getAttribute("Type");
    //-DRAGGABLE AND DRAGGING HAS TO BE FALSE BY DEFAULT--------------------------
    globalContainer.draggable = false;
    globalContainer.dragging = false;

    //-BLINK ARROW----------------------------------------------------------------
    hideArrow();

    $("rect", document).dblclick(function (event) {
        dblClickDocument(event);
    });
    $("use", document).dblclick(function (event) {
        dblClickDocument(event);
    });
    $("text", document).dblclick(function (event) {
        dblClickDocument(event);
    });

    document.querySelectorAll('path').forEach(path => (
        path.addEventListener('dblclick', event => dblClickDocument(event))
    ));

    addTempElementsToDiag();
}



/**
 * Show the appropriate right menu.
 *
 * Procedure:
 *  + Move right button menu <div> to the actual click position.
 *  + Show the right button menu <div>.
 */
function showRightMenu(evt, menuId) {

    globalContainer.rightbuttonmenu = document.getElementById(menuId);
    globalContainer.rightbuttonmenu.style.display = 'block';
    // Hide unused "nui_showallpopup" menu item.
    let menuWidth = globalContainer.rightbuttonmenu.getBoundingClientRect().width;
    let menuHeight = globalContainer.rightbuttonmenu.getBoundingClientRect().height;

    const contextMenu = document.getElementById("rightButtonMenu");
    const scope = document.querySelector("body");

/*    scope.addEventListener("rightButtonMenu",(event) => {
        event.preventDefault();
        const {clientX: mouseX, clientY: mouseY} = event;
        contextMenu.style.top = `${mouseY}px`;
        contextMenu.style.left = `${mouseX}px`;

        contextMenu.classList.add("visible");

    });*/



    if(evt){
        let e = fixupMouse(evt);
        var x = evt.pageX;
        var y = evt.pageY;

        if(evt.touches && evt.touches[0]){
            x = evt.touches[0].pageX;
            y = evt.touches[0].pageY;
        }

        globalContainer.newNodePosX = e.x;
        globalContainer.newNodePosY = e.y;

        if (x > window.innerWidth - menuWidth) {
            x = window.innerWidth - menuWidth;
        }

        if (y > window.innerHeight - menuHeight) {
            y = window.innerHeight - menuHeight;
        }
    } else {
        x = window.innerWidth - menuWidth;
        y = 0;
        globalContainer.newNodePosX = 100;
        globalContainer.newNodePosY = 100;
    }

    globalContainer.rightbuttonmenu.style.left = x  + "px";
    globalContainer.rightbuttonmenu.style.top = y + "px";
}