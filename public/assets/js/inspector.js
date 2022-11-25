function addNewObjectFromInspector() {

    let fields = document.getElementById("nui_inspector-form").querySelectorAll("input, select");
    let object = {};
    for (let i = 0; i < fields.length; i++) {
        let field = fields[i];
        object[field.id.substr(5)] = field.value;
    }

    let frame = document.getElementById('nui_inner');
    let frameWidth = frame.scrollWidth - 1;
    let frameHeight = frame.scrollHeight - 1;
    let type = "createNewObject";
    let objType = "Device";

    let data = {
        type: type,
        objType: objType,
        object: object,
        width: frameWidth,
        height: frameHeight,
       /* posX: globalContainer.addNodePosX,
        posY: globalContainer.addNodePosY,*/
       /* selectedObjName: globalContainer.selectedObjs[0]?.getAttribute("name"),
        selectedObjType: globalContainer.selectedObjs[0]?.getAttribute("type")*/
    };

    $.ajax({
        url: '../src/ajax/JQueryTools.php',
        type: 'POST',
        data: data,
        success: function (result) {
        //error handling
            if(handleAjaxErrors(result)){
                return;
            }
            console.log("Na eddig eljutottunk");

/*            loadBrowserData();
            $.when(checkInDiagram(globalContainer.currDiag)).then(function () {
                loadDiagramFromServer(globalContainer.currDiag, nodeOrLink, object['Name'], object['Name']);
            });*/

        }
    });
}

/**
 * Gets called on every input when an object is showed in inspector.
 * Called by selects onchange listener and input's onkeyup listener
 * @param {Event} event the type of the event
 * @param {string} fieldName the name of the field, that's being modified
 * @param {string} value the current value of the input field
 * @param {string} objType the type of the object currently being editing
 * @param {boolean} isNewObject true if its an object from addNewNode
 * @param {{}} override An object of key-value pairs for overriding inspector values changed in the function.
 */
/* Idk if im gonna even use it for validating the fields of the inspector
function onChangeListener(event, fieldName, value, objType, isNewObject, override = {}) {


}*/
