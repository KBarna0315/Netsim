/**
 * Cross-Browser Mouse Event Handling.
 * @param Event event is the Javascript event to handle in different browsers.
 */
function fixupMouse(event) {
    let innerFrame = document.getElementById("nui_inner");
    let innerFrameRect = innerFrame.getBoundingClientRect();
    if(event.touches && event.touches[0]){
        return {
            event: event,
            target: event.target,
            which: event.which ? event.which : event.button === 1 ? 1 : event.button === 2 ? 3 : event.button === 4 ? 2 : 1,
            x: event.touches[0].pageX - innerFrameRect.x + innerFrame.scrollLeft,
            y: event.touches[0].pageY - innerFrameRect.y + innerFrame.scrollTop,
            ctrlKey: event.ctrlKey,
            altKey: event.altKey,
            shiftKey: event.shiftKey,
            buttons: event.buttons
        };
    } else {
        return {
            event: event,
            target: event.target,
            which: event.which ? event.which : event.button === 1 ? 1 : event.button === 2 ? 3 : event.button === 4 ? 2 : 1,
            x: event.x - innerFrameRect.x + innerFrame.scrollLeft,
            y: event.y - innerFrameRect.y + innerFrame.scrollTop,
            ctrlKey: event.ctrlKey,
            altKey: event.altKey,
            shiftKey: event.shiftKey,
            buttons: event.buttons
        };
    }
}
function allowDrop(ev) {
    if (!globalContainer.reportIsDragged) {
        ev.preventDefault();
    }
}

/**
 * Showing the accurate error message
 * @param errorCode its the code of the error
 * @param concatString
 * @param stringData is an object, which can contain additional values we want to attach to a string
 */
function showError(errorCode, concatString, stringData = {}) {
    if (!concatString) {
        concatString = "";
    }

    let errorCodes = {
        //Ide jönnek az errorok

        "error0001": {
            "en": "",
            "hu": ""
        },
        "error0002": {
            "en": "Warning",
            "hu": "Figyelmezetés:"
        }


    }
}

/**
 * @param ajaxResult {{
 *     fatalError: string|undefined,
 *     warning: string|undefined,
 * }}
 * @returns {boolean}
 */
function handleAjaxErrors(ajaxResult){
    if(ajaxResult){
        if(ajaxResult.fatalError){
            showError("error2088", ajaxResult.fatalError);
            return true;
        } else if (ajaxResult.warning){
            showError("error2106", ajaxResult.warning);
            return true;
        }
    }
    return false;
}