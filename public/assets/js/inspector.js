function saveNewObjectFromInspector() {

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


    let data = {
        type: type,
        objType: objType,
        object: object,
        diagName: globalContainer.currDiag, //Idk kell-e
        diagType: globalContainer.currDiagType, //Idk kell-e
        width: frameWidth,
        height: frameHeight,
        posX: globalContainer.addNodePosX,
        posY: globalContainer.addNodePosY,
        selectedObjName: globalContainer.selectedObjs[0]?.getAttribute("name"),
        selectedObjType: globalContainer.selectedObjs[0]?.getAttribute("type")
    };

    $.ajax({
        data: data,
        success: function (result) {
        //error handling

            let nodeOrLink = globalContainer.nodeTypes.includes(objType) ? "node" : "link"

            loadBrowserData();
            $.when(checkInDiagram(globalContainer.currDiag)).then(function () {
                loadDiagramFromServer(globalContainer.currDiag, nodeOrLink, object['Name'], object['Name']);
            });

        }
    });
}