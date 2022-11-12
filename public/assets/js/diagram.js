/**
 * Hide the right menu.
 *
 * Procedure:
 *  + Hide the right button menu <div>.
 */
function hideRightMenu(event) {
    if(globalContainer.rightbuttonmenu){
        globalContainer.rightbuttonmenu.style.display = 'none';
    }

    if(event && event.target.getAttribute("class") === 'menu-item'){
        if(event.target.parentNode.id === 'nui_inspectorMenuContainer' || event.target.parentNode.id === 'nui_browserMenuContainer'){
            return;
        }
    }


    let menus = document.querySelectorAll(".rightButtonMenu");
    for (let i = 0; i < menus.length; i++) {
        if (menus[i].style.display !== "none") {
            menus[i].style.display = "none";
        }
    }
}